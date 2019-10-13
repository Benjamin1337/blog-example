<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    protected $table = "likes";

    /*protected $primaryKey = "id";

    protected $fillable = [
        'id',
        'article_id',
    ];*/

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
