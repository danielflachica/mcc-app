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
            'name' => 'Available',
            'created_at' => Carbon::now(),
        ]);
        DB::table('schedule_statuses')->insert([
            'name' => 'Booked',
            'created_at' => Carbon::now(),
        ]);
        DB::table('schedule_statuses')->insert([
            'name' => 'Cancelled',
            'created_at' => Carbon::now(),
        ]);
        DB::table('schedule_statuses')->insert([
            'name' => 'Completed',
            'created_at' => Carbon::now(),
        ]);
    }
}
