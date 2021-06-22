@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Titolo --}}
        <h1 class="text-center text-uppercase">Gestisci i Posts</h1>

        {{-- Posts --}}
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-6">
                    <div class="card mt-4 mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title text-uppercase">{{ $post->title }}</h5>
                            <a href="{{ route('admin.posts.show', [ 'post' => $post->id ]) }}" class="btn btn-primary">Guarda il Post</a>

                            <a href="{{ route('admin.posts.edit', [ 'post' => $post->id ]) }}" class="btn btn-success">Modifica Post</a>

                            <form action="{{ route('admin.posts.destroy', [ 'post' => $post->id ]) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <input type="submit" class="btn btn-danger" value="Cancella Post">
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>    
@endsection