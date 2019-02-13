<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image as ImageModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Image;

class ImageController extends Controller
{
    public function index() {
        dump(Storage::allFiles('test_files'));
    }

    public function show(Request $request)
    {
        $image = ImageModel::whereOriginalName($request->image)->firstOrFail();
        $path = storage_path('app/'.$image->storeage_path);

        $img = Image::make($path);

        return $img->response(pathinfo($image->original_name)['extension']);
        // $file = File::get($path);
        // $type = File::mimeType($path);
    
        // $response = Response::make($file, 200);
        // $response->header("Content-Type", $type);

        // return $response;
    }

    public function update(Request $request)
    {
        $image = $request->image;
        $storageImage = $image->store('images');

        Image::insert([
            'storeage_path' => $storageImage,
            'real_name' => $image->hashName(),
            'original_name' => $image->getClientOriginalName(),
        ]);
    }
}
