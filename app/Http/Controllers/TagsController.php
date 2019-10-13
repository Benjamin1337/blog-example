<?php

namespace App\Http\Controllers;

use App\Entities\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(int $id)
    {

        $objTag = Tag::find($id);
        if (!$objTag){
            return abort(404);
        }


        $articles = $objTag->posts->collect(function ($posts) {
            return [
                'id'         => $posts->id,
                'title'      => $posts->title,
                'author'     => $posts->author,
                'short_text' => $posts->short_text,
                'created_at' => $posts->created_at,
            ];
        });


        $objArtCont = new ArticlesController;

        $categories = $objArtCont->showArticlesCategories();

        $all_tags = $objTag->showTags();

        return view('tags', [
            'articles' => $articles,
            'categories' => $categories,
            'all_tags' => $all_tags,
            'current_tag' => $objTag->name
        ]);
    }

}
