<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\DrivingLesson;
class DrivingLessonTest extends TestCase
{
    public function test_user_can_see_driving_lessons(){
        $user = User::factory()->has(DrivingLesson::factory()->count(4), 'lessons')->create();
        $lessons = DrivingLesson::where('user_id', $user->id)->get();

        $response = $this->actingAs($user)->get('/lessons');

        $response->assertStatus(200);

        foreach($lessons as $lesson){
            $lesson = new DateTime($lesson->lesson_datetime);
            $lesson_finish = new DateTime($lesson->finish_datetime);
            $this->assertSee($lesson->format('d/m/Y'));
            $this->assertSee($lesson->format('h:i'));
            $this->assertSee($finish_datetime->format('h:i'));
            

        }
        
    }
}
