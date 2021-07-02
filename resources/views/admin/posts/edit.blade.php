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
        <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method='post' enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Titolo: </label> 
                {{-- Per questo form l'old se presente viene visualizzato altrimenti mostra il titolo del post (molto usato)--}}
                <input type="text" class="form-control" id="title" aria-describedby="" name="title" value="{{ old( 'title', $post->title ) }}">
            </div>

            <div class="form-group">
                <label for="content">Contenuto: </label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10" value="">{{ old( 'content', $post->content ) }}</textarea>
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

            {{-- Opzione per i tag --}}
            <div class="form-group">
                <h5>Tags</h5>

                @foreach($tags as $tag)
                    <div class="form-check">
                        <input class="form-check-input" 
                               name="tags[]" {{-- Quando si utilizzano le checkbox, hanno tutte lo stesso name. Mettendo le [] permettiamo la multi scelta --}}
                               type="checkbox" 
                               value="{{ $tag->id }}" 
                               id="tag-{{ $tag->id }}" {{-- In questo modo rendo univoche l'id legata alla label-for --}}
                               {{ $post->tags->contains($tag->id) ? 'checked' : '' }} {{-- la funzione contains controlla che nel mode un elemento con id sia contenuto tra le relazioni --}}
                        >

                        <label class="form-check-label" for="tag-{{ $tag->id }}">
                            {{ $tag->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            {{-- Per upload di file --}}
            <div class="form-group">
                <label for="cover-image">Immagine di copertina</label>
                {{-- In questo caso non settiamo il nome come la tabella perchè salveremo solo l'ultima parte della 
                path del link dell'immagine --}}
                <input type="file" class="form-control-file" name="cover-image" id="cover-image">
            </div>

            {{-- Anteprima immagine presente --}}
            @if ($post->cover)
                <div>
                    <h3>Anteprima immagine corrente</h3>

                    <img src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
                </div>
            @endif

            <input type="submit" value="Salva" class="btn btn-success">
        </form>

    </div>    



@endsection

{{-- Old è una funzione che torna ciò che l'utente ha gia inserito nel form, possiamo però usare 
un default se l'utente non ha ancora inviato il form ($post->category_id) riga 43--}}