@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Titolo --}}
        <h1 class="text-center text-uppercase">Categorie</h1>

        {{-- Posts --}}
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-6">
                    <div class="card mt-4 mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title text-uppercase">{{ $category->name }}</h5>
                            <a href="{{ route('category-page', ['slug' => $category->slug]) }}" class="btn btn-primary">Guarda i post di questa categoria</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>    
@endsection