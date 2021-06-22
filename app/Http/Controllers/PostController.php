<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index() {

        $posts = Post::all();

        $data = [
            'posts' => $posts
        ];

        return view('guest.posts.index', $data);
    }

    // Inserisco lo slug, che è una trasposizione del titolo (url friendly) per un ottimizzazione del CEO
    public function show($slug) {
        // il metodo first ritorna solo il primo oggetto che trova.
        $post= Post::where('slug', '=', $slug)->first();

        // Se non trova nessun post restituisce un errore 404
        if(!$post) {
            abort('404');
        }

        $data = [
            'post' => $post
        ];

        return view('guest.posts.show', $data);
    }
}
