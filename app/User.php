<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Stabilisco la corrispondenza
    // 
    // Con userData(nome a scelta) Laravel crea un attributo con lo stesso nome della funzione che 
    // possiamo utilizzare per richiedere gli elementi nell'altra tabella
    public function userData() {
        // Inserisco il name space completo
        // Con this stabilisco l'istanza che richiama una funzione
        return $this->hasOne('App\UserInfo');
    }
}
