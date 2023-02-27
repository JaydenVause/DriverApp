<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DrivingInstructorRegistration>
 */
class DrivingInstructorRegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date_of_birth' => fake()->date(),
            'drivers_license_number' => fake()->phoneNumber(),
            'country_id' => 1,
            'wwcc' => fake()->phoneNumber(),
            'medical' => '12312094y12097409kaslhdl.png',
            'tandc' => fake()->boolean()
        ];
    }
}
