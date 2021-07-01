@extends('layouts.app')

@section('content')

    <div class="container">
        {{-- Titolo Post --}}
        <h1 class="text-center text-uppercase">{{ $post->title }}</h1>

        {{-- Copertina  --}}
        @if($post->cover)
            <div class="mt-2 mb-2">
                <img src="{{ asset('storage/' . $post->cover ) }}" alt="{{ $post->title }}">
            </div>
        @endif

        {{-- Categoria --}}
        @if($post_category)
            <div class="mt-2 mb-2">Categoria: {{  $post_category->name}}</div>
        @endif($post->category)

        {{-- Tags --}}
        {{-- Condizione che verifica che l'elemento abbia un tag, se false non lo stampa --}}
        @if($post_tags->isNotEmpty())
            <div class="mt-2 mb-2">
                <strong>Tags: </strong>
                @foreach($post_tags as $tag)
                    {{ $tag->name }}{{ $loop->last ? '' : ', ' }}
                @endforeach
            </div>
        @endif
        {{-- SLUG --}}
        <div class="mt-3 mb-3">
            <strong>Slug:</strong> {{ $post->slug }}
        </div>

        {{-- Contenuto --}}
        <h2>Descrizione</h2>
        <p>{{ $post->content }}</p>

        {{-- Data --}}
        <div class="mb-2 mt-2 px-2 py-2">
            {{-- Per le date laravel include la libreria di Carbon per la gestione delle date.
                Richiamando l'istanza e usando la funzione di formattazione delle date, sono in
                grado di inserire la data nel formato desiderato --}}
            Inserito il: {{ $post->created_at->format('d M Y') }}
        </div>

        <div>
            <a href="{{ route('admin.posts.edit', [ 'post' => $post->id ]) }}" class="btn btn-success">Modifica Post</a>
        </div>
        
    </div>    

@endsection