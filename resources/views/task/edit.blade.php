@extends('layouts.jarvis')

@section('title', 'MODIFY PROTOCOL PARAMETERS')

@section('content')
<div class="j-card" style="max-width: 600px; margin: 0 auto;">
    <div class="j-card-header">
        <h3><i class="fas fa-edit"></i> UPDATE PROTOCOL: #{{ str_pad($task->id, 4, '0', STR_PAD_LEFT) }}</h3>
        <a href="{{ url('/tasks') }}" class="badge" style="background:transparent; color:var(--text-dim); text-decoration:none;">
            <i class="fas fa-arrow-left"></i> CANCEL
        </a>
    </div>

    @if($errors->any())
        <div style="background:rgba(255,0,85,0.1); border:1px solid var(--secondary); padding:10px; margin-bottom:20px; color:var(--secondary); font-size:12px;">
            <strong><i class="fas fa-exclamation-circle"></i> DATA INTEGRITY ERROR:</strong>
            <ul style="margin:5px 0 0 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 20px;">
            <label style="display:block; color:var(--primary); font-size:10px; margin-bottom:5px;">PROTOCOL NAME</label>
            <input type="text" name="name" value="{{ old('name', $task->name) }}" placeholder="ENTER PROTOCOL DESIGNATION" 
                style="width:100%; background:rgba(0,0,0,0.3); border:1px solid rgba(0,243,255,0.3); color:white; padding:10px; outline:none; font-family:inherit;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display:block; color:var(--primary); font-size:10px; margin-bottom:5px;">T-MINUS (DEADLINE)</label>
            <input type="date" name="deadline" value="{{ old('deadline', $task->deadline) }}" 
                style="width:100%; background:rgba(0,0,0,0.3); border:1px solid rgba(0,243,255,0.3); color:white; padding:10px; outline:none; font-family:inherit; color-scheme: dark;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display:block; color:var(--primary); font-size:10px; margin-bottom:5px;">CURRENT STATUS</label>
            <select name="status" style="width:100%; background:rgba(0,0,0,0.3); border:1px solid rgba(0,243,255,0.3); color:white; padding:10px; outline:none; font-family:inherit;">
                <option value="Pending" class="bg-dark" {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>PENDING</option>
                <option value="In Progress" class="bg-dark" {{ old('status', $task->status) == 'In Progress' ? 'selected' : '' }}>IN PROGRESS</option>
                <option value="Done" class="bg-dark" {{ old('status', $task->status) == 'Done' ? 'selected' : '' }}>COMPLETED</option>
            </select>
        </div>

        <div style="margin-bottom: 30px;">
            <label style="display:block; color:var(--primary); font-size:10px; margin-bottom:5px;">MISSION BRIEF (DESCRIPTION)</label>
            <textarea name="description" rows="5" placeholder="ENTER MISSION DETAILS" 
                style="width:100%; background:rgba(0,0,0,0.3); border:1px solid rgba(0,243,255,0.3); color:white; padding:10px; outline:none; font-family:inherit;">{{ old('description', $task->description) }}</textarea>
        </div>

        <div style="text-align:right;">
            <button type="submit" class="badge badge-done" style="font-size:14px; padding:10px 20px; cursor:pointer;">
                <i class="fas fa-sync"></i> UPDATE PROTOCOL
            </button>
        </div>
    </form>
</div>
@endsection
