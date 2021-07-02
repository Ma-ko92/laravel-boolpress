@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Contattaci compilando il form</h1>

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

        <form action="{{ route('handle-new-contact') }}" method="post">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="message">Messaggio</label>
                <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
            </div>   
            
            {{-- Aggiungo l'autorizzazione dei dati personali --}}
            <div>
                <input type="checkbox" class="form-check-input" id="terms-and-conditions" name="terms-and-conditions" value="accepted">
                <label class="form-check-label" for="terms-and-conditions">Accetta i termini e le condizioni</label>
            </div>

            {{-- Aggiungo l'autorizzazione dei dati personali per marketing--}}
            <div>
                <input type="checkbox" class="form-check-input" id="marketing-terms-and-conditions" name="marketing-terms-and-conditions" value="accepted">
                <label class="form-check-label" for="marketing-terms-and-conditions">Accetta che i tuoi dati siano salvati per finalità di marketing</label>
            </div>

            <input type="submit" class="btn btn-success" value="Invia Messaggio">

        </form>
    </div>
@endsection