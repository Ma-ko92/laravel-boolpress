@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>{{$post->title}}</h1>

        <p>{{$post->content}}</p>

        <div class="mb-2 mt-2 px-2 py-2">
            {{-- Per le date laravel include la libreria di Carbon per la gestione delle date.
                Richiamando l'istanza e usando la funzione di formattazione delle date, sono in
                grado di inserire la data nel formato desiderato --}}
            Inserito il: {{ $post->created_at->format('d M Y') }}
        </div>
    </div>
@endsection