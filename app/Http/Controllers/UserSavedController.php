<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserSavedController extends Controller
{
    public function index(User $user, Post $posts)
    {
        // $posts = $user->saves()->paginate(5); 
        // $posts = auth()->user()->savedPosts;
        
        $posts = $user->savedPosts()->paginate(5); 

        return view('saved', [
            'user' => $user, // pass current user to this route
            'posts' => $posts // pass these saved posts to this route 
        ]);

    }
}