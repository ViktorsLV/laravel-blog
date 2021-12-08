<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostSavedController extends Controller
{
    public function store(Post $post, Request $request) // getting the Post model to use it in request
    {
        // don't let the user like the comment twice

        if($post->savedBy($request->user())) {
            return response(null, 409); // conflict code saying the action has already been done. 
        }


        $post->saves()->create([
            'user_id' => $request->user()->id,
        ]);

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        $request->user()->saves()->where('post_id', $post->id)->delete();

        return back();
    }
}
