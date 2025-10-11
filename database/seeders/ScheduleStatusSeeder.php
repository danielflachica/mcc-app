<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('schedule_statuses')->insert([
            'status' => 'Available',
            'created_at' => Carbon::now(),
        ]);
        DB::table('schedule_statuses')->insert([
            'status' => 'Booked',
            'created_at' => Carbon::now(),
        ]);
        DB::table('schedule_statuses')->insert([
            'status' => 'Cancelled',
            'created_at' => Carbon::now(),
        ]);
        DB::table('schedule_statuses')->insert([
            'status' => 'Completed',
            'created_at' => Carbon::now(),
        ]);
    }
}
