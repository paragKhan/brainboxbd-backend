<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Resources\ArticleController;
use App\Http\Controllers\Resources\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;

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

Route::prefix('admin')->group(function (){
    Route::post('login', [AdminAuthController::class, 'login']);

    Route::middleware('auth:admin_api')->group(function(){
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('articles', ArticleController::class);
    });
});
