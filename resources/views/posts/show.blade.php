@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Imagen del post {{ $post->title }}" class="rounded-xl shadow-lg">
            <div class="p-3">
                <p>0 likes</p>
            </div>
            <div>
                <p class="font-bold">{{ $user->name }}</p>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() /* Lo formatea implementando la API carbon */ }} 
                </p>
                <p class="mt-5">
                    {{ $post->description }}
                </p>
            </div>
        </div>
        <div class="md:w-1/2 p-5">
            <div>
                <p class="text-xl font-bold text-center mb-4">
                    Agrega un nuevo comentario
                </p>
            </div>
        </div>
    </div>
@endsection