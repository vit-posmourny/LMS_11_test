<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogComment extends Model
{
    protected $fillable = ['user_id', 'blog_id', 'comment'];


    function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');  // stačilo by i belongsTo(User::class)
    }
}
