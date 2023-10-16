<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth'); // Cada vez que se llama a una functión autentica al usuario primero
    }
    public function index() {
        return view('layouts.dashboard');
    }
}
