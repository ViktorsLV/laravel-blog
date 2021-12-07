<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'commentBody',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // creating a relationship allowing to take the user Model from the current comment and display in template
    }
}
