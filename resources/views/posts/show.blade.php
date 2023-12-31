@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Imagen del post {{ $post->title }}" class="rounded-xl shadow-lg">
            <div class="p-3 flex items-center gap-4">
                @auth
                    <livewire:like-post :post="$post"/>
                    {{-- @if ($post->checkLike(auth()->user()))
                        <form action="{{ route('posts.likes.destroy', $post) }}" method="POST">
                            @method('DELETE') 
                            @csrf
                            <div class="my-4">
                            </div>
                        </form>                    
                    @else
                        <form action="{{ route('posts.likes.store', $post) }}" method="POST">
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>    
                                </button>
                            </div>
                        </form>
                    @endif --}}
                @endauth
            </div>
            <div>
                <a href="{{ route('posts.index', $user->username) }}" class="font-bold">{{ $user->name }}</a>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() /* Lo formatea implementando la API carbon */ }} 
                </p>
                <p class="mt-5">
                    {{ $post->description }}
                </p>
            </div>
            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        {{-- Method spoofing -> El método delete no está soportado por las actions del form
                        Haciendo method spoofing se pueden utilizar otro tipo de peticiones como PUT/PATCH o DELETE --}}
                        @method('DELETE') 
                        @csrf
                        <input 
                            type="submit"
                            value="Eliminar publicación"
                            class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"
                        />
                    </form>                
                @endif
            @endauth
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