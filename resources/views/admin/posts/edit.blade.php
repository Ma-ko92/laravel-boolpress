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

            {{-- opzione per le categorie --}}
            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="">Nessuna</option>
                    {{-- Con un foreach prendo tutte le categorie dalla tabella --}}
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <input type="submit" value="Salva" class="btn btn-success">
        </form>

    </div>    



@endsection

{{-- Old è una funzione che torna ciò che l'utente ha gia inserito nel form, possiamo però usare 
un default se l'utente non ha ancora inviato il form ($post->category_id) riga 43--}}