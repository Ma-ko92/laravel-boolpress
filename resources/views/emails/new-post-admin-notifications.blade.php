{{-- non supportando il javascript non necessita degli import --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <div>
        <h1>Ciao Amministratore</h1>

        <div>
            <span>Un nuovo post è stato creato: {{ $new_post->title }}</span> <br>
            <a href="{{ route('admin.posts.show', ['post' => $new_post->id]) }}">Guarda dettagli</a>
        </div>
    </div>

</body>
</html>