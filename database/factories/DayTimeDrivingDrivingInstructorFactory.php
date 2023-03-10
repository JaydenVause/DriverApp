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

    public function allTimes(): Factory
    {
       return $this->state(function (array $attributes){
             return [
                "monday_from" => '00:00',
                "monday_to" => '23:30',
                "tuesday_from" => '00:00',
                "tuesday_to" => '23:30',
                "wednesday_from" => '00:00',
                "wednesday_to" => '23:30',
                "thursday_from" => '00:00',
                "thursday_to" => '23:30',
                "friday_from" => '00:00',
                "friday_to" => '23:30',
                "saturday_from" => '00:00',
                "saturday_to" => '23:30',
                "sunday_from" => '00:00',
                "sunday_to" => '23:30',
            ];
       });
    }
}
