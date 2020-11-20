<?php

namespace App\Imports;

use App\L3GM;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class L3GMImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new L3GM([
           'matricule'     => $row['matricule'],
            'nom_prenom'     => $row['nom_prenom'],
            'resultat'     => $row['resultat'],
            'specialite'     => $row['specialite'],
            'section'   => $row['section'],
        ]);
    }
}
