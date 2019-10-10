<?php


namespace App\Http\Controllers;


use App\Entities\Article;
use App\Entities\Category;
use App\Entities\Tag;

class ArticlesController extends Controller
{
    public function index()
    {
        $objArticle = new Article();
        $articles = $objArticle->with('tags')->orderBy('id','desc')->paginate(10);

        $objTag = new Tag;
        $all_tags = $objTag->showTags();

        return view('index', [
            'articles' => $articles,
            'categories' => $this->showArticlesCategories(),
            'all_tags' => $all_tags]);
    }

    public function showArticle (int $id, $slug)
    {
        $objArticle = Article::find($id);
        if (!$objArticle){
            return abort(404);
        }

        $comments = $objArticle->comments()->where('status', 1)->get();
//        $tags = $objArticle->tags->pluck('name');

        $tags = $objArticle->tags->collect(function ($tags) {
            return [
                'id'         => $tags->id,
                'name'      =>  $tags->name,
            ];
        });

        $objTag = new Tag;
        $all_tags = $objTag->showTags();

        return view ('show_article', [
            'article' => $objArticle,
            'comments' => $comments,
            'tags' => $tags,
            'all_tags' => $all_tags]);
    }

    public function showArticlesCategories ()
    {
        $objCategory = new Category();
        $categories = $objCategory->paginate(6);
        if (!$objCategory){
            return abort(404);
        }

        return $categories;
    }





}