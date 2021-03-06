<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\TwoFactorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Github auth or registration
Route::get('auth/github', [App\Http\Controllers\GitHubController::class, 'gitRedirect']);
Route::get('auth/github/callback', [App\Http\Controllers\GitHubController::class, 'gitCallback']);


Route::get('verify/resend', [App\Http\Controllers\Auth\TwoFactorController::class, 'resend'])->name('verify.resend');
Route::resource('verify', App\Http\Controllers\Auth\TwoFactorController::class)->only(['index', 'store']);

// Login & Register + verify
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified:web', 'twofactor', 'share_current_user']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
