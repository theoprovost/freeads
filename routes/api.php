<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\API\UserController as APIUserController;
use App\Http\Controllers\API\AdsController as AdsController;
use App\Http\Controllers\API\MessagesController as MessagesController;

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
    // User resource
    Route::get('/user', [APIUserController::class, 'current']);
    Route::get('/users', [APIUserController::class, 'getAll']);
    Route::get('/user/{user}', [APIUserController::class, 'show']);

    Route::middleware('owner')->group(function() {
        Route::put('/user/{user}', [APIUserController::class, 'update']);
        Route::delete('/user/{user}', [APIUserController::class, 'destroy']);
    });

    // Ads resources
    Route::get('/ads', [AdsController::class, 'getAll']);
    Route::get('/ads/{ads}', [AdsController::class, 'show']);

    Route::middleware('owner')->group(function() {
        Route::post('/ads', [AdsController::class, 'save']);
        Route::put('/ads/{ads}', [AdsController::class, 'update']);
        Route::delete('/ads/{ads}', [AdsController::class, 'delete']);
        Route::post('/ads/search', [AdsController::class, 'search']);
        Route::post('/upload', [AdsController::class, 'upload']);
    });

    // Media handling : should separate this and remove precedent /upload
    Route::get('/media/types', [App\Http\Controllers\API\MediaTypesController::class, 'index']);
    //Route::post('/media', [App\Http\Controllers\API\UploadController::class , 'store']);
    // TO DO : add delete route

    // Messages
    Route::middleware('owner')->group(function() {
        Route::post('/messages', [MessagesController::class, 'save']);
    });
});
