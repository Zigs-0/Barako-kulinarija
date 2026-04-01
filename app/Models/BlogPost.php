<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'status',
        'published_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
