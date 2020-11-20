<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FVGM extends Model
{
   protected $table = 'fichevoeuxgm';
    protected $fillable = [
         'matricule' , 'nom','prenom' ,'anet' ,  'origine' , 'section','choix1' ,'choix2' ,'nationalite',
    ];
}
