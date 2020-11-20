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

 //----------------------------------------------------------------------------------
    public function pretraitement_traitement(){
    
    //----------------------------------Prétraitement-------------------------
        // self::supp_ajr_l2();    
        // self::supp_doublants_l2l3();
        // self::calcul_mc();
    //-----------------------------------Traitement---------------------------

       


      return back();
        }

 //----------------------------------------------------------------------------------

public function refaire_traitement(){
             DB::statement("TRUNCATE TABLE gm");
             DB::statement("TRUNCATE TABLE l3gm");
             DB::statement("TRUNCATE TABLE fichevoeuxgm");
             return back();

        }


}