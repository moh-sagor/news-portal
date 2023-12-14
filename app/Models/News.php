<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'meta_title',
        'meta_description',
        'short_content',
        'content',
        'photo',
        'user_id',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_news');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function commentCount()
    {
        return $this->comments()->count();
    }



}
