<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
    public function create() { 
        return view('posts.create');
    }
    public function store(Request $request) { 
        $this->validate($request, [
            'title' => ['required', 'min:1', 'max:255'],
            'description' => ['required', 'min:1', 'max:1500'],
            'image' => ['required'],
        ]);
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth()->user()->id,
        ]);
        // Otra forma para crear registros en la DB
        /* 
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $request->image;
        $post->user_id = auth()->user()->id;
        $post->save(); 
        */
        // Otra forma (con las relaciones de Eloquent)
        /*
        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth()->user()->id,
        ]);
        */
        return redirect()->route('posts.index', [
            'user' => auth()->user()->username,
        ]);
    }
}
