<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;



    // Auth route
    Route::prefix('auth')->group(function () {
    // Login route
        Route::post('login', [AuthController::class, 'login']);
    // Register route
        Route::post('register', [AuthController::class, 'register']);
    });

    // Admin Controller
Route::group(['middleware' => ['auth:api', 'admin']], function () {
    //User Controller
    Route::prefix('user')->group(function () {
        Route::get('list', [UserController::class, 'list']);
        Route::post('create', [UserController::class, 'store']);
        Route::post('{id}/update', [UserController::class, 'update']);
        Route::get('{id}', [UserController::class, 'show']);
        Route::delete('{id}', [UserController::class, 'delete']);
        });
        //Post Controller
    Route::prefix('post')->group(function () {
        Route::get('list', [PostController::class, 'list']);
        Route::post('create', [PostController::class, 'store']);
        Route::post('{id}/update', [PostController::class, 'update']);
        Route::get('{id}', [PostController::class, 'show']);
        Route::delete('{id}', [PostController::class, 'delete']);
        });
        //Category Controller
    Route::prefix('category')->group(function () {
        Route::get('list', [CategoryController::class, 'list']);
        Route::post('create', [CategoryController::class, 'store']);
        Route::post('{id}/update', [CategoryController::class, 'update']);
        Route::get('{id}', [CategoryController::class, 'show']);
        Route::delete('{id}', [CategoryController::class, 'delete']);
        });
    });

Route::group(['middleware' => ['auth:api', 'author']], function () {
    Route::get('test2', function () {
        return 'Welcome Author!';
    });
});

Route::group(['middleware' => ['auth:api', 'client']], function () {
    Route::get('test3', function () {
        return 'Welcome Client!';
    });
});


Route::get('/', function () {
    return 'Hello World!';
});
