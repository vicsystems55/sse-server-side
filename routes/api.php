<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FireEventController;

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\UserProfileController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [ApiAuthController::class, 'register']);

Route::post('/login', [ApiAuthController::class, 'login']);

Route::get('/userData', [UserProfileController::class, 'userData'])->middleware('auth:sanctum');

Route::post('/fire_event', [FireEventController::class, 'api_fire_event'])->name('fire_event');
