@extends('layouts.app')

@section('content')
    <div class="container">
        
        <h1 class="text-center text-uppercase">Ultimi post</h1>

        <div class="row">
            @foreach ($posts as $post)
                <div class="col-6">
                    <div class="card mt-4 mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            
                            <a href="{{ route('blog-page', ['slug' => $post->slug]) }}" class="btn btn-primary">Dettagli</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>    

@endsection
