<?php

namespace App\Http\Controllers;

use App\Entities\Comment;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class CommentsController extends Controller
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

    public function addComment (Request $request)
    {
        try {
            $this->validate($request, [
                'comment' => 'required|string|min:1|max:255',
            ]);

            $comment = $request->input('comment');
            $article_id = (int) $request->input('article_id');

            $user_id = auth()->user()->user_id;

            $objComment = new Comment();
            $objComment = $objComment->create([
                'article_id' => $article_id,
                'user_id' => $user_id,
                'comment' => $comment,
            ]);

            if($objComment){
                return back();
            }

            return back();

        } catch (ValidationException $e) {
            dd($e->getMessage());
        }

    }
}
