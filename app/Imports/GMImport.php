<?php

namespace App\Imports;

use App\GM;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GMImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
           return new GM([
            'matricule'     => $row['matricule'],
            'nom_prenom'     => $row['nom_prenom'],
            'moy_s1'     => $row['moy_s1'] ,
            'moy_s2'     => $row['moy_s2'] ,
            'moy_an'     => $row['moy_an'] ,
            'resultat'     => $row['resultat'],
            'session'     => $row['session'],
            'section'   => $row['section'],
       
        ]);
    }
}
