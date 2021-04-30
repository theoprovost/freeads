<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function current(Request $request)
    {
         return new UserResource($request->user());
    }

    public function getAll()
    {
        return new UserCollection(User::all());
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(User $user, UserRequest $request)
    {
        $request->validated();

        if ($user->id == Auth::user()->id) {
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;

            // Pwd hasn't been changed
            $send_pwd = $request->password;
            if (!$send_pwd == 'Fake_password' || !Hash::check($send_pwd, $user->password)) {
                $user->password = Hash::make($send_pwd);
            }

            $user->save();

            return response()->json([
                "message" => "$user->email's account has been updated",
                "user" => new UserResource($user)
            ]);
        } else {
            return response()->json([
                "message" => "You can only modify your own account."
            ]);
        }

         return response()->json([
            "message" => "$user->email's : error updating."
        ]);
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::user()->id) {// uses soft delete
            $user->delete();
            return response()->json([
                "message" => "User : $user->email has been deleted.",
                "deleted_at" => $user->deleted_at
            ]);
        } else {
            return response()->json([
                "message" => "You can only delete your own account.",
            ]);
        }
    }
}
