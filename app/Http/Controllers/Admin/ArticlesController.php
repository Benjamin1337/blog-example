<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Article;
use App\Entities\Category;
use App\Entities\CategoryArticle;
use App\Entities\Image;
use App\Entities\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Entities\TagArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    public function index ()
    {
        $objArticle = new Article();
        $articles = $objArticle->get();


        return view('admin.articles.index', ['articles' => $articles, 'current' => 'articles']);
    }

    public function addArticle ()
    {
        $objCategory = new Category();
        $categories = $objCategory->get();

        $objTag = new Tag();
        $tags = $objTag->get();


        return view ('admin.articles.add', ['categories' => $categories, 'tags' => $tags]);
    }

    public function addRequestArticle(ArticleRequest $request)
    {

        $objArticle = new Article();
        $objCategoryArticle = new CategoryArticle();
        $objTagArticle = new TagArticle();
        $objImage = new Image();

        $this->validate($request, [
            'title' => 'required|string|min:4|max:30',
            'description' => 'required',
            'short_text' => 'required|string|min:4',
            'image' => 'required|mimes:jpeg,jpg,png|dimensions:min_width=900',
        ]);

        $fullText = $request->input('description') ?? null;
        
        $objArticle = $objArticle->create([
            'title'         => $request->input('title'),
            'short_text'    => $request->input('short_text'),
            'full_text'     => $fullText,
            'user_id'       => $user_id = auth()->user()->user_id,

        ]);

        $objImage->create([
            'file_name' => $request->file('image')->store('uploads', 'public'),
            'article_id' => $objArticle->article_id,
        ]);


        if($objArticle) {
            foreach ($request->input('categories') as $category_id) {
                $category_id = (int)$category_id;
                $objCategoryArticle = $objCategoryArticle->create([
                   'category_id' => $category_id,
                   'article_id' => $objArticle->article_id,
                ]);
            }

            foreach ($request->input('tags') as $tag_id) {
                $tag_id = (int)$tag_id;
                $objTagArticle = $objTagArticle->create([
                   'tag_id' => $tag_id,
                   'article_id' => $objArticle->article_id,
                ]);

            }

            return redirect(route('articles'))->with('success', 'Статья успешно изменена');
        }

        return back()->with('error', 'Не удалось изменить статью');

    }

    public function editArticle (int $id)
    {
        $objCategory = new Category();
        $categories = $objCategory->get();

        $objTags = new Tag();
        $tags = $objTags->get();

        $objArticle = Article::find($id);

        if(!$objArticle) {
            return abort(404);
        }

        $mainCategories = $objArticle->categories;

        $arrCategories = [];
        foreach ($mainCategories as $category) {
            $arrCategories[] = $category->id;
        }

        $mainTags = $objArticle->tags;
        $arrTags = [];
        foreach ($mainTags as $mainTag) {
            $arrTags[] = $mainTag->id;
        }


        return view ('admin.articles.edit', [
            'categories' => $categories,
            'tags' => $tags,
            'article' => $objArticle,
            'arrCategories' => $arrCategories,
            'arrTags' => $arrTags,
        ]);

    }

    public function editRequestArticle(int $id, ArticleRequest $request)
    {
        $objArticle = Article::find($id);

        if(!$objArticle) {
            return abort(404);
        }

        $objArticle->title = $request->input('title');
        $objArticle->short_text = $request->input('short_text');
        $objArticle->full_text = $request->input('description');
        $objImage = Image::all()->where('article_id', $id);

        if ($objImage && $request->file('image')) {
            Storage::delete($objImage->file_name);
        }
        if ($request->file('image')) {
            $objImage->create([
                'file_name' => $request->file('image')->store('uploads', 'public'),
                'article_id' => $id,
            ]);
        }

        if ($objArticle->save()) {

            $objArticleCategory = new CategoryArticle();
            $objArticleCategory->where('article_id', $objArticle->article_id)->delete();

            $arrCategories = $request->input('categories');
            if(is_array($arrCategories)){
                foreach ($arrCategories as $category) {
                    $objArticleCategory->create([
                       'category_id' => $category,
                       'article_id' => $objArticle->article_id,
                    ]);
                }
            }

            return redirect(route('articles'))->with('success', 'Статья успешно обновлена');
        }

        return back()->with('error', 'Не удалось изменить статью');

    }

    public function deleteArticle (Request $request)
    {
        if ($request->ajax()) {

            $id = (int)$request->input('id');

            $objArticle = new Article();

            $objArticle->where('article_id', $id)->delete();

            echo "success";
        }
    }

    public function acceptArticle( int $id)
    {
        \DB::table('articles')->where('article_id', $id)->update(['status' => true]);

        return back();
    }
    public function declineArticle( int $id)
    {
        \DB::table('articles')->where('article_id', $id)->update(['status' => false]);

        return back();
    }
}
