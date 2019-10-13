<?php

namespace App\Http\Controllers;

use App\Entities\Category;
use App\Entities\Tag;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(int $id)
    {

        $objCategory = Category::find($id);
        if (!$objCategory){
            return abort(404);
        }


        $articles = $objCategory->posts->collect(function ($posts) {
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

        return view('categories', [
            'articles' => $articles,
            'categories' => $categories,
            'all_tags' => $all_tags,
            'current_category' => $objCategory
        ]);
    }
}
