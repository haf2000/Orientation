<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Imports\L3GMImport;
use Maatwebsite\Excel\Facades\Excel;
class ImportL3GMController extends Controller
{
   
   public function import() 
    {
        Excel::import(new L3GMImport,request()->file('file1'));
   
   return back()->withStatus("Pv L3GM a bien été importé!");
    }
}
