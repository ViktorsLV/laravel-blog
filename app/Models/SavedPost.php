<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedPost extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id'
    ];

    protected $table = 'saved_posts'; // reference table name

    public function post() {
        return $this->belongsTo(Post::class); // create relationship with Post 
    }

    public function user() {
        return $this->belongsTo(User::class); // same
    }
}
