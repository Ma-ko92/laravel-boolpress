<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{
    //pagina index utenti loggati
    public function index() {

        $posts = Post::all();

        $data = [
            'posts' => $posts
        ];


        return view('admin.home', $data);
    }
}
