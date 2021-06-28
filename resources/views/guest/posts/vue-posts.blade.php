@extends('layouts.app')

{{-- importo lo script tramite cdn --}}
@section('header-scripts')
    {{-- Axios --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- VueJs --}}
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
@endsection


@section('content')
    <div class="container">
        <h1>Post visualizzati con Vuejs</h1>

        <div class="row">
           
        </div>
    </div>
@endsection