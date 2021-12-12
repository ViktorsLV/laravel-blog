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
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserSavedController;
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

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest'); // can only be accessed by NON-authenticated users
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout'); // has to be a post route to prevent csrf

Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::post('/posts', [PostController::class, 'store']);
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show'); // route to show an individual post. The URL consists of /post/{postId}
Route::get('/posts/{post}/edit', [PostController::class, 'showEdit'])->name('posts.edit')->middleware('auth'); // route to edit an individual post can be accessed only by author + additional check for logged in user
Route::put('/posts/{post}/edit', [PostController::class, 'update'])->middleware('auth');; // route to edit an individual post can be performed only by author

Route::get('/users/{user:username}/profile', [UserPostController::class, 'index'])->name('users.posts'); // :username -> extracts this column from route model binding (https://laravel.com/docs/8.x/routing#route-model-binding)

Route::get('/profile/{user:username}/my_profile', [UserProfileController::class, 'index'])->name('user.profile')->middleware('auth'); // returns currently logged in user profile

Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes')->middleware('auth'); // {post} allows us to use route model binding and access the Post Model
Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])->name('posts.likes')->middleware('auth'); // unauthenticated users can't perform these actions

Route::get('/saved/{user:username}/posts', [UserSavedController::class, 'index'])->name('saved')->middleware('auth');
Route::post('/posts/{post}/save-post', [PostSavedController::class, 'store'])->name('posts.save')->middleware('auth'); // {post} allows us to use route model binding and access the Post Model
Route::delete('/posts/{post}/save-post', [PostSavedController::class, 'destroy'])->name('posts.save')->middleware('auth'); // unauthenticated users can't perform these actions

Route::post('/posts/{post}/comments', [PostCommentController::class, 'store'])->name('posts.comments')->middleware('auth'); // comment logic -> similar to likes
Route::delete('/posts/{post}/comments', [PostCommentController::class, 'destroy'])->name('posts.comments')->middleware('auth'); 

// Route::get('/tags', [TagController::class, 'index'])->name('tags');
