<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WebsiteController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController;

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
Route::get('websites', [WebsiteController::class, 'index']);
Route::post('website/subscribe', [WebsiteController::class, 'subscribe']);
Route::get('newsletter/{post}', [PostController::class, 'sendEmail']);
Route::get('users', [UserController::class, 'index']);
Route::get('posts', [PostController::class, 'index']);
Route::post('post/save', [PostController::class, 'store']);
//php artisan queue:listen

Route::get('subscribers', [WebsiteController::class, 'userList']);
Route::post('subscribe', [WebsiteController::class, 'saveUser']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
