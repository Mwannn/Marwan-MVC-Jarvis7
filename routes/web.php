<?php

use App\Http\Controllers\TaskController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.index');
});

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