<?php

namespace App\Http\Controllers\Files;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    public function get($file)
    {
        // get the image named $slug from storage and display it

        // Something like (not sure)
        $image = Storage::get('images/' . $file );

        return response()->make($image, 200, ['content-type' => 'image']);
    }
}
