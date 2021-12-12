<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
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
            'title' => 'required|unique:posts|max:128', // laravel docs for validation 
        ]);
        
        $request->user()->posts()->create($request->only(['body', 'title'])); // accessing the logged in user and assigning him to the post which is being created
        
        return back(); // to which route go after submission
    }
    
    public function showEdit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post
        ]); 
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
        if(!$post->ownedBy(auth()->user())) {
            return back()->with('status', 'Unauthorized'); // don't allow the user to delete if user doesn't own the post 
        }
 
        $post->delete();

        return back();
    }
}
