<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\GPImport;
use Maatwebsite\Excel\Facades\Excel;
class ImportL2GPController extends Controller
{
    public function import(){

    	Excel::import(new GPImport,request()->file('file'));
           
        return back();
    }
    
}
