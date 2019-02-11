<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function index()
    {
        return Storage::allFiles('/test_files');
    }

    public function update(Request $request)
    {
        $path = $request->file('test')->store('test_files');
        
        return $path;
    }
}
