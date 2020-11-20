<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class L3GP extends Model
{
   protected $table = 'l3gp';
    protected $fillable = [
         'matricule' , 'nom_prenom' ,  'resultat' , 'specialite','section',
    ];
}
