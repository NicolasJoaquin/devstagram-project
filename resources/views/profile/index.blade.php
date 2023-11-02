@extends('layouts.app')

@section('title')
    Editar perfil: {{ auth()->user()->name }}
@endsection

@section('content')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white rounded-xl shadow-lg p-6">
            <form action="{{ route('profile.store') }}" method="POST" class="mt-10 md:mt-0" enctype="multipart/form-data">
                @csrf
                @if(session('message'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ session('message') }}
                    </p>
                @endif
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input
                        id="username"
                        name="username"
                        type="text"
                        placeholder="nicolas-diorio"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ auth()->user()->username }}"
                    />
                    @error('username') 
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        placeholder="Nicolas Diorio"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                        value="{{ auth()->user()->name }}"
                    />
                    @error('name') 
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="text"
                        placeholder="nicolas.joaquin.diorio@gmail.com"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ auth()->user()->email }}"
                    />
                    @error('email') 
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="new_password" class="mb-2 block uppercase text-gray-500 font-bold">Nuevo Password</label>
                    <input
                        id="new_password"
                        name="new_password"
                        type="password"
                        placeholder="**********"
                        class="border p-3 w-full rounded-lg @error('new_password') border-red-500 @enderror"
                    />
                    @error('new_password') 
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="new_password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Confirmá tu Nuevo Password</label>
                    <input
                        id="new_password_confirmation"
                        name="new_password_confirmation"
                        type="password"
                        placeholder="**********"
                        class="border p-3 w-full rounded-lg @error('new_password_confirmation') border-red-500 @enderror"
                    />
                    @error('new_password_confirmation') 
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="image" class="mb-2 block uppercase text-gray-500 font-bold">Foto de perfil</label>
                    <input
                        id="image"
                        name="image"
                        type="file"
                        class="border p-3 w-full rounded-lg"
                        value=""
                        accept=".jpg, .jpeg, .png"
                    />
                </div>
                <hr class="mt-10">
                <div class="mb-5 mt-10">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password Actual</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="**********"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                    />
                    @error('password') 
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <input
                    type="submit"
                    value="Editar"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>
        </div>
    </div>
@endsection