<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Devstagram - @yield('title')</title>
    </head>
    <body>
        <nav>
            <a href="/">Inicio</a>
            <a href="/principal">Principal</a>
            <a href="/tienda">Tienda</a>
        </nav>
        <h1>@yield('title')</h1>

        <hr>

        @yield('content')
    </body>
</html>
