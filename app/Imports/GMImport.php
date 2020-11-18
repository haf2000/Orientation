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
           return new GM([
            'matricule'     => $row['Matricule'],
            'nom_prenom'     => $row['Noms & Prénoms'],
            'moyS1'     => $row['Moyenne S1'],
            'moyS2'     => $row['Moyenne S2'],
            'moyAn'     => $row['Moyenne An'],
            'resultat'     => $row['Resultat'],
            'session'     => $row['Session'],
        ]);
        ]);
    }
}
