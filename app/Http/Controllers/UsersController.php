<?php

namespace App\Http\Controllers;

use App\Entities\Tag;
use App\Entities\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index (int $id)
    {
        $objUser = User::find($id);
        if (!$objUser){
            return abort(404);
        }


        $articles = $objUser->posts->collect(function ($posts) {
            return [
                'id'         => $posts->id,
                'title'      => $posts->title,
                'short_text' => $posts->short_text,
                'created_at' => $posts->created_at,
            ];
        });

        $objArtCont = new ArticlesController;

        $categories = $objArtCont->showArticlesCategories();

        $objTag = new Tag;

        $all_tags = $objTag->showTags();

        return view('user', [
            'articles' => $articles,
            'user'     => $objUser,
            'categories' => $categories,
            'all_tags' => $all_tags,
        ]);
    }
}
