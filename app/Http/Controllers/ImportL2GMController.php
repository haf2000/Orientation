<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Imports\GMImport;
use Maatwebsite\Excel\Facades\Excel;
class ImportL2GMController extends Controller
{
   public function import() 
    {
        Excel::import(new GMImport,request()->file('file01'));
           
        return back()->with('status1',"Pv L2 section1 a été bien importé!");

    }
     public function import2() 
    {
        Excel::import(new GMImport,request()->file('file02'));
           
        return back()->with('status2',"Pv L2 section2 a été bien importé!");

    }
     public function import3() 
    {
        Excel::import(new GMImport,request()->file('file03'));
           
        return back()->with('status3',"Pv L2 section3 a été bien importé!");

    }
     public function import4() 
    {
        Excel::import(new GMImport,request()->file('file04'));
           
        return back()->with('status4',"Pv L2 section4 a été bien importé!");

    }
     public function import5() 
    {
        Excel::import(new GMImport,request()->file('file05'));
           
        return back()->with('status5',"Pv L2 section5 a été bien importé!");

    }
  
}
