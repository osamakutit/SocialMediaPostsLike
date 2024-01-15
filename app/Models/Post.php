<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
{
    return $this->belongsTo(User::class, 'author');
}

public function likes()
{
    return $this->hasMany(UserPost::class, 'post_id');
}

public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}
}
