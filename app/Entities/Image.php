<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'article_images';
    protected $primaryKey = 'id';

    protected $fillable = [
        'article_id',
        'file_name',
        'ext',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
