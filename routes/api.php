<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\API\UserController as APIUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function() {
    Route::get('/user', [APIUserController::class, 'current']);
    Route::get('/user/{user}', [APIUserController::class, 'show']);
    Route::post('/user/{user}', [APIUserController::class, 'update']);
    Route::delete('/user/{user}', [APIUserController::class, 'destroy']);
});
