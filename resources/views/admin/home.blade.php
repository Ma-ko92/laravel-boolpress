@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Benvenuto {{ $current_user->name }}!</h3>
        
        <h4>Dati Personali</h4>
        {{-- Imposto condizione che mostra i dati solo se presenti, richiamando la varibile della chiamata al db --}}
        @if($current_user_data)
        <ul>
            <li>Indirizzo: {{ $current_user_data->address }}</li>
            <li>Numero di telefono: {{ $current_user_data->telephone }}</li>
            <li>Data di nascita: {{ $current_user_data->birthday }}</li>
        </ul>
        @endif
        
        {{-- <h1 class="text-center text-uppercase">Ultimi post</h1>

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
        </div> --}}
    </div>    

@endsection
