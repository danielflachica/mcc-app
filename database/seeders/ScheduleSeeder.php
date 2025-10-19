<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\ScheduleStatus;
use Illuminate\Support\Carbon;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $availableStatus = ScheduleStatus::where('name', 'Available')->value('id');
        $bookedStatus = ScheduleStatus::where('name', 'Booked')->value('id');
        $completedStatus = ScheduleStatus::where('name', 'Completed')->value('id');

        if (!$availableStatus || !$bookedStatus || !$completedStatus) {
            $this->command->warn('Some schedule statuses are missing. Seeding default statuses...');
            $availableStatus = ScheduleStatus::firstOrCreate(['name' => 'Available'])->id;
            $bookedStatus = ScheduleStatus::firstOrCreate(['name' => 'Booked'])->id;
            $completedStatus = ScheduleStatus::firstOrCreate(['name' => 'Completed'])->id;
        }

        $schedules = [];

        // Completed schedules (past week)
        for ($i = 7; $i >= 1; $i--) {
            $start = Carbon::now()->subDays($i)->setTime(rand(9, 17), 0);
            $schedules[] = [
                'schedule_status_id' => $completedStatus,
                'provider_id' => 2,
                'client_id' => 3,
                'starts_at' => $start,
                'ends_at' => (clone $start)->addHour(),
                'notes' => 'Completed consultation session',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Booked schedules (next few days)
        for ($i = 1; $i <= 5; $i++) {
            $start = Carbon::now()->addDays($i)->setTime(rand(9, 17), 0);
            $schedules[] = [
                'schedule_status_id' => $bookedStatus,
                'provider_id' => 2,
                'client_id' => 3,
                'starts_at' => $start,
                'ends_at' => (clone $start)->addHour(),
                'notes' => 'Booked session with client',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Available schedules (next 2 weeks)
        for ($i = 6; $i <= 14; $i++) {
            $start = Carbon::now()->addDays($i)->setTime(rand(8, 18), 0);
            $schedules[] = [
                'schedule_status_id' => $availableStatus,
                'provider_id' => 2,
                'client_id' => null,
                'starts_at' => $start,
                'ends_at' => (clone $start)->addHour(),
                'notes' => 'Available for booking',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Schedule::insert($schedules);

        $this->command->info('✅ Seeded ' . count($schedules) . ' realistic schedules successfully.');
    }
}
