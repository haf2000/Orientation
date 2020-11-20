<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FVGP extends Model
{   

	protected $table = 'fichevoeuxgp';
    protected $fillable = [
         'matricule' , 'nom','prenom' ,'anet' ,  'origine' , 'section','choix1' ,'choix2','choix3' ,'nationalite',
    ];
    
}
