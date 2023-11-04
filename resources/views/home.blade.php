@extends('layouts.app')

@section('title')
    Página principal
@endsection

@section('content')
    {{-- Para evitar un forach anidado en un if uso forelse --}}
    {{-- @forelse ($posts as $post)
        <p>{{ $post->title }}</p>
    @empty
        <p>No hay posts</p>
    @endforelse --}}
    {{-- Ejemplo slots --}}
    {{-- <x-post-list>
        <x-slot:title>
            <header>HEADER</header>
        </x-slot:title>
        <h1>Mostrando posts desde slots</h1>
    </x-post-list> --}}
    <x-post-list :posts="$posts">
        <x-slot:without_posts>
            No hay publicaciones para mostrar en tu feed
        </x-slot:without_posts>
    </x-post-list>
@endsection
