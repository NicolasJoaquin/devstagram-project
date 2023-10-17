<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth'); // Cada vez que se llama a una functión autentica al usuario primero
    }
    public function index(User $user) { // Recibe un modelo porque en el ruteo estoy usando una variable (/{user:username})
        return view('layouts.dashboard', [
            'user' => $user,
        ]);
    }
}
