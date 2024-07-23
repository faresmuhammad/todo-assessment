<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
});


Route::get('tasks', [TaskController::class, 'index']);
Route::post('tasks', [TaskController::class, 'store']);
Route::put('tasks/{task}', [TaskController::class, 'update']);
Route::delete('tasks/{task}', [TaskController::class, 'delete']);
Route::patch('tasks/{id}/restore', [TaskController::class, 'restore']);
