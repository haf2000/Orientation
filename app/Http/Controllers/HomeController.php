<?php

namespace App\Http\Controllers;
use App\Http\Controllers\GestionMecaniqueController;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
       $var = new GestionMecaniqueController();
       $places_dispo_spec_section=$var->calcul_places_dispo_section_specialite();
        return view('dashboard',compact('places_dispo_spec_section'));
    }
}
