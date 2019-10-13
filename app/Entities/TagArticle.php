<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class TagArticle extends Model
{
    protected $table = "article_tags";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'tag_id',
        'article_id',
    ];


}
