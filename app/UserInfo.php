<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    //Stabilisco il nome della tabella
    protected $table = 'user_info';

    protected $fillable = [
        'address',
        'telephone',
        'birthday'
    ];

    // Stabilisco che la foreign key di questa tabella fa riferimento ad User
    // Va sempre messo nella tabella della foreign key
    public function user() {
        return $this->belongsTo('App\User');
    }
}
