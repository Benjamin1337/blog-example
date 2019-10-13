<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index()
    {

        $comments = (new Comment())->get();
//        $comments = Comment::all();
        $params = [
            'comments' => $comments,
            'current' => 'comments'
        ];

        return view('admin.comments', $params);
    }

    public function acceptComment( int $id)
    {
        \DB::table('comments')->where('id', $id)->update(['status' => true]);

        return back();
    }
}
