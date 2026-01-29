@extends('layouts.jarvis')

@section('title', 'PROTOCOL MANAGEMENT')

@section('content')
@if(session('success'))
    <div style="background:rgba(0, 243, 255, 0.1); border:1px solid var(--primary); padding:10px; margin-bottom:20px; color:var(--primary); font-size:12px;">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif

<div class="j-card">
    <div class="j-card-header">
        <h3><i class="fas fa-list"></i> ACTIVE PROTOCOLS</h3>
        <a href="{{ route('tasks.create') }}" class="badge badge-done" style="text-decoration:none;">
            <i class="fas fa-plus"></i> INITIALIZE NEW PROTOCOL
        </a>
    </div>

    <table class="j-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>PROTOCOL NAME</th>
                <th>DESCRIPTION</th>
                <th>DEADLINE</th>
                <th>STATUS</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td><span style="color:var(--text-dim)">#{{ str_pad($task->id, 4, '0', STR_PAD_LEFT) }}</span></td>
                <td style="font-weight:bold; color:var(--primary);">{{ $task->name }}</td>
                <td style="color:var(--text-dim); font-size:12px;">{{ Str::limit($task->description, 50) }}</td>
                <td>{{ $task->deadline }}</td>
                <td>
                    @if($task->status == 'Done')
                        <span class="badge badge-done">COMPLETED</span>
                    @else
                        <span class="badge badge-todo">PENDING</span>
                    @endif
                </td>
                <td style="display:flex; gap:10px;">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="badge" style="background:transparent; border:1px solid var(--text-dim); color:var(--text-dim); cursor:pointer; text-decoration:none;">
                        <i class="fas fa-edit"></i>
                    </a>
                    
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('WARNING: Are you sure you want to terminate this protocol?');" style="margin:0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="badge" style="background:transparent; border:1px solid var(--secondary); color:var(--secondary); cursor:pointer;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
            
            @if($tasks->isEmpty())
            <tr>
                <td colspan="6" style="text-align:center; padding:30px; color:var(--text-dim);">
                    <i class="fas fa-exclamation-triangle" style="margin-bottom:10px; display:block;"></i>
                    NO PROTOCOLS DETECTED. SYSTEM IDLE.
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

<div class="stats-grid" style="margin-top:20px;">
    <div class="j-card">
        <div class="j-card-header">
             <span class="stat-label">PROTOCOL EFFICIENCY</span>
        </div>
        <div class="stat-value">87%</div>
        <div style="font-size:10px; color:var(--text-dim);">OPTIMAL</div>
    </div>
    <div class="j-card">
        <div class="j-card-header">
             <span class="stat-label">SYSTEM UPTIME</span>
        </div>
        <div class="stat-value">{{ rand(100, 500) }}h</div>
        <div style="font-size:10px; color:var(--text-dim);">SINCE LAST REBOOT</div>
    </div>
</div>
@endsection