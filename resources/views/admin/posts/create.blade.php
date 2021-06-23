@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- Titolo --}}
        <h1 class="text-center text-uppercase">Crea nuovo post</h1>

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
        <form action="{{ route('admin.posts.store') }}" method='post'>
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="title">Titolo: </label>
                {{-- Con la value impedisco l'eliminazione del contenuto nel caso di un errore, possiamo passare un secondo valore 
                    ad esempio per impostare un default ma attenzione che se presente un contenuto esso verrà salvato in automatico!--}}
                <input type="text" class="form-control" id="title" aria-describedby="" name="title" value="{{ old('title', 'es: Evoluzione di PHP') }}">
            </div>

            <div class="form-group">
                <label for="content">Contenuto: </label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ old('content') }}</textarea>
            </div>

            {{-- opzione per le categorie --}}
            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="">Nessuna</option>
                    {{-- Con un foreach prendo tutte le categorie dalla tabella --}}
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <input type="submit" value="Salva" class="btn btn-success">
        </form>
    </div>    



@endsection