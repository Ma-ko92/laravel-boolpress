@extends('layouts.app')

@section('content')

    <div class="container">
        {{-- Titolo Post --}}
        <h1 class="text-center text-uppercase">{{ $post->title }}</h1>

        {{-- Categoria --}}
        @if($post_category)
            <div class="mt-2 mb-2">Categoria: {{  $post_category->name}}</div>
        @endif($post->category)

        {{-- Tags --}}
        <div class="mt-2 mb-2">
            <strong>Tags: </strong>
            @foreach($post_tags as $tag)
                {{ $tag->name }}{{ $loop->last ? '' : ', ' }}
            @endforeach
        </div>
        {{-- SLUG --}}
        <div class="mt-3 mb-3">
            <strong>Slug:</strong> {{ $post->slug }}
        </div>

        {{-- Contenuto --}}
        <h2>Descrizione</h2>
        <p>{{ $post->content }}</p>

        <div>
            <a href="{{ route('admin.posts.edit', [ 'post' => $post->id ]) }}" class="btn btn-success">Modifica Post</a>
        </div>
        
    </div>    

@endsection