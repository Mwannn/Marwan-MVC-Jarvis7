<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseViewerController extends Controller
{
    public function index()
    {
        // Get all tables
        $tables = DB::select('SHOW TABLES'); 
        $tableData = [];
        
        foreach ($tables as $table) {
            $tableName = reset($table);
            $count = DB::table($tableName)->count();
            $columns = Schema::getColumnListing($tableName);
            
            $tableData[] = [
                'name' => $tableName,
                'rows' => $count,
                'columns' => count($columns),
                'field_preview' => implode(', ', array_slice($columns, 0, 3)) . (count($columns) > 3 ? '...' : '')
            ];
        }

        return view('database.index', compact('tableData'));
    }
}
