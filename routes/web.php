<?php

use App\Http\Controllers\TaskController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AICoreController;
use App\Http\Controllers\DatabaseViewerController;

Route::get('/', [DashboardController::class, 'index']);
Route::get('/ai', [AICoreController::class, 'index'])->name('ai.index');
Route::post('/ai/chat', [AICoreController::class, 'chat'])->name('ai.chat');
Route::get('/database', [DatabaseViewerController::class, 'index'])->name('database.index');

/**
 * HTTPS Method:
 * 1. Get : untuk menampilkan sesuatu 
 * 2. Post : untuk menambahkan data
 * 3. Put : untuk mengubah data 
 * 4. Delete : untuk menghapus data 
 */
//route untuk menampilkan daftar tugas
Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/tasks/list', [TaskController::class, 'list'])->name('tasks.list');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');