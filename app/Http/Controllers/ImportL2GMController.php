<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Imports\GMImport;
use Maatwebsite\Excel\Facades\Excel;
class ImportL2GMController extends Controller
{
   public function import() 
    {
        Excel::import(new GMImport,request()->file('file'));
           
        return back();
    }
}
