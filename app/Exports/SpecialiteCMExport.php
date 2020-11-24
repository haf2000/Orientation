<?php

namespace App\Exports;

use App\GM;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class SpecialiteCMExport implements FromCollection,WithHeadings, ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       $lignes =  DB::table('gm')->
                     select('matricule' , 'nom_prenom' )
                     ->where('orientation',"=",'4553')
                     ->orderBy('nom_prenom', 'asc')->get();
          foreach ($lignes as $ligne) {
          	$ligne->matricule = "'".strval($ligne->matricule)."'";
          }
          return $lignes;
    }
    public function headings(): array
    {
        return ["matricule", "nom_prenom"];
    }
  public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:B1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }   
}
