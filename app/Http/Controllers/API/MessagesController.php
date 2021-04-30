<?php

namespace App\Http\Controllers\API;

use App\Models\Messages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MessagesRequest;
use App\Http\Resources\MessagesResource;

class MessagesController extends Controller
{
    public function store(MessagesRequest $request)
    {
        $request->validated();
        $message = new Messages($request->all());
        $message->send_by = Auth::user()->id;
        $message->save();

        return response()->json([
                "data" => [
                    "message" => "Message sent.",
                    "message" => new MessagesResource($message)
                ]
            ]);
    }
}
