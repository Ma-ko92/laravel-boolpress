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

    // Questo homecontroller ha la particolarità di avere questa funzione di autenticazione, che fa accedere l'utente a questo controller
    // e a tutti i suoi metodi solo se esso è autenticato.
    // 
    // Buona pratica è eliminare il middleware da qui e metterlo dentro  il file web.php per una maggiore praticità, e senza dover ripetere
    // la riga di funzione. Se lo si lasciasse qua sarebbe il controller ad essere protetto.
    // 
    // public function __construct()
    // {
    //     $this->middleware('auth'); oppure ->middleware('auth'); da inserire in web.app
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
