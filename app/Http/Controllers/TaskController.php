<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Mendapatkan dan menampilkan data tugas
    public function index()
    {
        // Mendapatkan data tugas dari model
        $tasks = Task::all(); // Fix: Use :: instead of :
        //dd($tasks);
        // Mengirim data tugas ke view

        // Mengembalikan data tugas ke view
        return view('task.index', [
            'tasks' => $tasks
        ]);
    }
    public function list()
    {
        $tasks = Task::all();
        return view('task.list', compact('tasks'));
    }
    public function create()
    {
        return view('task.create');
    }
    public function store(Request $request)
    {
        //dd($request->all());
        $data =$request->validate([
            'name' => "required|max:255|min:3",
            'deadline'=>"required|date",
            'status'=> "required|in:Belum dikerjakan,Sedang dikerjakan, Selesai",
            'description'=>'required'
        ]);
    }
}