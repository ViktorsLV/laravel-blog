<?php

/* AUth controllers */
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PostCommentController;
/* Other page and functionality controllers */
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\PostSavedController;
use App\Http\Controllers\SavedController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserPostController;
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
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show'); // route to show an individual post. The URL consists of /post/{postId}

Route::get('/users/{user:username}/posts', [UserPostController::class, 'index'])->name('users.posts'); // :username -> extracts this column from route model binding (https://laravel.com/docs/8.x/routing#route-model-binding)

Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes')->middleware('auth'); // {post} allows us to use route model binding and access the Post Model
Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])->name('posts.likes')->middleware('auth'); // unauthenticated users can't perform these actions

Route::post('/posts/{post}/save-post', [PostSavedController::class, 'store'])->name('posts.save')->middleware('auth'); // {post} allows us to use route model binding and access the Post Model
Route::delete('/posts/{post}/save-post', [PostSavedController::class, 'destroy'])->name('posts.save')->middleware('auth'); // unauthenticated users can't perform these actions

Route::post('/posts/{post}/comments', [PostCommentController::class, 'store'])->name('posts.comments')->middleware('auth'); // comment logic -> similar to likes
Route::delete('/posts/{post}/comments', [PostCommentController::class, 'destroy'])->name('posts.comments')->middleware('auth'); 

Route::get('/tags', [TagController::class, 'index'])->name('tags')->middleware('auth'); // auth middleware prevents the user from visiting page if he is not logged in

Route::get('/saved', [SavedController::class, 'index'])->name('saved')->middleware('auth');