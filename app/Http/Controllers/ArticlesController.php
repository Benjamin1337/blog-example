<?php


namespace App\Http\Controllers;


use App\Entities\Article;
use App\Entities\Category;
use App\Entities\CategoryArticle;
use App\Entities\Image;
use App\Entities\Tag;
use App\Entities\Like;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ArticlesController extends Controller
{
    public function index()
    {
        $objArticle = new Article();
        $articles = $objArticle->where('status', 1)->with('tags', 'image','like','totalLikes', 'user')->orderBy('created_at','desc')->paginate(5);
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

        $article_key = 'article_' . $objArticle->article_id;

        if (!Session::has($article_key)) {
            $objArticle->increment('view_count');
            Session::put($article_key, 1);
        }

        $comments = $objArticle->comments()->where('status', 1)->get();
//        $tags = $objArticle->tags->pluck('name');

        $tags = $objArticle->tags->collect(function ($tags) {
            return [
                'id'         => $tags->id,
                'name'      =>  $tags->name,
            ];
        });


        $similiar_articles = $this->getSimiliarArticles($objArticle);

        $objTag = new Tag;
        $all_tags = $objTag->showTags();

        return view ('show_article', [
            'article' => $objArticle,
            'categories' => $this->showArticlesCategories(),
            'comments' => $comments,
            'tags' => $tags,
            'similiar_articles' => $similiar_articles,
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

    public function likeArticle(Request $request)
    {

        $article_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $article = Article::find($article_id);

        if (!$article) {
            return null;
        }

        $user = Auth::user();
        $like = $user->like()->where('article_id', $article_id)->first();

        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like){
                $like->delete();
                return null;
            }
        } else {
            $like = new Like;
        }

        $like->like = $is_like;
        $like->user_id = $user->user_id;
        $like->article_id = $article->article_id;

        if ($update) {
            $like->update();
        } else {
            $like->save();
        }

        return null;
    }

    public function getPostCategories ($objArticle)
    {

        $mainCategories = $objArticle->categories;

        $arrCategories = [];
        foreach ($mainCategories as $category) {
            $arrCategories[] = $category->id;
        }
        return $arrCategories;
    }

    public function getSimiliarArticles($objArticle)
    {

        $arrCategories = $this->getPostCategories($objArticle);

        $articles = [];

        foreach ($arrCategories as $category_id) {
            $objCategory = Category::find($category_id);
            if (!$objCategory){
                return abort(404);
            }

            $articles[] = $objCategory->posts->collect(function ($posts) {
                return [
                    'id'         => $posts->id,
                    'title'      => $posts->title,
                ];
            });
        }

        return $articles;
    }

}