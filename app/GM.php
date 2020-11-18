<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GM extends Model
{
   protected $table = 'gm';
    protected $fillable = [
         'matricule' , 'nom_prenom' ,  'moyS1' , 'moyS2','moyAn' ,'resultat' , 'session',
    ];
}

