<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct() {
        /* 
        Cada vez que se llama a una functión autentica al usuario primero
        Se pueden excepcionar métodos de la autenticación
        */
        $this->middleware('auth')->except(['show', 'index']); 
    }
    public function index(User $user) { // Recibe un modelo porque en el ruteo estoy usando una variable (/{user:username})
        // Usando el usuario que viene por parámetro para consultar sus posts a través del modelo (Route Model Binding)
        $posts = Post::where('user_id', $user->id)->paginate(20);
        // dd($posts);
        return view('layouts.dashboard', [
            'user' => $user, // Puedo mandar sólo el usuario que dentro tiene los posts, pero ni puedo hacer $user->posts->link() porque este objeto no es paginable
            'posts' => $posts,
        ]);
    }
    public function create() { 
        return view('posts.create');
    }
    public function store(Request $request) { 
        $this->validate($request, [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1500'],
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
    public function show(User $user, Post $post) { // Van en este orden porque en el ruteo está primero el usuario y después el post
        return view('posts.show', [
            'user' => $user,
            'post' => $post,
        ]);
    }
}
