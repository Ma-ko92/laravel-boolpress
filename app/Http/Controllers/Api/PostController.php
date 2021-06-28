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

        $data = [
            'posts' => $posts,
            // Per dire all'utente che la chiamata è riuscita
            'success' => true
        ];

        // Ritorno l'oggetto json e gli passo l'array
        return response()->json($data);
    }
}
