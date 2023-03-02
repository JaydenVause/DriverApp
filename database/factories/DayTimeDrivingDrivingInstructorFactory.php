<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DayTimeDrivingDrivingInstructor>
 */
class DayTimeDrivingDrivingInstructorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "monday_from" => '02:00',
            "monday_to" => '04:30',
            "tuesday_from" => '08:00',
            "tuesday_to" => '12:30',
            "friday_from" => '03:30',
            "friday_to" => '06:30'
        ];
    }
}
