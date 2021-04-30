<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->query('api_token') || $request->query('api_token') != auth()->user()->api_token) {
            return response()->json([
                "data" => [
                    "message" => "You have to be the owner to perform an action.",
                ]
            ]);
        } else return $next($request);
    }
}
