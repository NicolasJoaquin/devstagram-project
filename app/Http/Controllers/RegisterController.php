<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index() {
        return view('auth.register');
    }
    public function autenticar() {
        return view('auth.register');
    }
    public function store(Request $request) {
        // dd($request); // Función para debug, coorta la ejecución que venga después de ejecutar esto -> imprime lo que le paso como parámetro
        // dd($request->get('name')); // Para acceder a cada cosa que me mandan en el request

        // Validación de formularios
        // Modifico username antes de validar
        $request->request->add(['username' => Str::slug($request->username)]);
        $this->validate($request, [
            'name' => ['required', 'min:2', 'max:35'],
            'username' => ['required', 'unique:users', 'min:3', 'max:30'],
            'email' => ['required', 'unique:users', 'email', 'max:60'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);
        User::create([
            // 'name' => $request->get('name'),
            'name' => $request->name,
            // 'username' => Str::lower($request->username) ,
            // 'username' => Str::slug($request->username), // Convierte el string en una URL
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // Autenticar al usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);
        // Otra forma de autenticar al usuario
        auth()->attempt($request->only('email', 'password'));
        // Redirección al muro
        return redirect()->route('posts.index');
    }
}
