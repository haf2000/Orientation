<?php

namespace App\Imports;

use App\FVGP;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FVGPImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new FVGP([
            'matricule'     => $row['matricule'],
            'nom'     => $row['nom'],
            'prenom'     => $row['prenom'],
            'anet'     => $row['anet'] ,
            'choix1'     => $row['choix1'] ,
            'choix2'     => $row['choix2'] ,
            'origine'     => $row['origine'],            
            'nationalite'     => $row['nationalite'],
            'section'   => $row['section'],
        ]);
    }
}
