@extends('layouts.jarvis')

@section('title', 'COMMAND CENTER')

@section('content')
<div class="stats-grid">
    <!-- Total Protocol -->
    <div class="j-card glow">
        <div class="j-card-header">
            <span class="stat-label">TOTAL PROTOCOLS</span>
            <i class="fas fa-database" style="color:var(--primary)"></i>
        </div>
        <div class="stat-value">{{ $totalTasks }}</div>
        <div style="font-size:10px; color:var(--text-dim); margin-top:5px;">
            DATA INTEGRITY: 100%
        </div>
    </div>

    <!-- Active Protocol -->
    <div class="j-card">
        <div class="j-card-header">
            <span class="stat-label">ACTIVE</span>
            <i class="fas fa-spinner fa-spin" style="color:var(--secondary)"></i>
        </div>
        <div class="stat-value" style="color:var(--secondary)">{{ $pendingTasks }}</div>
        <div style="font-size:10px; color:var(--text-dim); margin-top:5px;">
            AWAITING COMPLETION
        </div>
    </div>

    <!-- Completed -->
    <div class="j-card">
        <div class="j-card-header">
            <span class="stat-label">ARCHIVED</span>
            <i class="fas fa-check-circle" style="color:#0f0"></i>
        </div>
        <div class="stat-value" style="color:#0f0">{{ $completedTasks }}</div>
        <div style="font-size:10px; color:var(--text-dim); margin-top:5px;">
            SUCCESSFULLY EXECUTED
        </div>
    </div>
    
    <!-- System Load (Mockup) -->
    <div class="j-card">
        <div class="j-card-header">
            <span class="stat-label">CPU LOAD</span>
            <i class="fas fa-microchip"></i>
        </div>
        <div class="stat-value">{{ rand(12, 45) }}%</div>
        <div style="width:100%; height:2px; background:rgba(255,255,255,0.1); margin-top:10px;">
            <div style="width:{{ rand(12, 45) }}%; height:100%; background:var(--primary);"></div>
        </div>
    </div>
</div>

<div class="j-card">
    <div class="j-card-header">
        <h3><i class="fas fa-stream"></i> RECENT PROTOCOLS</h3>
        <a href="{{ url('/tasks') }}" style="color:var(--primary); text-decoration:none; font-size:12px;">VIEW ALL ></a>
    </div>
    
    <table class="j-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>PROTOCOL NAME</th>
                <th>T-MINUS (DEADLINE)</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentTasks as $task)
            <tr>
                <td><span style="color:var(--text-dim)">#{{ str_pad($task->id, 4, '0', STR_PAD_LEFT) }}</span></td>
                <td style="font-weight:bold;">{{ $task->name }}</td>
                <td>{{ $task->deadline }}</td>
                <td>
                    @if($task->status == 'Done')
                        <span class="badge badge-done">COMPLETED</span>
                    @else
                        <span class="badge badge-todo">PENDING</span>
                    @endif
                </td>
            </tr>
            @endforeach
            
            @if(count($recentTasks) == 0)
            <tr>
                <td colspan="4" style="text-align:center; padding:20px; color:var(--text-dim);">
                    NO PROTOCOLS FOUND. INITIALIZE NEW TASK.
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

<div style="display:flex; gap:20px; margin-top:20px;">
    <div class="j-card" style="flex:1;">
        <div class="j-card-header">
            <span class="stat-label">AI ASSISTANT</span>
        </div>
        <div style="color:var(--text-dim); font-size:14px; line-height:1.6;">
            > Jarvis System online.<br>
            > Waiting for command...<br>
            > <span class="glow">_</span>
        </div>
    </div>
</div>
@endsection