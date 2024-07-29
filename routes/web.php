<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', [UserController::class, 'create']);
Route::post('/store', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

Route::post('/tasks', [TaskController::class, 'store']);
Route::get('/tasks/pending', [TaskController::class, 'getPendingTasks']);
Route::patch('/tasks/{task}', [TaskController::class, 'updateStatus']);

