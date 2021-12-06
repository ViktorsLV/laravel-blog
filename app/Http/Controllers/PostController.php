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
        $posts = Post::OrderBy('created_at', 'desc')->paginate(5); // built in pagination iterates and creates pages based on value provided and total posts in DB 
        
        return view('posts.index', [
            'posts' => $posts
        ]); // send all posts to post view!

        // return view('posts.index');
    }

    public function show(Post $post)
    {
        
        return view('posts.show', [
            'post' => $post
        ]); // send all posts to post view!

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required', // laravel docs for validation 
        ]);

        $request->user()->posts()->create($request->only('body')); // accessing the logged in user and assigning him to the post which is being created

        return back(); // to which route go after submit
    }

    public function destroy(Post $post, Request $request)
    {
        // if (!$post->ownedBy(auth()->user())) {
        //     dd('no access');
        // } // moved to policy

        $this->authorize('delete', $post); // policy
 
        $post->delete();

        return back();
    }
}
