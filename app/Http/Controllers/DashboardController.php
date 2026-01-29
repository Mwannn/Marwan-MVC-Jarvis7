<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch stats for Jarvis Dashboard
        $totalTasks = DB::table('task')->count();
        $pendingTasks = DB::table('task')->where('status', '!=', 'Done')->count();
        $completedTasks = DB::table('task')->where('status', 'Done')->count();
        
        // Get recent tasks
        $recentTasks = DB::table('task')
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact('totalTasks', 'pendingTasks', 'completedTasks', 'recentTasks'));
    }
}
