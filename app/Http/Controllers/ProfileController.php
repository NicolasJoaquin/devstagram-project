<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
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
            'email' => [
                'required', 
                // 'unique:users,username,{auth()->user()->id}', 
                Rule::unique('users', 'email')->ignore(auth()->user()),
                'min:3', 
                'max:60', 
            ],
            'new_password' => ['confirmed'],
            'password' => ['required', 'min:6'],
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
        /* Auth */
        $credentials = $request->only('password');
        $credentials['email'] = auth()->user()->email;
        if(!auth()->attempt($credentials)) {
            return back()->with('message', 'Credenciales incorrectas');
        }
        /* Save new data */
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->new_password)
            $user->password = Hash::make($request->new_password);
        else
            $user->password = Hash::make($request->password);
        if($imageName) {
            $user->image = $imageName;
            if(auth()->user()->image) {
                $old_image_path = public_path('profiles/' . auth()->user()->image);
                if(File::exists($old_image_path)) {
                    unlink($old_image_path);
                }    
            }    
        }
        elseif(auth()->user()->image)
            $user->image = auth()->user()->image;
        else
            $user->image = '';
        $user->save();
        return redirect()->route('posts.index', $user->username);
    }
}
