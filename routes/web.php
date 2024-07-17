<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/api/auth/login', [AuthController::class, 'login'])->withoutMiddleware('csrf');
Route::post('/api/auth/register', [AuthController::class, 'register'])->withoutMiddleware('csrf');

Route::prefix('/api/posts')->group(base_path('routes/posts.php'));

Route::get('/token', function () {
    return csrf_token();
})->withoutMiddleware('csrf');
