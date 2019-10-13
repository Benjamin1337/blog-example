<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "articles";

    protected $primaryKey = "article_id";

    protected $fillable = [
        'title',
        'user_id',
        'short_text',
        'full_text',
    ];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    //relation

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_articles', 'article_id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags', 'article_id', 'tag_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id', 'article_id');
    }

    public function image()
    {
        return $this->hasOne(Image::class,'article_id','article_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function like()
    {
        return $this->belongsTo(Like::class, 'user_id', 'user_id');
    }

    public function totalLikes()
    {
        return $this->hasMany(Like::class, 'article_id', 'article_id')->where('like','<>','0');
    }


}
