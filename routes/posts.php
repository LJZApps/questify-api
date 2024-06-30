<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/recommended', [PostController::class, 'recommended']);
Route::get('/', [PostController::class, 'getAll']);
