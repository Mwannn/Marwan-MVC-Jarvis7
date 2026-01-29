<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('task')->insert([
            [
                'name' => 'Calibrate Arc Reactor',
                'description' => 'Ensure energetic output is stable at 300GJ/s',
                'deadline' => Carbon::now()->addDays(2),
                'status' => 'Pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Upgrade Mark 85 Firmware',
                'description' => 'Install latest combat algorithms and flight stabilizers',
                'deadline' => Carbon::now()->addDays(5),
                'status' => 'Pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Analyze Atmospheric Data',
                'description' => 'Scan for potential threats in the stratosphere',
                'deadline' => Carbon::now()->subDays(1),
                'status' => 'Done',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Secure Server Firewall',
                'description' => 'Patch vulnerability in sector 7',
                'deadline' => Carbon::now()->addHours(5),
                'status' => 'Pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
