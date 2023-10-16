<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Devstagram - @yield('title')</title>
        @vite('resources/css/app.css')
    </head>
    <body  class="bg-gray-100">
        {{-- <nav>
            <a href="/">Inicio</a>
            <a href="/principal">Principal</a>
            <a href="/tienda">Tienda</a>
        </nav>
        <h1 class="text-4xl font-extrabold">@yield('title')</h1>
        <hr>
        @yield('content') --}}
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-black">
                    DevStagram
                </h1>
                <nav class="flex gap-2 items-center">
                    <a href="/" class="font-bold uppercase text-gray-600">Home</a>
                    <a href="/login" class="font-bold uppercase text-gray-600">Login</a>
                    <a href="{{ route('register') }}" class="font-bold uppercase text-gray-600">Crear Cuenta</a>
                </nav>    
            </div>
        </header>
        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">
                @yield('title')
            </h2>    
            @yield('content')
        </main>
        <footer class="text-center p-5 text-gray-500 font-bold uppercase mt-10">
            {{-- DevStagram - Todos los derechos reservados {{date('Y')}} --}}
            DevStagram - Todos los derechos reservados {{ now()->year }}

        </footer>
    </body>
</html>
