<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GM extends Model
{
   protected $table = 'gm';
    protected $fillable = [
         'matricule' , 'nom_prenom' ,  'moy_s1' , 'moy_s2','moy_an' ,'resultat' , 'session','section',
    ];
}

