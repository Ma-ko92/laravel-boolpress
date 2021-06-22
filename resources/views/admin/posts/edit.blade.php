@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Title --}}
        <h1 class="text-center text-uppercase">Modifica Post: {{ $post->title }}</h1>

        {{-- Validations error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- Form --}}
        <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method='post'>
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Titolo: </label> 
                {{-- Per questo form l'old se presente viene visualizzato altrimenti mostra il titolo del post (molto usato)--}}
                <input type="text" class="form-control" id="title" aria-describedby="" name="title" value="{{ old( 'title', $post->title ) }}">
            </div>

            <div class="form-group">
                <label for="content">Contenuto: </label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10" value="{{ old( 'content', $post->content ) }}"></textarea>
            </div>

            <input type="submit" value="Salva" class="btn btn-success">
        </form>

    </div>    



@endsection