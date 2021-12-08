<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username', // manually added this field 
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token', // can be used to remember user 
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts() 
    {
        return $this->hasMany(Post::class); // one to many relationship type 
    }

    public function likes() 
    {
        return $this->hasMany(Like::class); // same relationship with likes
    }

    public function receivedLikes() 
    {
        return $this->hasManyThrough(Like::class, Post::class); //creates relationship to see how many likes user has received, (NOT GIVEN!) 
    }
    
    public function comments() 
    {
        return $this->hasMany(Comment::class); // user has created many comments
    }

    public function receivedComments() 
    {
        return $this->hasManyThrough(Comment::class, Post::class); 
    }

    public function saves() 
    {
        return $this->hasMany(SavedPost::class); // user can save many posts
    }   

    public function savedPosts() {
        return $this->belongsToMany(Post::class , 'saved_posts' , 'user_id', 'post_id');
    }
}
