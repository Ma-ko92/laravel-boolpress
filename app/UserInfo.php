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
}
