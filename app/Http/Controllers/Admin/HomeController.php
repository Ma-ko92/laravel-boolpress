<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //pagina index utenti loggati
    public function index() {

        // Restituisco il model dell' utente corrente
        $current_user = Auth::user();

        
        // $current_user_data = $current_user->userData;

        // Per richiedere l'utente collegato a quella info nel caso non si conosca l'utente
        // avendo a disposizione un istanza
        // $current_user_info->user;

        $data = [
            'current_user' => $current_user,
            // in questo modo la relazione viene letta una sola volta
            'current_user_data' => $current_user->userData
        ];

        return view('admin.home', $data);
    }
}
