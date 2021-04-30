<?php

namespace App\Http\Controllers\API;

use App\Models\Ads;
use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\AdsRequest;
use App\Http\Resources\AdsResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AdsCollection;
use App\Http\Requests\AdsSearchRequest;
use Illuminate\Support\Facades\Storage;

class AdsController extends Controller
{
    public function getAll()
    {
        return new AdsCollection(Ads::all());
    }

    public function show(Ads $ads)
    {
        return new AdsResource($ads);
    }

    public function update(AdsRequest $request, Ads $ads)
    {
        $request->validated();

        if ($ads->user_id === Auth::user()->id) {
            $ads->title = $request->title;
            $ads->description = $request->description;
            $ads->photograph = $request->photograph;
            $ads->price = $request->price;

            $ads->save();

            return response()->json([
                "data" => [
                    "message" => "Ads '$ads->title' has been modified.",
                    "ads" => new AdsResource($ads)
                ]
            ]);
        } else {
            return response()->json([
                "data" => [
                    "message" => "You can only modify your own ads.",
                ]
            ]);
        }
    }

    public function save(AdsRequest $request)
    {
        $validated = $request->validated();

        $ads = new Ads($validated);
        $ads->user_id = Auth::user()->id;
        $ads->save();

        return response()->json([
            "data" => [
                "message" => "Ads '$ads->title' has been published.",
                "ads" => new AdsResource($ads)
            ]
        ]);

    }

    public function delete(Ads $ads)
    {
        if ($ads->user_id === Auth::user()->id) {
            $ads->delete();
            return response()->json([
                "data" => [
                    "message" => "Ads '$ads->title' has been deleted.",
                    "deleted_at" => Carbon::now()
                ]
            ]);
        } else {
            return response()->json([
                "data" => [
                    "message" => "You can only delete your own ads.",
                ]
            ]);
        }
    }

    public function retrieveLastAds()
    {
        return Ads::orderBy('created_at', 'desc')->paginate(4);
    }

    public function search(AdsSearchRequest $request)
    {
        $request->validated();

        if (!$request->search == '*') {
            $ads = Ads::where('title', 'like', $request->search . '%')
                ->get();
        } else {
            $ads = Ads::all();
        }

        $count = $ads->count();
        $ads = (new AdsCollection($ads));

        if (!$count) {
            return response()->json([
                "data" => [
                    "message" => "No result for your research.",
                ]
            ]);

        } else {
             $view = view('component.card', [
                'ads' => $ads
            ])->render();

            return response()->json([
                "data" => [
                    "message" => "There is/are $count result(s).",
                    "ads" => (new AdsCollection($ads)),
                    "view" => $view
                ]
            ]);
        }
    }

    public function upload(UploadRequest $request)
    {
        $request->validated();

        $ads_id = $request->ads_id;

        // if (count($request->media) > 1) {
        //     foreach ($request->media as $media) {
        //         $fileName = Str::orderedUuid();
        //         $url = Storage::url($fileName);
        //         $media->storeAs('/public', $fileName);

        //         $media = new Media([
        //             "ads_id" => $ads_id,
        //             "url" => $url
        //         ]);
        //         $media->save();
        //     }
        // } else {
            $fileName = Str::orderedUuid();
            $url = Storage::url($fileName);
            $request->media->storeAs('/public', $fileName);

            $media = new Media([
                    "ads_id" => $ads_id,
                    "url" => $url
                ]);
            $media->save();
        //}

        $ads = Ads::find($ads_id);

        return response()->json([
            "data" => [
                "message" => "New ads n°$ads->id.",
                "ads" => (new AdsResource($ads))
            ]
        ]);
    }
}
