<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;

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
        // Creo un istanza di Carbon per richiamare la data attuale
        $carbon_date = new Carbon();

        // Per ottenere l'attuale ora
        $now = Carbon::now();

        // Per la data di domani( di default è settato a mezzanotte)
        $tomorrow = Carbon::tomorrow();

        // Per comparare la diffenrenza delle date (maggioranza) (gt sta per greater then) ritorna boolean
        $now->gt('2021-04-06');

        // il metodo first ritorna solo il primo oggetto che trova.
        $post= Post::where('slug', '=', $slug)->first();

        // Se non trova nessun post restituisce un errore 404
        if(!$post) {
            abort('404');
        }

        $data = [
            'post' => $post,
            'post_category' => $post->category
        ];

        return view('guest.posts.show', $data);
    }

    public function vuePosts() {
        return view('guest.posts.vue-posts');
    }
}
