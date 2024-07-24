<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::get('user', [AuthController::class, 'user']);

Route::post('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware('auth')->controller(TaskController::class)->group(function () {
    Route::get('tasks', 'index');
    Route::get('tasks/trashed', 'trashed');
    Route::get('tasks/{task}', 'show');
    Route::post('tasks', 'store');
    Route::put('tasks/{task}', 'update');
    Route::delete('tasks/{task}', 'delete');
    Route::delete('tasks/{id}/permanent', 'forceDelete');
    Route::patch('tasks/{id}/restore', 'restore');
});

Route::get('categories', function () {
    return Category::select('id as value', 'name as text')->get();
});
