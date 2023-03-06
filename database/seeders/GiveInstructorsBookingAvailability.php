<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DayTimeDrivingDrivingInstructor;
use App\Models\User;

class GiveInstructorsBookingAvailability extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $driving_instructors = User::where('driving_instructor', true)->get();

        foreach($driving_instructors as $driving_instructor){
            $day_time_driving = DayTimeDrivingDrivingInstructor::factory()->count(1)->for($driving_instructor)->create();
            echo $day_time_driving;
        }
    }
}
