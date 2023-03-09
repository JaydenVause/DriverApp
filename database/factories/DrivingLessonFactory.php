<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DrivingLesson>
 */
class DrivingLessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'instructor_id' => User::factory()->driving_instructor(),
            'lesson_datetime' => '2023-02-27T08:30:00',
            'finish_datetime' => '2023-02-27T09:30:00'
        ];
    }
}
