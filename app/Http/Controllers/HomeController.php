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
       $data_voeux = $var->recup_data_voeux();
       $resultat = $var->recup_min_max();
        return view('dashboard',compact('places_dispo_spec_section','data_voeux','resultat'));
    }
}
