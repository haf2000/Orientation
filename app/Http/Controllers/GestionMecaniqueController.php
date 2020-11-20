<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GM;
use App\L3GM;
use DB;
class GestionMecaniqueController extends Controller
{

//----------------------------------Prétraitement-------------------------

//-------------------------------
    public function supp_ajr_l2(){
      GM::where('resultat', '=', 'AJR')->delete();
    }
//--------------------------------
     public function supp_doublants_l2l3(){
        $etudiants = DB::table('l3gm')->
                     select('matricule','nom_prenom')
                     ->get();
        foreach ($etudiants as $etudiant) {
      DB::table('gm')->
      where([
     ['matricule', '=', $etudiant->matricule ],
     ['nom_prenom', '=', $etudiant->nom_prenom],
     ['resultat', '=', "ADC"],
     ])->delete();
        	
         }
    }
 //--------------------------------
      public function calcul_mc(){
        // calcul session
         DB::table('gm')->where('session','=','1')->update(['session' => '0']);
         DB::table('gm')->where('session','=','2')->update(['session' => '1']);
        
        // calcul R : années de retard
          $annee_cours = date("Y"); 
          $matricule_errone = '0';

         $fiches = DB::table('fichevoeuxgm')-> select('matricule','nom','prenom','choix1','choix2','choix3','nationalite')->get();

          foreach ($fiches as $fiche) {
          	$NP = $fiche->nom." ".$fiche->prenom;
            $num_matricule =substr($fiche->matricule,0,2);
            $annee_matricule = "20".$num_matricule;
            $difference = intval($annee_cours)-intval($annee_matricule);
            if($difference >= 2)  
            	{
                if($fiche->nationalite == "213")
                  { $r = $difference-2; }
                  else{
                    if($fiche->nationalite == null){ $r = $difference-2; }else{ $r = $difference-4;}
                  
                  }
              
      DB::table('gm')-> where([
     ['matricule', '=', $fiche->matricule],
    ['nom_prenom', '=', $NP]
     ])->update(['r' => $r]);  

              }
                 DB::table('gm')-> where([
     ['matricule', '=', $fiche->matricule],
    ['nom_prenom', '=', $NP]
     ])->update(['choix1' => $fiche->choix1,'choix2' => $fiche->choix2,'choix3' => $fiche->choix3,'fichevoeux_remp' => '1']);
                 }
                     // calcul mc = MG * (1-0.04*(R+session/4))
        DB::statement("UPDATE `gm` SET `mc`= `moy_an`*(1-0.04*(`r`+(`session`/4))) WHERE `fichevoeux_remp`= '1' ");
         
          }
 //--------------------------------
public function calcul_ajr_par_specialiteL3()
{

  $ajournes = DB::table('l3gm')
  ->where('resultat','=','AJR')
  ->selectRaw('count(id) as nombre_ajr, specialite')
  ->groupBy('specialite')
  ->get();
  $i=0;
   $nombre_ajournes_par_spec = array("L3E" => "","L3GM" => "","L3CM" => "") ;
   foreach ($ajournes as $ajourne) {
   
   if($ajourne->specialite == "A454"){$nombre_ajournes_par_spec["L3E"] = $ajourne->nombre_ajr;}
   if($ajourne->specialite == "A459"){$nombre_ajournes_par_spec["L3GM"] = $ajourne->nombre_ajr;}
   if($ajourne->specialite == "4553"){$nombre_ajournes_par_spec["L3CM"] = $ajourne->nombre_ajr;}
   }

   return $nombre_ajournes_par_spec;

}
//--------------------------------
 public function calcul_total_orient_X(){
  $ajournes = DB::table('gm')
  ->selectRaw('count(id) as total_orient')
  ->get();
  foreach ($ajournes as $ajourne) {
    $x = $ajourne->total_orient;
  }
  
  return $x;
 }
 //--------------------------------
 public function calcul_arrondi($nombre){
  $partie_entiere= floor($nombre);
  $diff = $nombre - $partie_entiere;
  if($diff > 0.5){
    $resultat = $partie_entiere +1;
  }else{
    $resultat = $partie_entiere;
  }
  return $resultat;
 }
 //--------------------------------
  public function calcul_nbr_places_disp_pr_chaque_specialite(){
/*Zi = ( (X+Total des ajournés L3)/3  ) - Nombre des ajournés par spécialité*/
   $places_disp_par_spec = array("L3E" => "","L3GM" => "","L3CM" => "") ;
   $x= self::calcul_total_orient_X();
   $nombre_ajournes_par_spec = self::calcul_ajr_par_specialiteL3();
   
   $total_ajournes = intval($nombre_ajournes_par_spec["L3E"])+intval($nombre_ajournes_par_spec["L3GM"])+intval($nombre_ajournes_par_spec["L3CM"]);
   $places_disp_par_spec["L3E"] = self::calcul_arrondi((($x+$total_ajournes)/3) - intval($nombre_ajournes_par_spec["L3E"]));

    $places_disp_par_spec["L3GM"] = self::calcul_arrondi((($x+$total_ajournes)/3) - intval($nombre_ajournes_par_spec["L3GM"])); 

     $places_disp_par_spec["L3CM"] = self::calcul_arrondi((($x+$total_ajournes)/3) - intval($nombre_ajournes_par_spec["L3CM"])); 
   return $places_disp_par_spec;
  }


  //-------------------------------------
   public function calcul_taux_reussite(){
/*taux de réussite = (Nombre d’étudiants à orienter (admis) par section/Le nombre total X)*100*/
   $sections = DB::table('gm')
  ->selectRaw('count(id) as nbr_orient_par_section , section')
  ->groupBy('section')
  ->get();

   $x= self::calcul_total_orient_X();

  $taux_reussite  = array('A' => "" ,'B' => "",'C' => "",'D' => "",'E' => "");
  foreach ($sections as $section) {
    if($section->section == 'A'){$taux_reussite["A"] = ($section->nbr_orient_par_section/$x);}
    if($section->section == 'B'){$taux_reussite["B"] = ($section->nbr_orient_par_section/$x);}
    if($section->section == 'C'){$taux_reussite["C"] = ($section->nbr_orient_par_section/$x);}
    if($section->section == 'D'){$taux_reussite["D"] = ($section->nbr_orient_par_section/$x);}
    if($section->section == 'E'){$taux_reussite["E"] = ($section->nbr_orient_par_section/$x);}
    }

    return $taux_reussite;

   }


    //-------------------------------------
   public function calcul_places_dispo_section_specialite(){
/*calcul de places disponibles pour chaque section pour les 3 spécialités = Taux de réussite * (Z-Ajournés)*/
     // Les lignes = les sections / les colonnes sont les spécialités
    $matrice = array('A','B','C','D','E');
    $matrice['A'] = array('L3E','L3GM','L3CM');
    $matrice['B'] = array('L3E','L3GM','L3CM');
    $matrice['C'] = array('L3E','L3GM','L3CM');
    $matrice['D'] = array('L3E','L3GM','L3CM');
    $matrice['E'] = array('L3E','L3GM','L3CM');

     $taux_reussite = self::calcul_taux_reussite();
     $places_disp_par_spec = self::calcul_nbr_places_disp_pr_chaque_specialite();
       
      // section A
     $matrice['A']['L3E'] =  $taux_reussite['A'] * $places_disp_par_spec['L3E'];
     $matrice['A']['L3GM'] =  $taux_reussite['A'] * $places_disp_par_spec['L3GM'];
     $matrice['A']['L3CM'] =  $taux_reussite['A'] * $places_disp_par_spec['L3CM'];
      // section B
     $matrice['B']['L3E'] =  $taux_reussite['B'] * $places_disp_par_spec['L3E'];
     $matrice['B']['L3GM'] = $taux_reussite['B'] * $places_disp_par_spec['L3GM'];
     $matrice['B']['L3CM'] =  $taux_reussite['B'] * $places_disp_par_spec['L3CM'];
      //section C
     $matrice['C']['L3E'] =  $taux_reussite['C'] * $places_disp_par_spec['L3E'];
     $matrice['C']['L3GM'] = $taux_reussite['C'] * $places_disp_par_spec['L3GM'];
     $matrice['C']['L3CM'] = $taux_reussite['C'] * $places_disp_par_spec['L3CM'];
      // section D
     $matrice['D']['L3E'] =  $taux_reussite['D'] * $places_disp_par_spec['L3E'];
     $matrice['D']['L3GM'] = $taux_reussite['D'] * $places_disp_par_spec['L3GM'];
     $matrice['D']['L3CM'] = $taux_reussite['D'] * $places_disp_par_spec['L3CM'];
      // section E
     $matrice['E']['L3E'] =  $taux_reussite['E'] * $places_disp_par_spec['L3E'];
     $matrice['E']['L3GM'] =  $taux_reussite['E'] * $places_disp_par_spec['L3GM'];
     $matrice['E']['L3CM'] = $taux_reussite['D'] * $places_disp_par_spec['L3CM'];
  
     return  $matrice;
   }
 //----------------------------------------------------------------------------------
    public function pretraitement_traitement(){
    
    //----------------------------------Prétraitement-------------------------
        // self::supp_ajr_l2();    
        // self::supp_doublants_l2l3();
        // self::calcul_mc();
    //-----------------------------------Traitement---------------------------
      //$places_disp_par_spec=self::calcul_nbr_places_disp_pr_chaque_specialite();
    // $taux_reussite = self ::calcul_taux_reussite();
     $matrice =  self::calcul_places_dispo_section_specialite(); 
 // section A
     echo "section A : ".$matrice['A']['L3E']."<br>";
     echo "section A : ".$matrice['A']['L3GM']."<br>";
    echo "section A : ". $matrice['A']['L3CM']."<br>";
      echo "************************************<br>";
      // section B
     echo "section B : ".$matrice['B']['L3E'] ."<br>";
     echo "section B : ".$matrice['B']['L3GM']  ."<br>";
     echo "section B : ".$matrice['B']['L3CM']   ."<br>";
    echo "************************************<br>";

      //section C
     echo "section C : ".$matrice['C']['L3E']   ."<br>";
     echo "section C : ".$matrice['C']['L3GM']  ."<br>";
     echo "section C : ".$matrice['C']['L3CM']  ."<br>";
           echo "************************************<br>";

      // section D
     echo "section D : ".$matrice['D']['L3E']   ."<br>";
     echo "section D : ".$matrice['D']['L3GM']  ."<br>";
     echo "section D : ".$matrice['D']['L3CM'] ."<br>";
           echo "************************************<br>";

      // section E
     echo "section E : ".$matrice['E']['L3E'] ."<br>";
     echo "section E : ".$matrice['E']['L3GM']."<br>";
     echo "section E : ".$matrice['E']['L3CM']."<br>";
     // return back();
        }

 //----------------------------------------------------------------------------------

public function refaire_traitement(){
             DB::statement("TRUNCATE TABLE gm");
             DB::statement("TRUNCATE TABLE l3gm");
             DB::statement("TRUNCATE TABLE fichevoeuxgm");
             return back();

        }


}