<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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

    public function destroy(Comment $comment, Request $request)
    {
        if(Gate::denies('isAdmin')) {
            return back()->with('status', 'Unauthorized'); // only admins can delete comments
        }

        $comment->delete();
        // dd($request->post());
        // $post->comments()->where('id', $comment->id)->delete();

        return back()->with('status', 'Comment successfully deleted!');
    }
}
