<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'getAll']);
Route::post('/', [PostController::class, 'createPost']);
Route::patch('/{id}', [PostController::class, 'editPost']);
Route::get('/{id}', [PostController::class, 'getSinglePost']);
