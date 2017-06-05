<?php

namespace App\Http\Controllers\Files;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CurriculumsController extends Controller
{
    public function get($file)
    {
        // get the image named $slug from storage and display it

        // Something like (not sure)
        $curriculum = Storage::get('curriculums/' . $file );

        return response()->make($curriculum, 200, ['content-type' => 'application/pdf']);
    }
}
