<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// includo la classe per prendere i dati di login
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // Funzione che verifica se si è loggati(rende privata la sezione)
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    // va eliminato e spostato su web.php

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('guest.home');
    }
}
