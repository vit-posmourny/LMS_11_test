<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCategory extends Model
{
    function blogs(): HasMany {
        return $this->hasMany(Blog::class, 'blog_category_id', 'id');
    }
}
