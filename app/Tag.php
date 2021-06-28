<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    // Per leggere i vari Post creo una relazione con App\Post
    public function posts() {
        return $this->belongsToMany('App\Post');
    }
}
