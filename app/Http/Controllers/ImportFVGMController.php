<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\FVGMImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportFVGMController extends Controller
{
    public function import() 
    {
        Excel::import(new FVGMImport,request()->file('file2'));
   
   return back();
    }
}
