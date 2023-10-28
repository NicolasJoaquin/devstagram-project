@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto md:flex">
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
            <div class="rounded shadow bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">
                        Agrega un nuevo comentario
                    </p>
                    @if (session('message'))
                        <div class="p-2 rounded-lg mb-6 text-white text-center uppercase font-bold bg-green-500">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form action="{{ route('comments.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comment" class="mb-2 block uppercase text-gray-500 font-bold">Comentario</label>
                            <textarea
                                id="comment"
                                name="comment"
                                placeholder="Comentario"
                                class="border p-3 w-full rounded-lg @error('comment') border-red-500 @enderror"
                            >{{ old('comment') }}</textarea>
                            @error('comment') 
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <input
                            type="submit"
                            value="Comentar"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                        />
                    </form>
                @endauth
                <div class="bg-white shadow mb-5 max-w-96 overflow-y-scroll mt-10">
                    @if ($post->comments->count() > 0)
                        @foreach ($post->comments as $comment)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('posts.index', [$comment->user->username]) }}" class="font-bold">
                                    {{ $comment->user->name }}
                                </a>
                                <p>
                                    {{ $comment->comment }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $comment->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">
                            La publicación no tiene comentarios
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection