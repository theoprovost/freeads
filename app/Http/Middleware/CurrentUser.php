<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Providers\RouteServiceProvider;

class CurrentUser
{
    /**
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {

        if (Auth::check()) {
            $user = new UserResource(Auth::user());
            $user = collect($user->resource);

            foreach ($user as $key => $value) {
                View::share($key, $value);
            }

        } else View::share('user', false);

        return $next($request);
    }
}
