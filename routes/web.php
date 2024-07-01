<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/api/login', [AuthController::class, 'login']);
Route::post('register',[AuthController::class, 'register']);

Route::prefix('/api/posts')->group(base_path('routes/posts.php'));

Route::get('/token', function () {
    return csrf_token();
});
