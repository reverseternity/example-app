<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mama Bulgaria</title>
    <link rel="stylesheet" href="{{ asset('my assets/css/bootstrap.min.css') }}">
    <script src="{{ asset('my assets/js/bootstrap.min.js') }}" defer></script>
</head>
<body>
<header>
    <div class="container"></div>
        @include('my components.navbar')
</header>
<main>
    <div class="container"></div>
        @yield('main')
</main>
</body>
</html>
