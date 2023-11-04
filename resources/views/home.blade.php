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
    @if ($posts->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Imagen del post {{ $post->title }}" class="rounded-xl shadow-lg">
                    </a>
                </div>
            @endforeach
        </div>
        <div class="my-10">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    @else
        <p class="text-gray-600 uppercase text-sm text-center font-bold">
            Nadie ha publicado nada todavía
        </p>
    @endif
@endsection
