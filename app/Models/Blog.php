<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id', 'id');
    }

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    function author() : BelongsTo
    {
        return $this->belongsTo(Admin::class, 'user_id', 'id');
    }
}
