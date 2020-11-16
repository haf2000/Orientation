<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GpController extends Controller
{
   public function gp()
    {
        return view('GPGM.gp');
    }
}
