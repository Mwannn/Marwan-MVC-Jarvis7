@extends('layouts.jarvis')

@section('title', 'DATABASE MATRIX')

@section('content')
<div class="stats-grid">
    <div class="j-card">
        <div class="j-card-header">
             <span class="stat-label">TOTAL TABLES</span>
        </div>
        <div class="stat-value">{{ count($tableData) }}</div>
    </div>
    <div class="j-card">
        <div class="j-card-header">
             <span class="stat-label">CONNECTION STATUS</span>
        </div>
        <div class="stat-value" style="color:#0f0; font-size:24px;">STABLE</div>
        <div style="font-size:10px; color:var(--text-dim);">MySQL @ 127.0.0.1</div>
    </div>
</div>

<div class="j-card">
    <div class="j-card-header">
        <h3><i class="fas fa-table"></i> SCHEMA STRUCTURE</h3>
    </div>
    
    <table class="j-table">
        <thead>
            <tr>
                <th>TABLE NAME</th>
                <th>ROW COUNT</th>
                <th>COLUMNS</th>
                <th>PREVIEW FIELDS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tableData as $table)
            <tr>
                <td style="color:var(--primary); font-weight:bold;">{{ $table['name'] }}</td>
                <td>{{ $table['rows'] }} records</td>
                <td>{{ $table['columns'] }} fields</td>
                <td style="color:var(--text-dim); font-size:12px;">{{ $table['field_preview'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
