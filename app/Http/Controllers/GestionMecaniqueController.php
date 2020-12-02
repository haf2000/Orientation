<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GM;
use App\L3GM;
use DB;
use App\Exports\GMTotalExport; 
use App\Exports\SectionHExport; 
use App\Exports\SectionIExport; 
use App\Exports\SectionJExport; 
use App\Exports\SectionKExport; 
use App\Exports\SectionLExport; 
use App\Exports\SpecialiteEnergExport;
use App\Exports\SpecialiteGMExport;
use App\Exports\SpecialiteCMExport;
use Maatwebsite\Excel\Facades\Excel;
class GestionMecaniqueController extends Controller
{

//----------------------------------Prétraitement-------------------------

//-------------------------------
    public function supp_ajr_l2(){
      GM::where('resultat', '=', 'AJR')->delete();
    }
//--------------------------------
    // public function supp_anet_3(){
    //   DB::table('fichevoeuxgm')->where('anet', '=', '3')->delete();
    // }
//--------------------------------
     public function supp_doublants_l2l3(){
        $etudiants = DB::table('l3gm')->
                     select('matricule','nom_prenom')
                     ->get();
        foreach ($etudiants as $etudiant) {
      DB::table('gm')->
      where([
     ['matricule', '=', $etudiant->matricule ],
    
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
          $annee_cours ="2019";
          $matricule_errone = '0';
       
         $fiches = DB::table('fichevoeuxgm')-> select('matricule','nom','prenom','choix1','choix2','choix3','nationalite')->get();

          foreach ($fiches as $fiche) {
            $matric = substr($fiche->matricule,1,12);
          	$NP = $fiche->nom." ".$fiche->prenom;
            $num_matricule =substr($fiche->matricule,1,2);
            if($num_matricule == "20"){
               $annee_matricule =substr($fiche->matricule,1,4);
           
            }else{ $annee_matricule = "20".$num_matricule;}
           
            $difference = intval($annee_cours)-intval($annee_matricule);
            if($difference >= 2)  
            	{
                $r=0;
                if($fiche->nationalite == "213")
                  { $r = $difference-2; }
                  else{
                    if($fiche->nationalite == null){ $r = $difference-2; }else{ $r = $difference-4;}
                  
                  }
             
      DB::table('gm')-> where([
     ['matricule', '=', $matric],
     ['nom_prenom', '=', $NP],
     ])->update(['r' => $r]);  

              }
               // echo "etudiant de matricule : ".$fiche->matricule." | année en cours : ".$annee_cours." | année matricule : ".$annee_matricule." | r : ".$r." | choix 1 / choix2 / choix3 :  ". $fiche->choix1."/ ".$fiche->choix2."/ ".$fiche->choix3."<br>";
              if( ($fiche->choix1 <> null) and ($fiche->choix2 <> null) and ($fiche->choix3 <> null) ){$fichevoeux_remp_null='1';}else{$fichevoeux_remp_null='0';}
                 DB::table('gm')-> where([
     ['matricule', '=', $matric],
     ['nom_prenom', '=', $NP],
     ])->update(['choix1' => $fiche->choix1,'choix2' => $fiche->choix2,'choix3' => $fiche->choix3,'fichevoeux_remp' => $fichevoeux_remp_null]);
                 }
                     // calcul mc = MG * (1-0.04*(R+session/4))
        DB::statement("UPDATE `gm` SET `mc`= `moy_an`*(1-0.04*(`r`+(`session`/4)))");
         
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
 public function arrondi($nombre){
   $partie_flottante = $nombre - floor($nombre);
   if ($partie_flottante >= 0.5){
     $resultat = floor($nombre) + 1;
   }
   else{
    $resultat = $nombre - $partie_flottante;
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
  
  // $places_disp_par_spec_float_L3E = (($x+$total_ajournes)/3) - intval($nombre_ajournes_par_spec["L3E"]); 
  // $places_disp_par_spec_float_L3GM = (($x+$total_ajournes)/3) - intval($nombre_ajournes_par_spec["L3GM"]); 
  // $places_disp_par_spec_float_L3CM = (($x+$total_ajournes)/3) - intval($nombre_ajournes_par_spec["L3CM"]); 
  

  // $places_disp_par_spec_float_L3E =  $places_disp_par_spec_float_L3E - floor( $places_disp_par_spec_float_L3E );
  // $places_disp_par_spec_float_L3GM =  $places_disp_par_spec_float_L3GM - floor( $places_disp_par_spec_float_L3GM );
  // $places_disp_par_spec_float_L3CM =  $places_disp_par_spec_float_L3CM - floor( $places_disp_par_spec_float_L3CM );

  $places_disp_par_spec["L3E"] = self::arrondi((($x+$total_ajournes)/3) - intval($nombre_ajournes_par_spec["L3E"]));
  $places_disp_par_spec["L3GM"] = self::arrondi((($x+$total_ajournes)/3) - intval($nombre_ajournes_par_spec["L3GM"])); 
  $places_disp_par_spec["L3CM"] = self::arrondi((($x+$total_ajournes)/3) - intval($nombre_ajournes_par_spec["L3CM"])); 
 

  $total =$places_disp_par_spec["L3E"]+ $places_disp_par_spec["L3GM"]+ $places_disp_par_spec["L3CM"];

   $x =  self::calcul_total_orient_X();
   

    while (  $x <>  $total) {
     if($x < $total){
     // $min = min( $places_disp_par_spec_float_L3E, $places_disp_par_spec_float_L3GM, $places_disp_par_spec_float_L3CM);
     // if($min ==  $places_disp_par_spec_float_L3E and  $places_disp_par_spec_float_L3E <> 1){
     //  $places_disp_par_spec["L3E"] = $places_disp_par_spec["L3E"]-1;
     //  $places_disp_par_spec_float_L3E = 1;
     // }else{
     //   if($min ==  $places_disp_par_spec_float_L3GM and $places_disp_par_spec_float_L3GM <> 1){
     // $places_disp_par_spec["L3GM"] = $places_disp_par_spec["L3GM"]-1;
     // $places_disp_par_spec_float_L3GM = 1;
     //   }else{
     //    if ($places_disp_par_spec_float_L3CM <> 1) {
     //      $places_disp_par_spec["L3CM"]= $places_disp_par_spec["L3CM"]-1;
     //  $places_disp_par_spec_float_L3CM = 1;
     //    }
    
     //   }
     // }

     $places_disp_par_spec["L3CM"] = $places_disp_par_spec["L3CM"] -1;
     $total = $total -1;
     }else{
        if($x > $total){
     $places_disp_par_spec["L3E"] = $places_disp_par_spec["L3E"] +1;
     $total = $total +1;
        }
     }
    }

    
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
     // $matrice_A_L3E_float = ($taux_reussite['A'] * $places_disp_par_spec['L3E'] )- floor($taux_reussite['A'] * $places_disp_par_spec['L3E']);
     // $matrice_A_L3GM_float = ($taux_reussite['A'] * $places_disp_par_spec['L3GM'])- floor($taux_reussite['A'] * $places_disp_par_spec['L3GM']);
     // $matrice_A_L3CM_float = ($taux_reussite['A'] * $places_disp_par_spec['L3CM']) - floor ($taux_reussite['A'] * $places_disp_par_spec['L3CM']);

     $matrice['A']['L3E'] =  self::arrondi($taux_reussite['A'] * $places_disp_par_spec['L3E']);
     $matrice['A']['L3GM'] =  self::arrondi($taux_reussite['A'] * $places_disp_par_spec['L3GM']);
     $matrice['A']['L3CM'] =  self::arrondi($taux_reussite['A'] * $places_disp_par_spec['L3CM']);  

     $x =  self::recup_nbr_orient_par_sect('A');
     $total = $matrice['A']['L3E'] + $matrice['A']['L3GM']+ $matrice['A']['L3CM'];

    while (  $x <>  $total) {
     if($x < $total){
     // $min = min($matrice_A_L3E_float,$matrice_A_L3GM_float,$matrice_A_L3CM_float);
     // if($min == $matrice_A_L3E_float and  $matrice_A_L3E_float <> 1){
     //   $matrice['A']['L3E'] =  $matrice['A']['L3E'] -1;
     //   $matrice_A_L3E_float = 1;
     // }else{
     //   if($min == $matrice_A_L3GM_float and $matrice_A_L3GM_float <> 1  ){
     //       $matrice['A']['L3GM'] =  $matrice['A']['L3GM'] -1;
     //       $matrice_A_L3GM_float = 1;
     //   }else{
     //    if ( $matrice_A_L3CM_float <> 1  ) {
     //      $matrice['A']['L3CM'] =  $matrice['A']['L3CM'] -1;
     //       $matrice_A_L3CM_float = 1;
     //    }
    
     //   }
     // }
     $matrice['A']['L3CM'] = $matrice['A']['L3CM'] -1;
     $total = $total -1;
     }else{
      if($x > $total){
        $matrice['A']['L3E'] = $matrice['A']['L3E'] +1;
     $total = $total +1;
      }
     }
    }


      // section B



     $matrice['B']['L3E'] =  self::arrondi($taux_reussite['B'] * $places_disp_par_spec['L3E']);
     $matrice['B']['L3GM'] =  self::arrondi($taux_reussite['B'] * $places_disp_par_spec['L3GM']);
     $matrice['B']['L3CM'] =  self::arrondi($taux_reussite['B'] * $places_disp_par_spec['L3CM']);  

     $x =  self::recup_nbr_orient_par_sect('B');
     $total = $matrice['B']['L3E'] + $matrice['B']['L3GM']+ $matrice['B']['L3CM'];

    while (  $x <>  $total) {
     if($x < $total){
     // $min = min($matrice_B_L3E_float,$matrice_B_L3GM_float,$matrice_B_L3CM_float);
     // if($min == $matrice_B_L3E_float and  $matrice_B_L3E_float <> 1){
     //   $matrice['B']['L3E'] =  $matrice['B']['L3E'] -1;
     //   $matrice_B_L3E_float = 1;
     // }else{
     //   if($min == $matrice_B_L3GM_float and $matrice_B_L3GM_float <> 1  ){
     //       $matrice['B']['L3GM'] =  $matrice['B']['L3GM'] -1;
     //       $matrice_B_L3GM_float = 1;
     //   }else{
     //    if ( $matrice_B_L3CM_float <> 1  ) {
     //      $matrice['B']['L3CM'] =  $matrice['B']['L3CM'] -1;
     //       $matrice_B_L3CM_float = 1;
     //    }
    
     //   }
     // }
    $matrice['B']['L3CM'] = $matrice['B']['L3CM'] -1;
     $total = $total -1;
     }else{
      if($x > $total){
       $matrice['B']['L3E'] = $matrice['B']['L3E'] +1;
     $total = $total +1;
      }
     }
    }

      //section C
    

     $matrice['C']['L3E'] =  self::arrondi($taux_reussite['C'] * $places_disp_par_spec['L3E']);
     $matrice['C']['L3GM'] =  self::arrondi($taux_reussite['C'] * $places_disp_par_spec['L3GM']);
     $matrice['C']['L3CM'] =  self::arrondi($taux_reussite['C'] * $places_disp_par_spec['L3CM']);  

     $x =  self::recup_nbr_orient_par_sect('C');
     $total = $matrice['C']['L3E'] + $matrice['C']['L3GM']+ $matrice['C']['L3CM'];

    while (  $x <>  $total) {
     if($x < $total){
     // $min = min($matrice_C_L3E_float,$matrice_C_L3GM_float,$matrice_C_L3CM_float);
     // if($min == $matrice_C_L3E_float and  $matrice_C_L3E_float <> 1){
     //   $matrice['C']['L3E'] =  $matrice['C']['L3E'] -1;
     //   $matrice_C_L3E_float = 1;
     // }else{
     //   if($min == $matrice_C_L3GM_float and $matrice_C_L3GM_float <> 1  ){
     //       $matrice['C']['L3GM'] =  $matrice['C']['L3GM'] -1;
     //       $matrice_C_L3GM_float = 1;
     //   }else{
     //    if ( $matrice_C_L3CM_float <> 1  ) {
     //      $matrice['C']['L3CM'] =  $matrice['C']['L3CM'] -1;
     //       $matrice_C_L3CM_float = 1;
     //    }
    
     //   }
     // }
      $matrice['C']['L3CM'] =  $matrice['C']['L3CM'] -1;
     $total = $total -1;
     }else{
       if($x > $total){
       $matrice['C']['L3E'] = $matrice['C']['L3E'] + 1;
       $total = $total +1;
       }
     }
    }



      // section D

     $matrice['D']['L3E'] =  ceil($taux_reussite['D'] * $places_disp_par_spec['L3E']);
     $matrice['D']['L3GM'] =  ceil($taux_reussite['D'] * $places_disp_par_spec['L3GM']);
     $matrice['D']['L3CM'] =  ceil($taux_reussite['D'] * $places_disp_par_spec['L3CM']);  

     $x =  self::recup_nbr_orient_par_sect('D');
     $total = $matrice['D']['L3E'] + $matrice['D']['L3GM']+ $matrice['D']['L3CM'];

    while (  $x <>  $total) {
     if($x < $total){
     // $min = min($matrice_D_L3E_float,$matrice_D_L3GM_float,$matrice_D_L3CM_float);

     // if($min == $matrice_D_L3E_float and  $matrice_D_L3E_float <> 1){

     //   $matrice['D']['L3E'] =  $matrice['D']['L3E'] -1;
     //   $matrice_D_L3E_float = 1;
     // }else{
     //   if($min == $matrice_D_L3GM_float and $matrice_D_L3GM_float <> 1  ){
     //       $matrice['D']['L3GM'] =  $matrice['D']['L3GM'] -1;
     //       $matrice_D_L3GM_float = 1;
     //   }else{
     //    if ( $matrice_D_L3CM_float <> 1  ) {
     //      $matrice['D']['L3CM'] =  $matrice['D']['L3CM'] -1;
     //       $matrice_D_L3CM_float = 1;
     //    }
    
     //   }
     // }
      $matrice['D']['L3CM'] =  $matrice['D']['L3CM'] -1;    
     $total = $total -1;
     }else{
      if($x > $total){
     $matrice['D']['L3E'] =  $matrice['D']['L3E'] +1;    
     $total = $total +1;
      }
     }
    }


      // section E
 
     $matrice['E']['L3E'] =  ceil($taux_reussite['E'] * $places_disp_par_spec['L3E']);
     $matrice['E']['L3GM'] =  ceil($taux_reussite['E'] * $places_disp_par_spec['L3GM']);
     $matrice['E']['L3CM'] =  ceil($taux_reussite['E'] * $places_disp_par_spec['L3CM']);  

     $x = self::recup_nbr_orient_par_sect('E');
     $total = $matrice['E']['L3E'] + $matrice['E']['L3GM']+ $matrice['E']['L3CM'];

    while (  $x <>  $total) {
     if($x < $total){
     // $min = min($matrice_E_L3E_float,$matrice_E_L3GM_float,$matrice_E_L3CM_float);

     // if($min == $matrice_E_L3E_float and  $matrice_E_L3E_float <> 1){

     //   $matrice['E']['L3E'] =  $matrice['E']['L3E'] -1;
     //   $matrice_E_L3E_float = 1;
     // }else{
     //   if($min == $matrice_E_L3GM_float and $matrice_E_L3GM_float <> 1  ){
     //       $matrice['E']['L3GM'] =  $matrice['E']['L3GM'] -1;
     //       $matrice_E_L3GM_float = 1;
     //   }else{
     //    if ( $matrice_E_L3CM_float <> 1  ) {
     //      $matrice['E']['L3CM'] =  $matrice['E']['L3CM'] -1;
     //       $matrice_E_L3CM_float = 1;
     //    }
    
     //   }
     // }
     $matrice['E']['L3CM'] =  $matrice['E']['L3CM'] -1;    
     $total = $total -1;
     }else{
      if($x > $total){
    $matrice['E']['L3E'] =  $matrice['E']['L3E'] +1;    
     $total = $total +1;
      }
     }
    } 

     return  $matrice;
   }


 //----------------------------------------------------------------------------------
      public function orientation()
      {
        set_time_limit(1800);
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
                       
                        if($etudiant->choix2 == "A459"){ // condition2 choix2
                           if($places_disp_L3GM > 0){
                         $places_disp_L3GM=$places_disp_L3GM-1;
                          $orientation = "A459";
                          }else{
                          // aucune place disponible - traitement choix3
                            if ($etudiant->choix3 <> NULL){
                             
                              if($etudiant->choix3 == "4553"){
                              if($places_disp_L3CM > 0){
                              $places_disp_L3CM=$places_disp_L3CM-1;
                              $orientation = "4553";
                              }
                             }
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
                            
                             if($etudiant->choix3 == "A459"){
                              if($places_disp_L3GM > 0){
                              $places_disp_L3GM=$places_disp_L3GM-1;
                              $orientation = "A459";
                              }}
                            
                            }
                          }
                        }


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
                             
                             if($etudiant->choix3 == "4553"){
                              if($places_disp_L3CM > 0){
                              $places_disp_L3CM=$places_disp_L3CM-1;
                              $orientation = "4553";
                              }
                             }
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
                          }
                             }
                             
                            }
                          }
                        }

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
                             
                             if($etudiant->choix3 == "A459"){
                              if($places_disp_L3GM > 0){
                              $places_disp_L3GM=$places_disp_L3GM-1;
                              $orientation = "A459";
                              }}
                            
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
                          }
                             }
                            
                           
                            }
                          }
                        }
                 
                 }
               } 
              } 
           }
           
           }else{
           // fiche de voeux non remplie : fichevoeux_remp = 0
            $nombre_elements = count($file_attente); 
             if ($nombre_elements == 0) {
                $file_attente[0] = $etudiant;
             }else{
              $file_attente[$nombre_elements] = $etudiant;
             }
                    
          
            
           }
             // continuer dans le foreach 
       DB::table('gm')-> where([
     ['matricule', '=', $etudiant->matricule],
    ['nom_prenom', '=', $etudiant->nom_prenom]
     ])->update(['orientation' => $orientation]); 
       

           }
        
        // traitement des elements  de la file d'attente 
            
        
           for ($j=0; $j < count($file_attente) ; $j++) { 
             $orientation_fa="";
             if( $places_disp_L3E <> 0){
               $orientation_fa = "A454";
               $places_disp_L3E=$places_disp_L3E-1;
             }else{
               if( $places_disp_L3CM  <> 0){
                $orientation_fa = "4553";
                $places_disp_L3CM=$places_disp_L3CM-1;
               }else{
                if( $places_disp_L3GM  <> 0){
                    $orientation_fa = "A459";
                    $places_disp_L3GM=$places_disp_L3GM-1;
                }
               }
             }
            // continuer dans la boucle for de la file d'attente
                
                
                DB::table('gm')-> where([
     ['matricule', '=', $file_attente[$j]->matricule],
    ['nom_prenom', '=', $file_attente[$j]->nom_prenom]
     ])->update(['orientation' => $orientation_fa]); 
           
           }
           


      }

       
      }


 //----------------------------------------------------------------------------------
public function recup_nbr_orient_par_sect($section){
   $orientes_par_sect = DB::table('gm')
  ->selectRaw('count(id) as total_orient_sect')
  ->where('section','=',$section)
  ->get();
  foreach ($orientes_par_sect as $oriente_par_sect) {
    $x = $oriente_par_sect->total_orient_sect;
  }  

  return $x;
}
 //----------------------------------------------------------------------------------
    public function pretraitement_traitement(){
    
    //----------------------------------Prétraitement-------------------------
   self::supp_ajr_l2();    
   self::supp_doublants_l2l3();
   self::calcul_mc();
    //-----------------------------------Traitement---------------------------
   self::orientation();
  return back();
        }

 //----------------------------------------------------------------------------------

public function refaire_traitement(){
             DB::statement("TRUNCATE TABLE gm");
             DB::statement("TRUNCATE TABLE l3gm");
             DB::statement("TRUNCATE TABLE fichevoeuxgm");
             return back();

        }
 //----------------------------------------------------------------------------------
         public function export_GMtotal() 
    {
        return Excel::download(new GMTotalExport, 'Total GM.xlsx');
        
    }
 //----------------------------------------------------------------------------------
    public function export_section_H() 
    {
        return Excel::download(new SectionHExport, 'GM section H.xlsx');
        
    }
 //----------------------------------------------------------------------------------
    public function export_section_I() 
    {
        return Excel::download(new SectionIExport, 'GM section I.xlsx');
        
    }
 //----------------------------------------------------------------------------------
    public function export_section_J() 
    {
        return Excel::download(new SectionJExport, 'GM section J.xlsx');
        
    }
 //----------------------------------------------------------------------------------
    public function export_section_K() 
    {
        return Excel::download(new SectionKExport, 'GM section K.xlsx');
        
    }
    //----------------------------------------------------------------------------------
    public function export_section_L() 
    {
        return Excel::download(new SectionLExport, 'GM section L.xlsx');
        
    }

    //----------------------------------------------------------------------------------
    public function export_spec_L3E() 
    {
        return Excel::download(new SpecialiteEnergExport, 'GM spécialité Energ.xlsx');
        
    }
    //----------------------------------------------------------------------------------
    public function export_spec_L3GM() 
    {
        return Excel::download(new SpecialiteGMExport, 'GM spécialité GM.xlsx');
        
    }
    //----------------------------------------------------------------------------------
    public function export_spec_L3CM() 
    {
        return Excel::download(new SpecialiteCMExport, 'GM spécialité CM.xlsx');
        
    }
//----------------------------------------------------------------------------------
    public function recup_data_voeux(){
    $data_voeux = array('L3E','L3GM','L3CM');
    $data_voeux['L3E'] = array('choix1','choix2','choix3','sans');
    $data_voeux['L3GM'] = array('choix1','choix2','choix3','sans');
    $data_voeux['L3CM'] = array('choix1','choix2','choix3','sans');
    
    $data_voeux['L3E']['choix1'] = 0;
    $data_voeux['L3E']['choix2'] = 0;
    $data_voeux['L3E']['choix3'] = 0;
    $data_voeux['L3E']['sans'] = 0;
    
    $data_voeux['L3GM']['choix1'] = 0;
    $data_voeux['L3GM']['choix2'] = 0;
    $data_voeux['L3GM']['choix3'] = 0;
    $data_voeux['L3GM']['sans'] = 0;

    $data_voeux['L3CM']['choix1'] = 0;
    $data_voeux['L3CM']['choix2'] = 0;
    $data_voeux['L3CM']['choix3'] = 0;
    $data_voeux['L3CM']['sans'] = 0;
     

     $etudiants = DB::table('gm')->
              select('choix1','choix2','choix3','orientation','fichevoeux_remp')
              ->get();

    foreach ($etudiants as $etudiant) {
     if(($etudiant->fichevoeux_remp == '1') and ($etudiant->choix1 <> null) and($etudiant->choix2 <> null) and ($etudiant->choix3 <> null)){
        // choix non null et a remplie fiche de voeux
          if($etudiant->orientation == $etudiant->choix1){
            // orienté vers le choix 1
            if($etudiant->choix1 == "A454"){
              // L3E
                   $data_voeux['L3E']['choix1'] = $data_voeux['L3E']['choix1']+1; 
            }else{
              // autre : L3GM - L3CM
               if($etudiant->choix1 == "A459"){
                  // choix L3GM
                 $data_voeux['L3GM']['choix1'] = $data_voeux['L3GM']['choix1']+1; 
               }else{ 
                  // choix L3CM
                 $data_voeux['L3CM']['choix1'] = $data_voeux['L3CM']['choix1']+1; 
               }
            }
          }else{
               // orienté vers le choix 2 ou choix 3
             if($etudiant->orientation == $etudiant->choix2){
              // orienté vers le choix 2
                 if($etudiant->choix2 == "A454"){
              // L3E
                   $data_voeux['L3E']['choix2'] = $data_voeux['L3E']['choix2']+1; 
            }else{
              // autre : L3GM - L3CM
               if($etudiant->choix2 == "A459"){
                  // choix L3GM
                 $data_voeux['L3GM']['choix2'] = $data_voeux['L3GM']['choix2']+1; 
               }else{ 
                  // choix L3CM
                 $data_voeux['L3CM']['choix2'] = $data_voeux['L3CM']['choix2']+1; 
               }
            }

             }else{
              // orienté vers le choix 3
                if($etudiant->choix3 == "A454"){
              // L3E
                   $data_voeux['L3E']['choix3'] = $data_voeux['L3E']['choix3']+1; 
            }else{
              // autre : L3GM - L3CM
               if($etudiant->choix3 == "A459"){
                  // choix L3GM
                 $data_voeux['L3GM']['choix3'] = $data_voeux['L3GM']['choix3']+1; 
               }else{ 
                  // choix L3CM
                 $data_voeux['L3CM']['choix3'] = $data_voeux['L3CM']['choix3']+1; 
               }
            }
             }
          }
     }else{
        // soit n'a pas rempli fiche de voeux, soit n'existe pas dans la table de fiches de voeux
        if($etudiant->orientation == "A454"){
              // orienté L3E
           $data_voeux['L3E']['sans'] = $data_voeux['L3E']['sans']+1; 

        }else{
              // orienté L3GM-L3CM
           if($etudiant->orientation == "A459"){
              // orienté L3GM
           $data_voeux['L3GM']['sans'] = $data_voeux['L3GM']['sans']+1; 

           }else{
              // orienté L3CM
           $data_voeux['L3CM']['sans'] = $data_voeux['L3CM']['sans']+1; 
           }

        }
     }

    }
      return $data_voeux;
    }

//---------------------------------------------------
    public function recup_min_max(){
     $resultat = array('A','B','C','D','E');
    $resultat['A'] = array('min','max');
    $resultat['B'] = array('min','max');
    $resultat['C'] = array('min','max');
    $resultat['D'] = array('min','max');
    $resultat['E'] = array('min','max');

     $etudiants = DB::table('gm')
    ->where('section','=','A')
    ->selectRaw('min(mc) as min_mc, max(mc) as max_mc')
    ->get();
    foreach ($etudiants as $etudiant) {
      $resultat['A']['min'] = $etudiant->min_mc;
      $resultat['A']['max'] = $etudiant->max_mc;
    }

    $etudiants = DB::table('gm')
    ->where('section','=','B')
    ->selectRaw('min(mc) as min_mc, max(mc) as max_mc')
    ->get();
    foreach ($etudiants as $etudiant) {
      $resultat['B']['min'] = $etudiant->min_mc;
      $resultat['B']['max'] = $etudiant->max_mc;
    }

    $etudiants = DB::table('gm')
    ->where('section','=','C')
    ->selectRaw('min(mc) as min_mc, max(mc) as max_mc')
    ->get();
    foreach ($etudiants as $etudiant) {
      $resultat['C']['min'] = $etudiant->min_mc;
      $resultat['C']['max'] = $etudiant->max_mc;
    }

     $etudiants = DB::table('gm')
    ->where('section','=','D')
    ->selectRaw('min(mc) as min_mc, max(mc) as max_mc')
    ->get();
    foreach ($etudiants as $etudiant) {
      $resultat['D']['min'] = $etudiant->min_mc;
      $resultat['D']['max'] = $etudiant->max_mc;
    }
    $etudiants = DB::table('gm')
    ->where('section','=','E')
    ->selectRaw('min(mc) as min_mc, max(mc) as max_mc')
    ->get();
    foreach ($etudiants as $etudiant) {
      $resultat['E']['min'] = $etudiant->min_mc;
      $resultat['E']['max'] = $etudiant->max_mc;
    }
      return $resultat;
    }

}