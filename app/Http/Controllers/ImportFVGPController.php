<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\FVGPImport;
use Maatwebsite\Excel\Facades\Excel;
class ImportFVGPController extends Controller
{
    public function import() 
    {
        Excel::import(new FVGPImport,request()->file('file2'));
   
        return back()->withStatus("Fiche de voeux GM a bien été importé!");
    }
}
