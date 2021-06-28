<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    // Per leggere i vari Post creo una relazione con App\Post, per meglio specificare gli passo come argomento il nome della tabella ponte
    public function posts() {
        return $this->belongsToMany('App\Post', 'post_tag');
    }
}
