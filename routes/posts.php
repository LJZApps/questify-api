<?php

use App\Http\Controllers\PostController;
use App\Http\Middleware\VerifyCsrfTokenMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'getAll']);
Route::post('/create', [PostController::class, 'createPost']);
Route::get('/{id}', [PostController::class, 'getSinglePost']);
