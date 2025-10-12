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
            'background_color' => '#2F8F9D',
            'text_color' => '#FFFFFF',
            'created_at' => Carbon::now(),
        ]);
        DB::table('schedule_statuses')->insert([
            'name' => 'Booked',
            'background_color' => '#F4B942',
            'text_color' => '#3B2E05',
            'created_at' => Carbon::now(),
        ]);
        DB::table('schedule_statuses')->insert([
            'name' => 'Cancelled',
            'background_color' => '#E35B5B',
            'text_color' => '#FFFFFF',
            'created_at' => Carbon::now(),
        ]);
        DB::table('schedule_statuses')->insert([
            'name' => 'Completed',
            'background_color' => '#5BA67D',
            'text_color' => '#FFFFFF',
            'created_at' => Carbon::now(),
        ]);
    }
}
