@extends('layouts.app')

{{-- importo lo script tramite cdn --}}
@section('header-scripts')
    {{-- Axios --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- VueJs --}}
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
@endsection

{{-- Script presente nel footer --}}
@section('footer-scripts')
    <script src="{{ asset('js/posts.js') }}"></script>
@endsection


@section('content')
    <div class="container">
        <div id="root">
            {{-- Per evitare conflitti tra blade e vue usare la @ davanti le parentesi per definire un istanza di vue--}}
            <h1>@{{ title }}</h1>

            <div class="row">
                <div v-for="post in posts" class="col-6 mb-2 mt-2">
                    <div class="card px-3 py-3">
                        <h3 class="card-title">@{{ post.title }}</h3>
                        <p class="card-text">@{{ post.content }}</p>

                        <div v-if="post.tags.length > 0">
                            Tags:
                            <ul>
                                <li v-for="tag in post.tags">
                                    @{{ tag.name }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection