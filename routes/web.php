<?php

declare(strict_types=1);

use App\Http\Controllers\Post\CreatePostController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\StorePostController;
use App\Http\Controllers\Post\ValidatePostController;
use Illuminate\Support\Facades\Route;

Route::get('/', PostController::class)
    ->name('posts.index');

Route::get('/create', CreatePostController::class)
    ->name('posts.create');

Route::post('/store', StorePostController::class)
    ->name('posts.store');

Route::post('/validate/{post}', ValidatePostController::class)
    ->name('posts.validate');
