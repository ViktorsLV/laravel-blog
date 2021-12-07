<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        /* TODO: image? */
        /* TODO: tags */
        'body', // possible to fill in the body with data 
        'title', 
    ];

    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id); // looks up if the like contains the user id that is clicking it right now and returns true if it has been liked - > later can be used in template
    }
    
    public function ownedBy(User $user)
    {
        return $user->id === $this->user_id; // checking if the user_id matches
    }

    public function user()
    {
        return $this->belongsTo(User::class); // creating a relationship allowing to take the user Model from the current post and display in template
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    /* TODO: comments ? */
}
