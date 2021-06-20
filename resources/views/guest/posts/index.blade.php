@extends('layouts.app')


@section('content')
    <div class="container">
        <h1>Post più visti</h1>

        <div class="row">
            @foreach($posts as $post)
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <a href="{{ route('blog-page', ['slug' => $post->slug]) }}" class="btn btn-primary">Vai al post</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection