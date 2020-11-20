<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class L3GM extends Model
{
   protected $table = 'l3gm';
    protected $fillable = [
         'matricule' , 'nom_prenom' ,  'resultat' , 'specialite','section',
    ];
}
