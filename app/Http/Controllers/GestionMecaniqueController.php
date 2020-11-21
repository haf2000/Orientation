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
   $nombre_ajournes_par_spec = array("L3E" => 0,"L3GM" => 0,"L3CM" => 0) ;
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
   $places_disp_par_spec = array("L3E" => 0,"L3GM" => 0,"L3CM" => 0) ;
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

  $taux_reussite  = array('A' => 0.0 ,'B' => 0.0,'C' => 0.0,'D' => 0.0,'E' => 0.0);
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
      public function orientation()
      {
    // intialiser les sections
      $sections = array();
      $sections[0] = 'A';
      $sections[1] = 'B';
      $sections[2] = 'C';
      $sections[3] = 'D';
      $sections[4] = 'E';
    // intialiser les files d'attente pour chaque section 
      $files_attente_sections  = array();
      $files_attente_sections[0] = array();
      $files_attente_sections[1] = array();
      $files_attente_sections[2] = array();
      $files_attente_sections[3] = array();
      $files_attente_sections[4] = array();
    // récupèrer la matrice des places disponibles 
      $matrice =  self::calcul_places_dispo_section_specialite(); 
      for ($i = 0; $i < 5; $i++) {
      
      $section =  $sections[$i]; // recuperer la section 
      $file_attente =  $files_attente_sections[$i]; // recuperer la file d'attente
      // recuperer la table contenant les places disponibles pour chaque specialité dans la section courante
      if($i == 0) {$places_dispo_par_spec = $matrice['A'];}
      if($i == 1) {$places_dispo_par_spec = $matrice['B'];}
      if($i == 2) {$places_dispo_par_spec = $matrice['C'];}
      if($i == 3) {$places_dispo_par_spec = $matrice['D'];}
      if($i == 4) {$places_dispo_par_spec = $matrice['E'];}
      // recuperer le nombre de places disponibles pour chaque specialite
      $places_disp_L3E = $places_dispo_par_spec['L3E'];
      $places_disp_L3GM = $places_dispo_par_spec['L3GM'];
      $places_disp_L3CM = $places_dispo_par_spec['L3CM'];
      // faire le classement selon la moyenne corrigée pour chaque section
          $etudiants_section_classes_par_mc = DB::table('gm')->
              where('section','=',$section)->
              select('*')->
              orderBy('mc', 'desc')->get();
     // Parcourir la liste des etudiants dans la section
           foreach ($etudiants_section_classes_par_mc as $etudiant) {     
          $orientation = ""; 
             if($etudiant->fichevoeux_remp == '1') // fiche de voeux remplie
           {
              //traitement choix1
           if($etudiant->choix1 <> NULL){ // vérifier si le premier choix est différent de null
              if($etudiant->choix1 == "A454"){ // condition 1 choix 1
               if($places_disp_L3E > 0){
                $places_disp_L3E=$places_disp_L3E-1;
                $orientation = "A454";
               }
               else{
                // aucune place disponible - traitement choix2
                if ($etudiant->choix2 <> NULL){
                        if($etudiant->choix2 == "A454"){ // condition1 choix2
                          if($places_disp_L3E > 0){
                         $places_disp_L3E=$places_disp_L3E-1;
                          $orientation = "A454";
                          }else{
                          // aucune place disponible - traitement choix3
                            if ($etudiant->choix3 <> NULL){
                             if($etudiant->choix3 == "A454"){
                              if($places_disp_L3E > 0){
                         $places_disp_L3E=$places_disp_L3E-1;
                          $orientation = "A454";
                          }else{echo "Tweswiss";}
                             }
                             if($etudiant->choix3 == "A459"){
                              if($places_disp_L3GM > 0){
                              $places_disp_L3GM=$places_disp_L3GM-1;
                              $orientation = "A459";
                              }else{echo "Tweswiss";}}
                             if($etudiant->choix3 == "4553"){
                              if($places_disp_L3CM > 0){
                              $places_disp_L3CM=$places_disp_L3CM-1;
                              $orientation = "4553";
                              }else{echo "Tweswiss";}
                             }
                            }else{
                              // choix 3 = null
                            } 
                          }
                        }



                        if($etudiant->choix2 == "A459"){ // condition2 choix2
                           if($places_disp_L3GM > 0){
                         $places_disp_L3GM=$places_disp_L3GM-1;
                          $orientation = "A459";
                          }else{
                          // aucune place disponible - traitement choix3
                            if ($etudiant->choix3 <> NULL){
                             if($etudiant->choix3 == "A454"){
                              if($places_disp_L3E > 0){
                         $places_disp_L3E=$places_disp_L3E-1;
                          $orientation = "A454";
                          }else{echo "Tweswiss";}
                             }
                             if($etudiant->choix3 == "A459"){
                              if($places_disp_L3GM > 0){
                              $places_disp_L3GM=$places_disp_L3GM-1;
                              $orientation = "A459";
                              }else{echo "Tweswiss";}}
                             if($etudiant->choix3 == "4553"){
                              if($places_disp_L3CM > 0){
                              $places_disp_L3CM=$places_disp_L3CM-1;
                              $orientation = "4553";
                              }else{echo "Tweswiss";}
                             }
                            }else{
                              // choix 3 = null
                            } 
                          }
                        }



                        if($etudiant->choix2 == "4553"){ // condition3 choix2
                           if($places_disp_L3CM > 0){
                         $places_disp_L3CM=$places_disp_L3CM-1;
                          $orientation = "4553";
                          }else{
                             // aucune place disponible - traitement choix3
                            if ($etudiant->choix3 <> NULL){
                             if($etudiant->choix3 == "A454"){
                              if($places_disp_L3E > 0){
                         $places_disp_L3E=$places_disp_L3E-1;
                          $orientation = "A454";
                          }else{echo "Tweswiss";}
                             }
                             if($etudiant->choix3 == "A459"){
                              if($places_disp_L3GM > 0){
                              $places_disp_L3GM=$places_disp_L3GM-1;
                              $orientation = "A459";
                              }else{echo "Tweswiss";}}
                             if($etudiant->choix3 == "4553"){
                              if($places_disp_L3CM > 0){
                              $places_disp_L3CM=$places_disp_L3CM-1;
                              $orientation = "4553";
                              }else{echo "Tweswiss";}
                             }
                            }else{
                              // choix 3 = null
                            } 
                          }
                        }


                }else{
                  // choix 2 null
                }
               } 
              }
              if($etudiant->choix1 == "A459"){ // condition 2 choix 1
                if($places_disp_L3GM > 0){
                $places_disp_L3GM=$places_disp_L3GM-1;
                $orientation = "A459";
               }
               else{
                // aucune place disponible - traitement choix 2
                 if ($etudiant->choix2 <> NULL){
                     if($etudiant->choix2 == "A454"){ // condition1 choix2
                          if($places_disp_L3E > 0){
                         $places_disp_L3E=$places_disp_L3E-1;
                          $orientation = "A454";
                          }else{
                          // aucune place disponible - traitement choix3
                            if ($etudiant->choix3 <> NULL){
                             if($etudiant->choix3 == "A454"){
                              if($places_disp_L3E > 0){
                         $places_disp_L3E=$places_disp_L3E-1;
                          $orientation = "A454";
                          }else{echo "Tweswiss";}
                             }
                             if($etudiant->choix3 == "A459"){
                              if($places_disp_L3GM > 0){
                              $places_disp_L3GM=$places_disp_L3GM-1;
                              $orientation = "A459";
                              }else{echo "Tweswiss";}}
                             if($etudiant->choix3 == "4553"){
                              if($places_disp_L3CM > 0){
                              $places_disp_L3CM=$places_disp_L3CM-1;
                              $orientation = "4553";
                              }else{echo "Tweswiss";}
                             }
                            }else{
                              // choix 3 = null
                            } 
                          }
                        }

                    


                        if($etudiant->choix2 == "A459"){ // condition2 choix2
                           if($places_disp_L3GM > 0){
                         $places_disp_L3GM=$places_disp_L3GM-1;
                          $orientation = "A459";
                          }else{
                          // aucune place disponible - traitement choix3
                            if ($etudiant->choix3 <> NULL){
                             if($etudiant->choix3 == "A454"){
                              if($places_disp_L3E > 0){
                         $places_disp_L3E=$places_disp_L3E-1;
                          $orientation = "A454";
                          }else{echo "Tweswiss";}
                             }
                             if($etudiant->choix3 == "A459"){
                              if($places_disp_L3GM > 0){
                              $places_disp_L3GM=$places_disp_L3GM-1;
                              $orientation = "A459";
                              }else{echo "Tweswiss";}}
                             if($etudiant->choix3 == "4553"){
                              if($places_disp_L3CM > 0){
                              $places_disp_L3CM=$places_disp_L3CM-1;
                              $orientation = "4553";
                              }else{echo "Tweswiss";}
                             }
                            }else{
                              // choix 3 = null
                            } 
                          }
                        }



                        if($etudiant->choix2 == "4553"){ // condition3 choix2
                           if($places_disp_L3CM > 0){
                         $places_disp_L3CM=$places_disp_L3CM-1;
                          $orientation = "4553";
                          }else{
                             // aucune place disponible - traitement choix3
                            if ($etudiant->choix3 <> NULL){
                             if($etudiant->choix3 == "A454"){
                              if($places_disp_L3E > 0){
                         $places_disp_L3E=$places_disp_L3E-1;
                          $orientation = "A454";
                          }else{echo "Tweswiss";}
                             }
                             if($etudiant->choix3 == "A459"){
                              if($places_disp_L3GM > 0){
                              $places_disp_L3GM=$places_disp_L3GM-1;
                              $orientation = "A459";
                              }else{echo "Tweswiss";}}
                             if($etudiant->choix3 == "4553"){
                              if($places_disp_L3CM > 0){
                              $places_disp_L3CM=$places_disp_L3CM-1;
                              $orientation = "4553";
                              }else{echo "Tweswiss";}
                             }
                            }else{
                              // choix 3 = null
                            } 
                          }
                        }

                 }else{
                  // choix 2 null
                 }

               } 
              }
              if($etudiant->choix1 == "4553"){ // condition 3 choix 1
                if($places_disp_L3CM > 0){
                $places_disp_L3CM=$places_disp_L3CM-1;
                $orientation = "4553";
               }
               else{
                // aucune place disponible - traitement choix 2
                 if ($etudiant->choix2 <> NULL){
                      if($etudiant->choix2 == "A454"){ // condition1 choix2
                          if($places_disp_L3E > 0){
                         $places_disp_L3E=$places_disp_L3E-1;
                          $orientation = "A454";
                          }else{
                          // aucune place disponible - traitement choix3
                            if ($etudiant->choix3 <> NULL){
                             if($etudiant->choix3 == "A454"){
                              if($places_disp_L3E > 0){
                         $places_disp_L3E=$places_disp_L3E-1;
                          $orientation = "A454";
                          }else{echo "Tweswiss";}
                             }
                             if($etudiant->choix3 == "A459"){
                              if($places_disp_L3GM > 0){
                              $places_disp_L3GM=$places_disp_L3GM-1;
                              $orientation = "A459";
                              }else{echo "Tweswiss";}}
                             if($etudiant->choix3 == "4553"){
                              if($places_disp_L3CM > 0){
                              $places_disp_L3CM=$places_disp_L3CM-1;
                              $orientation = "4553";
                              }else{echo "Tweswiss";}
                             }
                            }else{
                              // choix 3 = null
                            } 
                          }
                        }




                        if($etudiant->choix2 == "A459"){ // condition2 choix2
                           if($places_disp_L3GM > 0){
                         $places_disp_L3GM=$places_disp_L3GM-1;
                          $orientation = "A459";
                          }else{
                          // aucune place disponible - traitement choix3
                            if ($etudiant->choix3 <> NULL){
                             if($etudiant->choix3 == "A454"){
                              if($places_disp_L3E > 0){
                         $places_disp_L3E=$places_disp_L3E-1;
                          $orientation = "A454";
                          }else{echo "Tweswiss";}
                             }
                             if($etudiant->choix3 == "A459"){
                              if($places_disp_L3GM > 0){
                              $places_disp_L3GM=$places_disp_L3GM-1;
                              $orientation = "A459";
                              }else{echo "Tweswiss";}}
                             if($etudiant->choix3 == "4553"){
                              if($places_disp_L3CM > 0){
                              $places_disp_L3CM=$places_disp_L3CM-1;
                              $orientation = "4553";
                              }else{echo "Tweswiss";}
                             }
                            }else{
                              // choix 3 = null
                            } 
                          }
                        }



                        if($etudiant->choix2 == "4553"){ // condition3 choix2
                           if($places_disp_L3CM > 0){
                         $places_disp_L3CM=$places_disp_L3CM-1;
                          $orientation = "4553";
                          }else{
                             // aucune place disponible - traitement choix3
                            if ($etudiant->choix3 <> NULL){
                             if($etudiant->choix3 == "A454"){
                              if($places_disp_L3E > 0){
                         $places_disp_L3E=$places_disp_L3E-1;
                          $orientation = "A454";
                          }else{echo "Tweswiss";}
                             }
                             if($etudiant->choix3 == "A459"){
                              if($places_disp_L3GM > 0){
                              $places_disp_L3GM=$places_disp_L3GM-1;
                              $orientation = "A459";
                              }else{echo "Tweswiss";}}
                             if($etudiant->choix3 == "4553"){
                              if($places_disp_L3CM > 0){
                              $places_disp_L3CM=$places_disp_L3CM-1;
                              $orientation = "4553";
                              }else{echo "Tweswiss";}
                             }
                            }else{
                              // choix 3 = null
                            } 
                          }
                        }
                 }else{
                  // choix 2 null
                 }
               } 
              } 
           }else{
             // Choix1 = NULL
            
           }
           
           }else{
           // fiche de voeux non remplie : fichevoeux_remp = 0
            if(empty($file_attente)){ $file_attente[0] = $etudiant;}
            else{$file_attente[count($file_attente)-1] = $etudiant;}
            
           }
             // continuer dans le foreach 
       DB::table('gm')-> where([
     ['matricule', '=', $etudiant->matricule],
    ['nom_prenom', '=', $etudiant->nom_prenom]
     ])->update(['orientation' => $orientation]); 
       

           }
      }

       
      }


 //----------------------------------------------------------------------------------
    public function pretraitement_traitement(){
    
    //----------------------------------Prétraitement-------------------------
        // self::supp_ajr_l2();    
        // self::supp_doublants_l2l3();
        // self::calcul_mc();
    //-----------------------------------Traitement---------------------------
     self::orientation();
    echo "orientation done";
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