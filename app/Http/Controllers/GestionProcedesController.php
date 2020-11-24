<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GP;
use App\L3GP;
use DB;
use App\Exports\GPTotalExport;
use App\Exports\SectionCExport; 
use App\Exports\SectionDExport; 
use App\Exports\SectionEExport; 
use App\Exports\SectionFExport; 
use App\Exports\SectionGExport; 
use App\Exports\SpecialiteGPExport;
use App\Exports\SpecialiteRPExport;
use Maatwebsite\Excel\Facades\Excel;
class GestionProcedesController extends Controller
{
   
   public function supp_ajr_l2(){
      GP::where('resultat', '=', 'AJR')->delete();
    }
 //---------------------------------------------------------------------------
      public function supp_doublants_l2l3(){
        $etudiants = DB::table('l3gp')->
                     select('matricule','nom_prenom')
                     ->get();
        foreach ($etudiants as $etudiant) {
      DB::table('gp')->
      where([
     ['matricule', '=', $etudiant->matricule ],
     ['nom_prenom', '=', $etudiant->nom_prenom],
     ])->delete();
        	
         }
    }
 //---------------------------------------------------------------------------
      public function calcul_mc(){
        // calcul session
         DB::table('gp')->where('session','=','1')->update(['session' => '0']);
         DB::table('gp')->where('session','=','2')->update(['session' => '1']);
        
        // calcul R : années de retard
          $annee_cours = date("Y"); 
          $matricule_errone = '0';
           $annee_cours = "2019";
         $fiches = DB::table('fichevoeuxgp')-> select('matricule','nom','prenom','choix1','choix2','nationalite')->get();

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
                if($fiche->nationalite == "213")
                  { $r = $difference-2; }
                  else{
                    if($fiche->nationalite == null){ $r = $difference-2; }else{ $r = $difference-4;}
                  
                  }
              
      DB::table('gp')-> where([
     ['matricule', '=', $matric],
    ['nom_prenom', '=', $NP]
     ])->update(['r' => $r]);  

              }
              if( ($fiche->choix1 <> null) and ($fiche->choix2 <> null))
               {$fichevoeux_remp_null='1';}else{$fichevoeux_remp_null='0';}
                 DB::table('gp')-> where([
     ['matricule', '=', $matric],
    ['nom_prenom', '=', $NP]
     ])->update(['choix1' => $fiche->choix1,'choix2' => $fiche->choix2,'fichevoeux_remp' => $fichevoeux_remp_null]);
                 }
                     // calcul mc = MG * (1-0.04*(R+session/4))
        DB::statement("UPDATE `gp` SET `mc`= `moy_an`*(1-0.04*(`r`+(`session`/4))) ");
         
          }

 //---------------------------------------------------------------------------
   public function calcul_ajr_par_specialiteL3()
{

  $ajournes = DB::table('l3gp')
  ->where('resultat','=','AJR')
  ->selectRaw('count(id) as nombre_ajr, specialite')
  ->groupBy('specialite')
  ->get();
  $i=0;
   $nombre_ajournes_par_spec = array("L3GP" => 0,"L3RP" => 0) ;
   foreach ($ajournes as $ajourne) {
   
   if($ajourne->specialite == "57"){$nombre_ajournes_par_spec["L3GP"] = $ajourne->nombre_ajr;}
   if($ajourne->specialite == "B4571"){$nombre_ajournes_par_spec["L3RP"] = $ajourne->nombre_ajr;}
   }

   return $nombre_ajournes_par_spec;

}
 //---------------------------------------------------------------------------
public function calcul_total_orient_X(){
  $ajournes = DB::table('gp')
  ->selectRaw('count(id) as total_orient')
  ->get();
  foreach ($ajournes as $ajourne) {
    $x = $ajourne->total_orient;
  }
  
  return $x;
 }

 //---------------------------------------------------------------------------
 public function calcul_nbr_places_disp_pr_chaque_specialite(){
/*Zi = ( (X+Total des ajournés L3)/2  ) - Nombre des ajournés par spécialité*/
   $places_disp_par_spec = array("L3GP" => 0,"L3RP" => 0) ;
   $x= self::calcul_total_orient_X();
   $nombre_ajournes_par_spec = self::calcul_ajr_par_specialiteL3();
   
   $total_ajournes = intval($nombre_ajournes_par_spec["L3GP"])+intval($nombre_ajournes_par_spec["L3RP"]);
  
  $places_disp_par_spec_float_L3GP = (($x+$total_ajournes)/2) - intval($nombre_ajournes_par_spec["L3GP"]); 
  $places_disp_par_spec_float_L3RP = (($x+$total_ajournes)/2) - intval($nombre_ajournes_par_spec["L3RP"]); 
 

  $places_disp_par_spec_float_L3GP =   $places_disp_par_spec_float_L3GP- floor(  $places_disp_par_spec_float_L3GP);
  $places_disp_par_spec_float_L3RP =   $places_disp_par_spec_float_L3RP - floor(  $places_disp_par_spec_float_L3RP);

  $places_disp_par_spec["L3GP"] = ceil((($x+$total_ajournes)/2) - intval($nombre_ajournes_par_spec["L3GP"]));
  $places_disp_par_spec["L3RP"] = ceil((($x+$total_ajournes)/2) - intval($nombre_ajournes_par_spec["L3RP"])); 
 

  $total =$places_disp_par_spec["L3GP"]+ $places_disp_par_spec["L3RP"];
   $x =  self::calcul_total_orient_X();

    while (  $x <>  $total) {
     if($x < $total){
     $min = min( $places_disp_par_spec_float_L3GP,$places_disp_par_spec_float_L3RP);

     if($min ==  $places_disp_par_spec_float_L3GP and $places_disp_par_spec_float_L3GP <> 1){
      $places_disp_par_spec["L3GP"] = $places_disp_par_spec["L3GP"]-1;
      $places_disp_par_spec_float_L3GP = 1;
     }else{
       if($min ==  $places_disp_par_spec_float_L3RP and $places_disp_par_spec_float_L3RP <> 1){
     $places_disp_par_spec["L3RP"] = $places_disp_par_spec["L3RP"]-1;
    $places_disp_par_spec_float_L3RP = 1;
       }
     }
    
     $total = $total -1;
     }
    }
   return $places_disp_par_spec;
  }

 //---------------------------------------------------------------------------
  public function calcul_taux_reussite(){
/*taux de réussite = (Nombre d’étudiants à orienter (admis) par section/Le nombre total X)*100*/
   $sections = DB::table('gp')
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

 //---------------------------------------------------------------------------
      public function calcul_places_dispo_section_specialite(){
/*calcul de places disponibles pour chaque section pour les 3 spécialités = Taux de réussite * (Z-Ajournés)*/
     // Les lignes = les sections / les colonnes sont les spécialités
    $matrice = array('A','B','C','D','E');
    $matrice['A'] = array('L3GP','L3RP');
    $matrice['B'] = array('L3GP','L3RP');
    $matrice['C'] = array('L3GP','L3RP');
    $matrice['D'] = array('L3GP','L3RP');
    $matrice['E'] = array('L3GP','L3RP');

     $taux_reussite = self::calcul_taux_reussite();
     $places_disp_par_spec = self::calcul_nbr_places_disp_pr_chaque_specialite();
       
      // section A
     $matrice_A_L3GP_float = ($taux_reussite['A'] * $places_disp_par_spec['L3GP'] )- floor($taux_reussite['A'] * $places_disp_par_spec['L3GP']);
     $matrice_A_L3RP_float = ($taux_reussite['A'] * $places_disp_par_spec['L3RP'])- floor($taux_reussite['A'] * $places_disp_par_spec['L3RP']);


     $matrice['A']['L3GP'] =  ceil($taux_reussite['A'] * $places_disp_par_spec['L3GP']);
     $matrice['A']['L3RP'] =  ceil($taux_reussite['A'] * $places_disp_par_spec['L3RP']);

     $x =  self::recup_nbr_orient_par_sect('A');
     $total = $matrice['A']['L3GP'] + $matrice['A']['L3RP'];

    while (  $x <>  $total) {
     if($x < $total){
     $min = min($matrice_A_L3GP_float,$matrice_A_L3RP_float);
     
     if($min == $matrice_A_L3GP_float and  $matrice_A_L3GP_float <> 1){
       $matrice['A']['L3GP'] =  $matrice['A']['L3GP'] -1;
       $matrice_A_L3GP_float = 1;
     }else{
       if($min == $matrice_A_L3RP_float and $matrice_A_L3RP_float <> 1  ){
           $matrice['A']['L3RP'] =  $matrice['A']['L3RP'] -1;
           $matrice_A_L3RP_float = 1;
       }
     }
    
     $total = $total -1;
     }
    }


      // section B

    $matrice_B_L3GP_float = ($taux_reussite['B'] * $places_disp_par_spec['L3GP'] )- floor($taux_reussite['B'] * $places_disp_par_spec['L3GP']);
     $matrice_B_L3RP_float = ($taux_reussite['B'] * $places_disp_par_spec['L3RP'])- floor($taux_reussite['B'] * $places_disp_par_spec['L3RP']);


     $matrice['B']['L3GP'] =  ceil($taux_reussite['B'] * $places_disp_par_spec['L3GP']);
     $matrice['B']['L3RP'] =  ceil($taux_reussite['B'] * $places_disp_par_spec['L3RP']);

     $x =  self::recup_nbr_orient_par_sect('B');
     $total = $matrice['B']['L3GP'] + $matrice['B']['L3RP'];

    while (  $x <>  $total) {
     if($x < $total){
     $min = min($matrice_B_L3GP_float,$matrice_B_L3RP_float);
     
     if($min == $matrice_B_L3GP_float and  $matrice_B_L3GP_float <> 1){
       $matrice['B']['L3GP'] =  $matrice['B']['L3GP'] -1;
       $matrice_B_L3GP_float = 1;
     }else{
       if($min == $matrice_B_L3RP_float and $matrice_B_L3RP_float <> 1  ){
           $matrice['B']['L3RP'] =  $matrice['B']['L3RP'] -1;
           $matrice_B_L3RP_float = 1;
       }
     }
    
     $total = $total -1;
     }
    }

      // section C

      $matrice_C_L3GP_float = ($taux_reussite['C'] * $places_disp_par_spec['L3GP'] )- floor($taux_reussite['C'] * $places_disp_par_spec['L3GP']);
     $matrice_C_L3RP_float = ($taux_reussite['C'] * $places_disp_par_spec['L3RP'])- floor($taux_reussite['C'] * $places_disp_par_spec['L3RP']);


     $matrice['C']['L3GP'] =  ceil($taux_reussite['C'] * $places_disp_par_spec['L3GP']);
     $matrice['C']['L3RP'] =  ceil($taux_reussite['C'] * $places_disp_par_spec['L3RP']);

     $x =  self::recup_nbr_orient_par_sect('C');
     $total = $matrice['C']['L3GP'] + $matrice['C']['L3RP'];

    while (  $x <>  $total) {
     if($x < $total){
     $min = min($matrice_C_L3GP_float,$matrice_C_L3RP_float);
     
     if($min == $matrice_C_L3GP_float and  $matrice_C_L3GP_float <> 1){
       $matrice['C']['L3GP'] =  $matrice['C']['L3GP'] -1;
       $matrice_C_L3GP_float = 1;
     }else{
       if($min == $matrice_C_L3RP_float and $matrice_C_L3RP_float <> 1  ){
           $matrice['C']['L3RP'] =  $matrice['C']['L3RP'] -1;
           $matrice_C_L3RP_float = 1;
       }
     }
    
     $total = $total -1;
     }
    }

      // section D

     $matrice_D_L3GP_float = ($taux_reussite['D'] * $places_disp_par_spec['L3GP'] )- floor($taux_reussite['D'] * $places_disp_par_spec['L3GP']);
     $matrice_D_L3RP_float = ($taux_reussite['D'] * $places_disp_par_spec['L3RP'])- floor($taux_reussite['D'] * $places_disp_par_spec['L3RP']);


     $matrice['D']['L3GP'] =  ceil($taux_reussite['D'] * $places_disp_par_spec['L3GP']);
     $matrice['D']['L3RP'] =  ceil($taux_reussite['D'] * $places_disp_par_spec['L3RP']);

     $x =  self::recup_nbr_orient_par_sect('D');
     $total = $matrice['D']['L3GP'] + $matrice['D']['L3RP'];

    while (  $x <>  $total) {
     if($x < $total){
     $min = min($matrice_D_L3GP_float,$matrice_D_L3RP_float);
     
     if($min == $matrice_D_L3GP_float and  $matrice_D_L3GP_float <> 1){
       $matrice['D']['L3GP'] =  $matrice['D']['L3GP'] -1;
       $matrice_D_L3GP_float = 1;
     }else{
       if($min == $matrice_D_L3RP_float and $matrice_D_L3RP_float <> 1  ){
           $matrice['D']['L3RP'] =  $matrice['D']['L3RP'] -1;
           $matrice_D_L3RP_float = 1;
       }
     }
    
     $total = $total -1;
     }
    }
      // section E

    $matrice_E_L3GP_float = ($taux_reussite['E'] * $places_disp_par_spec['L3GP'] )- floor($taux_reussite['E'] * $places_disp_par_spec['L3GP']);
     $matrice_E_L3RP_float = ($taux_reussite['E'] * $places_disp_par_spec['L3RP'])- floor($taux_reussite['E'] * $places_disp_par_spec['L3RP']);


     $matrice['E']['L3GP'] =  ceil($taux_reussite['E'] * $places_disp_par_spec['L3GP']);
     $matrice['E']['L3RP'] =  ceil($taux_reussite['E'] * $places_disp_par_spec['L3RP']);

     $x =  self::recup_nbr_orient_par_sect('E');
     $total = $matrice['E']['L3GP'] + $matrice['E']['L3RP'];

    while (  $x <>  $total) {
     if($x < $total){
     $min = min($matrice_E_L3GP_float,$matrice_E_L3RP_float);
     
     if($min == $matrice_E_L3GP_float and  $matrice_E_L3GP_float <> 1){
       $matrice['E']['L3GP'] =  $matrice['E']['L3GP'] -1;
       $matrice_E_L3GP_float = 1;
     }else{
       if($min == $matrice_E_L3RP_float and $matrice_E_L3RP_float <> 1  ){
           $matrice['E']['L3RP'] =  $matrice['E']['L3RP'] -1;
           $matrice_E_L3RP_float = 1;
       }
     }
    
     $total = $total -1;
     }
    }

     return  $matrice;
   }
 //---------------------------------------------------------------------------
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
      $places_disp_L3GP = $places_dispo_par_spec['L3GP'];
      $places_disp_L3RP = $places_dispo_par_spec['L3RP'];
      
      // faire le classement selon la moyenne corrigée pour chaque section
          $etudiants_section_classes_par_mc = DB::table('gp')->
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
              if($etudiant->choix1 == "57"){ // condition 1 choix 1
               if($places_disp_L3GP > 0){
                $places_disp_L3GP=$places_disp_L3GP-1;
                $orientation = "57";
               }
               else{
                // aucune place disponible - traitement choix2
                if ($etudiant->choix2 <> NULL){
                       
                        if($etudiant->choix2 == "B4571"){ // condition2 choix2
                           if($places_disp_L3RP > 0){
                         $places_disp_L3RP=$places_disp_L3RP-1;
                          $orientation = "B4571";
                          }
                        }
                 
                }
               } 
              }


              if($etudiant->choix1 == "B4571"){ // condition 2 choix 1
                if($places_disp_L3RP > 0){
                $places_disp_L3RP=$places_disp_L3RP-1;
                $orientation = "B4571";
               }
               else{
                // aucune place disponible - traitement choix 2
                 if ($etudiant->choix2 <> NULL){
                     if($etudiant->choix2 == "57"){ // condition1 choix2
                          if($places_disp_L3GP > 0){
                         $places_disp_L3GP=$places_disp_L3GP-1;
                          $orientation = "57";
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
       DB::table('gp')-> where([
     ['matricule', '=', $etudiant->matricule],
    ['nom_prenom', '=', $etudiant->nom_prenom]
     ])->update(['orientation' => $orientation]); 
       

           }
        
        // traitement des elements  de la file d'attente 
            
        
           for ($j=0; $j < count($file_attente) ; $j++) { 
             $orientation_fa="";
             if( $places_disp_L3GP <> 0){
               $orientation_fa = "57";
               $places_disp_L3GP=$places_disp_L3GP-1;
             }else{
              
                $orientation_fa = "B4571";
                $places_disp_L3RP=$places_disp_L3RP-1;
              
             }
            // continuer dans la boucle for de la file d'attente
                
                DB::table('gp')-> where([
     ['matricule', '=', $file_attente[$j]->matricule],
    ['nom_prenom', '=', $file_attente[$j]->nom_prenom]
     ])->update(['orientation' => $orientation_fa]); 
           
           }
           


      }

       
      }
 //---------------------------------------------------------------------------
 //---------------------------------------------------------------------------
      public function recup_nbr_orient_par_sect($section){
   $orientes_par_sect = DB::table('gp')
  ->selectRaw('count(id) as total_orient_sect')
  ->where('section','=',$section)
  ->get();
  foreach ($orientes_par_sect as $oriente_par_sect) {
    $x = $oriente_par_sect->total_orient_sect;
  }  

  return $x;
}
 //---------------------------------------------------------------------------
 //---------------------------------------------------------------------------

    public function pretraitement_traitement(){
       self::supp_ajr_l2();    
       self::supp_doublants_l2l3();
       self::calcul_mc();
       self::orientation();
       return back();
        }

 //---------------------------------------------------------------------------
        public function refaire_traitement(){
             DB::statement("TRUNCATE TABLE gp");
             DB::statement("TRUNCATE TABLE l3gp");
             DB::statement("TRUNCATE TABLE fichevoeuxgp");
             return back();

        }

 //---------------------------------------------------------------------------

  public function export_GPtotal() 
    {
        return Excel::download(new GPTotalExport, 'Total GP.xlsx');
        
    }
//------------------------------------------------------------------------------
        public function export_section_C() 
    {
        return Excel::download(new SectionCExport, 'GP section C.xlsx');
        
    }
 //----------------------------------------------------------------------------------
    public function export_section_D() 
    {
        return Excel::download(new SectionDExport, 'GP section D.xlsx');
        
    }
 //----------------------------------------------------------------------------------
    public function export_section_E() 
    {
        return Excel::download(new SectionEExport, 'GP section E.xlsx');
        
    }
 //----------------------------------------------------------------------------------
    public function export_section_F() 
    {
        return Excel::download(new SectionFExport, 'GP section F.xlsx');
        
    }
    //----------------------------------------------------------------------------------
    public function export_section_G() 
    {
        return Excel::download(new SectionGExport, 'GP section G.xlsx');
        
    }
    //---------------------------------------------------------------------------------- 
    public function export_spec_L3GP() 
    {
        return Excel::download(new SpecialiteGPExport, 'GP spécialité GP.xlsx');
        
    }
    //----------------------------------------------------------------------------------
    public function export_spec_L3RP() 
    {
        return Excel::download(new SpecialiteRPExport, 'GP spécialité RP.xlsx');
        
    }

}
