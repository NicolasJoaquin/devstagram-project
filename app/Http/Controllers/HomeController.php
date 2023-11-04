<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }
    public function __invoke() { // Con __invoke method (sólo para controllers de un único método)
        // dd(auth()->user()->followed->pluck('id')->toArray()); // Pluck trae los campos especificados del resultset que me da auth()->user()->followed
        // Antes de traer los ids de los seguidos, fijarse si el usuario está logueado
        $ids = auth()->user()->followed->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20); // Con latest() me ahorro le order by created_at 
        return view("home", [
            "posts"=> $posts,
        ]);
    }
    // public function index() {
    //     dd("home");
    //     return view("home");
    // }
}
