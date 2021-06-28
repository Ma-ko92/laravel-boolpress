<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id'
        
    ];

    // Definisco l'id di riferimento delle colonne
    public function category() {
        return $this->belongsTo('App\Category');
    }

    // Per leggere i vari tag creo una relazione con App\Tag
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}
