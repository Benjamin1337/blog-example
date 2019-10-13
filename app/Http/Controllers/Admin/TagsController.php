<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Tag;
use App\Http\Controllers\Controller;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        $objTag = new Tag();
        $tags = $objTag->get();

        return view ('admin.tags.index', ['tags' => $tags, 'current' => 'tags']);
    }

    public function addTag()
    {
        return view ('admin.tags.add');
    }

    public function addRequestTag(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string|min:1|max:25',
            ]);

            $objTag = new Tag();
            $objTag = $objTag->create([
                'name' => $request->input('name'),
                'color' => $request->input('color')
            ]);

            if ($objTag) {
                return redirect()->route('tags')->with('success', 'Тэг успешно добавлен');
            }

            return back()->with('error', 'Не удалось добавить тэг');

        } catch (ValidationException $e) {
            \Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function editTag(int $id)
    {
        $tags = Tag::find($id);

        if (!$tags) {
            return abort(404);
        }

        return view ( 'admin.tags.edit ', ['tags' => $tags]);
    }

    public function editRequestTag (Request $request, int $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string|min:1|max:25',
            ]);

            $objTag = Tag::find($id);

            if (!$objTag) {
                return abort(404);
            }

            $objTag->name = $request->input ('name');
            $objTag->color = $request->input('color');

            if ($objTag->save()) {
                return back()->with('success', 'Тэг успешно изменен');
            }

            return back()->with('error', 'Не удалось изменить тэг');

        } catch (ValidationException $e) {
            \Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function deleteTag(Request $request)
    {
        if ($request->ajax()) {

            $id = (int)$request->input('id');

            $objTag = new Tag();

            $objTag->where('id', $id)->delete();

            echo "success";

        }
    }
}

