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
            'background_color' => '#9fe3dd',
            'text_color' => '#FFFFFF',
            'created_at' => Carbon::now(),
        ]);
        DB::table('schedule_statuses')->insert([
            'name' => 'Booked',
            'background_color' => '#3db5aa',
            'text_color' => '#3B2E05',
            'created_at' => Carbon::now(),
        ]);
        DB::table('schedule_statuses')->insert([
            'name' => 'Cancelled',
            'background_color' => '#e74a3b',
            'text_color' => '#FFFFFF',
            'created_at' => Carbon::now(),
        ]);
        DB::table('schedule_statuses')->insert([
            'name' => 'Completed',
            'background_color' => '#1cc88a',
            'text_color' => '#FFFFFF',
            'created_at' => Carbon::now(),
        ]);
    }
}
