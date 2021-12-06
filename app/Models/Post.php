<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body', // possible to fill in the body with data 
    ];

    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id); // looks up if the like contains the user id that is clicking it right now
    }
    
    // public function ownedBy(User $user)
    // {
    //     return $user->id === $this->user_id; // moved to policy
    // }

    public function user()
    {
        return $this->belongsTo(User::class); // creating a relationship allowing to take the user Model from the current post and display in template
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
