<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserPostController;
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
    Route::prefix('admin')->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'list']);
            Route::post('create', [UserController::class, 'store']);
            Route::post('{id}/update', [UserController::class, 'update']);
            Route::get('{id}', [UserController::class, 'show']);
            Route::delete('{id}', [UserController::class, 'delete']);
            });
            //Post Controller
        Route::prefix('post')->group(function () {
            Route::get('/', [PostController::class, 'list']);
            Route::post('create', [PostController::class, 'store']);
            Route::post('{id}/update', [PostController::class, 'update']);
            Route::get('{id}', [PostController::class, 'show']);
            Route::delete('{id}', [PostController::class, 'delete']);
            });
            //Category Controller
        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'list']);
            Route::post('create', [CategoryController::class, 'store']);
            Route::post('{id}/update', [CategoryController::class, 'update']);
            Route::get('{id}', [CategoryController::class, 'show']);
            Route::delete('{id}', [CategoryController::class, 'delete']);
        });
    });
});

Route::group(['middleware' => ['auth:api', 'client']], function () {
    //User Controller
    Route::prefix('client')->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'list']);
            Route::post('update', [UserController::class, 'update']);
            Route::delete('/', [UserController::class, 'delete']);
            });
            //Post Controller
        Route::prefix('post')->group(function () {
            Route::get('/', [PostController::class, 'list']);
            Route::get('mine', [PostController::class, 'mine']);
            Route::post('create', [PostController::class, 'store']);
            Route::post('{id}/update', [PostController::class, 'update']);
            Route::get('{id}', [PostController::class, 'show']);
            Route::delete('{id}', [PostController::class, 'delete']);
            // Reaction
            Route::post('like/{id}', [UserPostController::class, 'makelike']);
            Route::post('comment/{id}', [UserPostController::class, 'makecomment']);
            });
            //Category Controller
        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'list']);
            Route::get('{id}', [CategoryController::class, 'show']);
        });
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
