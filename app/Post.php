<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'category_id',
        'slug'
    ];

    // Definisco l'id di riferimento delle colonne
    public function category() {
        return $this->belongsTo('App\Category');
    }
}
