<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function store(Post $post, Request $request) // getting the Post model 
    {
        $this->validate($request, [
            'commentBody' => 'required|max:400', // laravel docs for validation 
        ]);

        $post->comments()->create([ // create comment on given post 
            'user_id' => $request->user()->id, // assign the comment to the user
            'commentBody' => $request->input('commentBody') // take the input and add to request
        ]);

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        $request->user()->comments()->where('post_id', $post->id)->delete();

        return back();
    }
}
