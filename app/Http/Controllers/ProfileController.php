<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }
    public function index() {
        return view("profile.index");
    }
    public function store(Request $request) {
        // Modifico username antes de validar
        $request->request->add(['username' => Str::slug($request->username)]);
        $this->validate($request, [
            'name' => ['required', 'min:2', 'max:35'],
            /* 
            Con not_in valido que no se elija ningún username de la lista 
            Con Rule::unique('users', 'username')->ignore(auth()->user()) se valida el username sólo si es diferente al del usuario auteniticado (para que no tire error al editar el perfil y no cambiar el username)
            */
            'username' => [
                'required', 
                // 'unique:users,username,{auth()->user()->id}', 
                Rule::unique('users', 'username')->ignore(auth()->user()),
                'min:3', 
                'max:30', 
                'not_in:twitter,facebook,edit-profile'
            ],
        ]);
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::uuid() . "." . $image->extension();
            $serverImage = Image::make($image);
            $serverImage->fit(1000, 1000);
            $imagePath = public_path('profiles') . '/' . $imageName;
            $serverImage->save($imagePath);
        }
        $user = User::find(auth()->user()->id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->image = $imageName ?? auth()->user()->image ?? '';
        $user->save();
        return redirect()->route('posts.index', $user->username);
    }
}
