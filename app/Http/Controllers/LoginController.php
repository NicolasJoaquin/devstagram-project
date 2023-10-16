<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }
    public function store(Request $request) {
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // Devuelve mensaje de error desde donde fué enviado el request, con el mensaje dentro de with (lo guarda en una variable de sesión)
        // Se puede acceder desde las vistas con @sesion('message') en este caso
        if(!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('message', 'Credenciales incorrectas');
        }
        // Si pasa la validación y la autenticación me redirecciona al muro
        return redirect()->route('posts.index');
    }
}
