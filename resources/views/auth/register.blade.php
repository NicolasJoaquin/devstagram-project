@extends('layouts.app')

@section('title')
    Regístrate en DevStagram
@endsection

@section('content')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            {{-- Falta fix de ruteo en src -> no se muestra la imágen --}}
            <img class="shadow-xl rounded-xl" src="{{ asset('/img/registrar.jpg') }}" alt="Registro de usuario"/> 
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('register') }}" method="POST">
                {{-- Directiva que me pega un input hidden con un token para evitar ataques CSR --}}
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        placeholder="Nicolas Diorio"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                        value="{{ old('name') }}"
                    />
                    {{-- Imprimo un error en caso de que este campo esté mal validado --}}
                    @error('name') 
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input
                        id="username"
                        name="username"
                        type="text"
                        placeholder="nicolas.diorio"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ old('username') }}"
                    />
                    @error('username') 
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
                        value="{{ old('email') }}"
                    />
                    @error('email') 
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
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
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Confirmá tu Password</label>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        placeholder="**********"
                        class="border p-3 w-full rounded-lg @error('password_confirmation') border-red-500 @enderror"
                    />
                    @error('password_confirmation') 
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <input
                    type="submit"
                    value="Crear cuenta"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>
        </div>
    </div>
@endsection
