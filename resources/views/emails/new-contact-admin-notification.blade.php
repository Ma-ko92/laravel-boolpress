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
        <h3>Ammisitratore hai un nuovo messaggio</h3>

        <ul>
            <li>
                Da: {{ $contact_data['email'] }}
            </li>
            <li>
                Nome: {{ $contact_data['name'] }}
            </li>
            <li>
                Messaggio: {{ $contact_data['message'] }}
            </li>
        </ul>
    </div>
</body>
</html>