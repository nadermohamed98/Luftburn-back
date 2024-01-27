<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/',function(){
    return "Hello World";
});

Route::post('/register',[AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'login'] );
Route::post('/logout', [AuthController::class, 'logout'] );

Route::group(['middleware' => 'jwt.auth','prefix' => 'users'], function ($router) {
    Route::get('/',[UserController::class, 'all']);
    Route::post('/add',[UserController::class, 'store']);
});

Route::group(['middleware' => 'jwt.auth','prefix' => 'posts'], function ($router) {
    Route::get('/',[PostController::class, 'all']);
    Route::post('/store',[PostController::class, 'store']);
    Route::get('/{id}',[PostController::class, 'findById']);
    Route::put('/{id}',[PostController::class, 'update']);
    Route::delete('/{id}',[PostController::class, 'destroy']);
});
