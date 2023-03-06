<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\DayTimeDrivingDrivingInstructor;
use Carbon\Carbon;

class UserBookDrivingInstructorTest extends TestCase
{

    public function test_user_can_get_booking_times(){
        $driving_instructor = User::factory()->driving_instructor()->has(DayTimeDrivingDrivingInstructor::factory())->create();

        $user = User::factory()->create();
         // 2023-02-27T13:00:00.000Z tue 27 march
        $data = [
            'day' => 2,
            'datetime' => '2023-02-27T13:00:00.000Z'
        ];

        $response = $this->actingAs($user)->post('/create-booking/'.$driving_instructor->id.'/get-available-booking-times', $data);

        $response->assertStatus(200);
        
        // is available from 8am-12:30pm
        $response->assertJson([
            'available_booking_times' => [
                '2023-02-27 08:00:00',
                '2023-02-27 08:30:00',
                '2023-02-27 09:00:00',
                '2023-02-27 09:30:00',
                '2023-02-27 10:00:00',
                '2023-02-27 10:30:00',
                '2023-02-27 11:00:00',
                '2023-02-27 11:30:00',
            ] 
        ]);
    }

    /**
     * A basic feature test example.
     */
    public function test_user_can_create_booking(): void
    {

        $user = User::factory()->create();

        $instructor = User::factory()->driving_instructor()->create();

        $response = $this->actingAs($user)->get('/create-booking/'.$instructor->id);

        $response->assertStatus(200);
    }
}
