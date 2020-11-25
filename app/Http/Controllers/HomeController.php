<?php

namespace App\Http\Controllers;
use App\Http\Controllers\GestionMecaniqueController;
use App\Http\Controllers\GestionProcedesController;
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
       
        return view('dashboard');
    }

   public function index2()
    {
       $var = new GestionMecaniqueController();
       $places_dispo_spec_section=$var->calcul_places_dispo_section_specialite();
       $data_voeux = $var->recup_data_voeux();
       $resultat = $var->recup_min_max();
        return view('statistiques.statistiques',compact('places_dispo_spec_section','data_voeux','resultat'));
    }

    public function index3()
    {
       $var = new GestionProcedesController();
       $places_dispo_spec_section=$var->calcul_places_dispo_section_specialite();
       $data_voeux = $var->recup_data_voeux();
       $resultat = $var->recup_min_max();
        return view('statistiques.statistiques2',compact('places_dispo_spec_section','data_voeux','resultat'));
    }
}
