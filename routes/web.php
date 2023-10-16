<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/* Ruteo con clojures */
Route::get('/', function () {
    // return view('welcome');
    return view('principal');
});
// Route::get('/crear-cuenta', function () {
//     return view('auth.register');
// });
/* Ruteo con controllers */
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');
// Route::get('/autenticar', [RegisterController::class, 'autenticar']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login');

Route::get('/muro', [PostController::class, 'index'])->name('posts.index');