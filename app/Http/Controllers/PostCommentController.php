<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function store(Post $post, Request $request) // getting the Post model 
    {
        $this->validate($request, [
            'commentBody' => 'required|max:400', // laravel docs for validation 
        ]);

        $post->comments()->create([
            'user_id' => $request->user()->id, 
            'commentBody' => $request->input('commentBody')
        ]);

        // $request->user()->posts()->comments()->create($request->only(['commentBody'])); // accessing the logged in user and assigning him to the post which is being created

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        $request->user()->comments()->where('post_id', $post->id)->delete();

        return back();
    }
}
