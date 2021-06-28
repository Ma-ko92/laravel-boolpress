<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function show($slug) {
        $tag = Tag::where('slug', '=', $slug)->first();

        if(!$tag) {
            abort('404');
        }

        $data = [
            'tag' => $tag
        ];

        return view('guest.tags.show', $data);
    }
}