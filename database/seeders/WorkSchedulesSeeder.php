<?php

namespace Database\Seeders;

use App\Models\WorkSchedule;
use Illuminate\Database\Seeder;

class WorkSchedulesSeeder extends Seeder
{
    public function run()
    {
        $schedules = [
            [
                'day_of_week' => 'Monday',
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
            ],
            [
                'day_of_week' => 'Tuesday',
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
            ],
            [
                'day_of_week' => 'Wednesday',
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
            ],
            [
                'day_of_week' => 'Thursday',
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
            ],
            [
                'day_of_week' => 'Friday',
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
            ],
            [
                'day_of_week' => 'Saturday',
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
            ],
            [
                'day_of_week' => 'Sunday',
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
            ],
        ];

        foreach ($schedules as $scheduleData) {
            WorkSchedule::create($scheduleData);
        }
    }
}
