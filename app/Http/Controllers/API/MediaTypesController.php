<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Types\MimeTypes;
use Illuminate\Http\Request;

class MediaTypesController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => [
                'images' => MimeTypes::$images,
                'video' => MimeTypes::$video
            ]
        ]);
    }
}
