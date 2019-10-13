<?php

namespace App\Http\Controllers;

use App\Entities\Tag;
use Illuminate\Http\Request;
use App\Entities\Article;

class SearchController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');

        $articles = \DB::table('articles')
            ->where('title', 'LIKE', '%' . $search . '%')
            ->where('status',1)
            ->get()
            ->all();

        $AArtController = new ArticlesController();

        $objTag = new Tag;
        $all_tags = $objTag->showTags();

        return view('search', [
            'articles' => $articles,
            'categories' => $AArtController->showArticlesCategories(),
            'all_tags' => $all_tags]);
    }
}
