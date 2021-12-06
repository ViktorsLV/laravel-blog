<?php

/* AUth controllers */
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

/* Other page and functionality controllers */
use App\Http\Controllers\PostController;
use App\Http\Controllers\SavedController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

// index controller return page views

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest'); // can assign a name so we can look for this route in links href="{{route('register')}}
Route::post('/register', [RegisterController::class, 'store']); // registers and signs in the user

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout'); // has to be a post route to prevent csrf

Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::post('/posts', [PostController::class, 'store']);
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('/tags', [TagController::class, 'index'])->name('tags')->middleware('auth'); // auth middleware prevents the user from visiting page if he is not logged in

Route::get('/saved', [SavedController::class, 'index'])->name('saved')->middleware('auth');