<?php

namespace App\Http\Controllers\API;

use App\Models\AdsMedia;
use Illuminate\Http\Request;
use App\Http\Requests\MediaRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\MediaCollection;

class UploadController extends Controller
{

    public function store(MediaRequest $request)
    {
        $createdMedia = collect($request->media)->map(function($media) {
            return $this->addMedia($media);
        }); // Create a collection from the given value.
        return new MediaCollection($createdMedia);
    }

    public function addMedia($media)
    {
        $adsMedia = AdsMedia::create([]); // empty record in DB

        $adsMedia->ads()
            ->associate($adsMedia->addMedia($media)->toMediaCollection()) // $tweetMedia->addMedia($media)->toMediaCollection() creates a record in Media table : methods from MediaLibrary Package
            ->save();

        return $adsMedia;
    }
}