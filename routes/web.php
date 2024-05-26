<?php

use App\Http\Controllers\TaskController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
