<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\L3GPImport;
use Maatwebsite\Excel\Facades\Excel;
class ImportL3GPController extends Controller
{
    public function import() 
    {
        Excel::import(new L3GPImport,request()->file('file1'));
   
   return back();
    }
}
