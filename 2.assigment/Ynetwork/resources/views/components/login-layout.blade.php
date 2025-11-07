@props(['type'])
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Document</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/GlobalStyle.css') }}">
        <link rel="stylesheet" href="{{ asset('css/LoginStyle.css') }}">

    </head>

    <body class="bg-[url('{{ asset('images/milkyway.jpg') }}')] bg-cover bg-center items-center w-screen h-screen bg-no-repeat">
    {{-- Title --}}
    <div class="flex flex-col items-center mt-24">
        <h1 class="font-bold text-7xl">Ynetwork</h1>
        <h2 class="font-semibold text-5xl">{{ $type }}</h2>
    </div>
    {{$slot}}
    </body>
</html>
