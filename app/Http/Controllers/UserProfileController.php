<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index(User $user, Post $posts) 
    {
        $posts = $user->posts()->paginate(5); 

        return view('users.profile.index', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
