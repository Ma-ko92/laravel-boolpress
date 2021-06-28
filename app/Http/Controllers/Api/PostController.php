<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// richiamo il model
use App\Post;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();

        // costruisco l'array per prendere i dati a me necessari
        $posts_data = [];
        foreach($posts as $post) {
            $posts_data[] = [
                'title' => $post->title,
                'content' => $post->content,
                // uso un ternario per verificare che la categoria non sia null
                'category' => $post->category ? $post->category->name : ''
            ];
        }

        $data = [
            'posts' => $posts_data,
            // Per dire all'utente che la chiamata è riuscita
            'success' => true
        ];

        // Ritorno l'oggetto json e gli passo l'array
        return response()->json($data);
    }
}
