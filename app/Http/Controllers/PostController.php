<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{
    public function __construct()
    {
      $this->middleware(['auth'])->only(['store', 'destroy']);   
    }

    public function index()
    {
        /* $posts = Post::get(); // get all posts  */

        // order by created date by default -> show newest posts first
        // "with" allows to load data all at once and in single queries instead of one-by-one ( bindings taken from Post Model)
        $posts = Post::OrderBy('created_at', 'desc')->with(['user', 'likes', 'comments', 'saves'])->paginate(5); // built in pagination iterates and creates pages based on value provided and total posts in DB 
        
        return view('posts.index', [
            'posts' => $posts
        ]); // send all posts to post view!

        // return view('posts.index');
    }

    public function show(Post $post)
    {
        
        return view('posts.show', [
            'post' => $post
        ]); // send post to single post view!

    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required', // laravel docs for validation 
            'title' => 'required|unique:posts|max:128', 
            'image' => 'required|mimes:jpg,png,jpeg|max:5048', 
        ]);
        
        /* (https://laravel.com/docs/8.x/filesystem#other-uploaded-file-information) - to get the information on uploaded file */

        /* Concatenating strings */
        $newImage = time() . '-' . $request->image->getClientOriginalName(); // creating a file path: time() - takes the current Unix timestamp. extension() - > jpg, png...; getClientOriginalName -> name of file from client

        // dd($newImage);
        $request->image->move(public_path('images'), $newImage);

        $request->user()->posts()->create(['body' => $request->body, 'title' => $request->title, 'image_path' => $newImage]); // accessing the logged in user and assigning him to the post which is being created
        
        $posts = Post::OrderBy('created_at', 'desc')->with(['user', 'likes', 'comments', 'saves'])->paginate(5);
        
        return view('posts.index', [
            'posts' => $posts
        ])->with('status', 'Post successfully created!'); // after post created successful -> send alert
    }
    
    public function showEdit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post
        ]); 
    }

    public function create()
    {
        return view('posts.create'); 
    }

    public function update(Request $request, Post $post)
    {
        $post->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        // validate?

        return back()->with('status', 'Post successfully edited!'); // after post edit successful -> send alert
    }

    public function destroy(Post $post, Request $request)
    {
        if(!$post->ownedBy(auth()->user()) && Gate::denies('isAdmin')) {
            return back()->with('status', 'Unauthorized'); // don't allow the user to delete if user doesn't own the post 
        }
 
        $post->delete();
        
        return redirect()->route('posts')->with('status', 'Post successfully deleted!');
    }
}
