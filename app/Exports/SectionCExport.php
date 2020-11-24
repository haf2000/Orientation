<?php

namespace App\Exports;

use App\GP;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class SectionCExport implements FromCollection, WithHeadings, ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       $lignes =  DB::table('gp')->
                     select('matricule' , 'nom_prenom' , 'choix1' ,'choix2' ,'moy_s1' , 'moy_s2','moy_an' ,  'session','r', 'mc', 'orientation')
                     ->where("section","=",'A')
                     ->orderBy('mc', 'desc')->get();
          foreach ($lignes as $ligne) {
          	$ligne->matricule = "'".strval($ligne->matricule)."'";
          	$ligne->moy_s1 = strval($ligne->moy_s1);
          	$ligne->moy_s2 = strval($ligne->moy_s2);
          	$ligne->moy_an = strval($ligne->moy_an);
          	$ligne->mc = strval($ligne->mc);
          	$ligne->session = strval($ligne->session);
          	$ligne->r = strval($ligne->r);
          }
          return $lignes;
    }
    public function headings(): array
    {
        return ["matricule", "nom_prenom", "choix1" ,"choix2" ,"moy_s1" , "moy_s2","moy_an" ,  "session","r", "mc", "orientation"];
    }
  public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:K1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }  
}
