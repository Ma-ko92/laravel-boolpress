<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// includo la classe per prendere i dati di login
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContactUserAutoreply;
use App\Mail\NewContactAdminNotification;
use App\Lead;


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

    public function contacts() {
        return view('guest.contacts');
    }

    public function handleNewContact(Request $request) {

        $request->validate([
            'terms-and-conditions' => 'required'
        ]);

        $form_data = $request->all();

        // verifico che le checkbox siano chekkate
        if(isset($form_data['marketing-terms-and-conditions'])) {
            $new_lead = new Lead();
            $new_lead->fill($form_data);
            $new_lead->save();
        }

       

        Mail::to($form_data['email'])->send(new NewContactUserAutoreply());
        // Mando la mail all'amministratore
        Mail::to('boolpress@email.it')->send(new NewContactAdminNotification($form_data));

        return redirect()->route('contacts-thank-you');
    }

    public function contactsThankYou() {
        return view('guest.contacts-thank-you');
    }
}
