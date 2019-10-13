<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    public function uploadImage(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpeg,jpg,png|dimensions:min_width=900',
        ]);

        $path = $request->file('image')->store('uploads', 'public');

        $objImage = new Image;

        $objImage->create([
            'file_name'  => $request->input('file_name'),
            'ext'       =>  $request->input('ext'),
        ]);

        return $path;
    }
}
