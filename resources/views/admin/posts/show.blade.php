@extends('layouts.app')

@section('content')

    <div class="container">
        {{-- Titolo Post --}}
        <h1 class="text-center text-uppercase">{{ $post->title }}</h1>

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