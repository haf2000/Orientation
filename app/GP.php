<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GP extends Model
{
     protected $table = 'gp';
    protected $fillable = [
         'matricule' , 'nom_prenom' ,  'moy_s1' , 'moy_s2','moy_an' ,'resultat' ,'choix1' ,'choix2' , 'session','section', 'r', 'mc', 'orientation'
    ];
}
