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
        $validatedData = $request->validate([
            'name' => "required|max:255|min:3",
            'deadline'=>"required|date",
            // 'status'=> "required", // Default to Pending if not provided
            'description'=>'required'
        ]);

        $task = new Task();
        $task->name = $request->name;
        $task->deadline = $request->deadline;
        $task->status = $request->status ?? 'Pending';
        $task->description = $request->description;
        $task->save();

        return redirect('/tasks')->with('success', 'New protocol initialized successfully.');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('task.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => "required|max:255|min:3",
            'deadline'=>"required|date",
            'status'=> "required",
            'description'=>'required'
        ]);

        $task = Task::findOrFail($id);
        $task->name = $request->name;
        $task->deadline = $request->deadline;
        $task->status = $request->status;
        $task->description = $request->description;
        $task->save();

        return redirect('/tasks')->with('success', 'Protocol parameters updated.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('/tasks')->with('success', 'Protocol terminated and removed from archives.');
    }
}