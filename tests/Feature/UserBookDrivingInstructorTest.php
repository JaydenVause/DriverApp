<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\DayTimeDrivingDrivingInstructor;
use Carbon\Carbon;
use DateTime;
use App\Models\DrivingLesson;

class UserBookDrivingInstructorTest extends TestCase
{

    use RefreshDatabase;

    /**
     * tests a user can make a booking with an available driving instructor
     */
    public function test_user_can_book_instructor(){
        $user = User::factory()->create();
        $instructor = User::factory()->driving_instructor()->has(DayTimeDrivingDrivingInstructor::factory())->create();

        $data = [
            'time_length' => '1',
            'dates' => '2023-03-06 08:00:00' #mon 6 mar
        ];

        $finish_datetime = new DateTime($data['dates']);

        $finish_datetime->modify('+1 hour');

        $response = $this->actingAs($user)->post('/create-booking/'.$instructor->id.'/process', $data);

        $response->assertStatus(302);

        $this->assertDatabaseHas('driving_lessons', [
            'user_id' => $user->id,
            'instructor_id' => $instructor->id,
            'lesson_datetime' => $data['dates'],
            'finish_datetime' => $finish_datetime->format('Y-m-d h:i:s'),
        ]);
    }

    /**
     * tests a user can get available booking dates that driving instructor has not booked all timeslots
     */
    public function test_user_can_get_dates_available_booking_times(){
        $driving_instructor = User::factory()->driving_instructor()->has(DayTimeDrivingDrivingInstructor::factory())->create();
        //mon tue fri available
        $data = [
            'dates' => [
                '2023-03-05', #sun
                '2023-03-06', #mon
                '2023-03-07', #tue
                '2023-03-08', #wed
                '2023-03-09', #thur
                '2023-03-10', #fri
                '2023-03-11', #sat
            ]
        ];

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/create-booking/'.$driving_instructor->id.'/get-days-with-timeslot', $data);

        $response->assertStatus(200);

        $response->assertJson([
            'days_available' => [
                $data['dates'][1],
                $data['dates'][2],
                $data['dates'][5]
            ]
        ]);
    }

    /**
     * tests user can get driving instructors available booking times
     */
    public function test_user_can_get_booking_times(){
        $driving_instructor = User::factory()->driving_instructor()->has(DayTimeDrivingDrivingInstructor::factory())->create();

        $user = User::factory()->create();

        $driving_lesson = DrivingLesson::factory()->for($driving_instructor, 'driving_instructor')->count(2)->create();

        # set date that we want available booking time for
        $data = [
            'day' => 2,
            'datetime' => '2023-02-27T13:00:00.000Z'
        ];

        #make request to get booking for
        $response = $this->actingAs($user)->post('/create-booking/'.$driving_instructor->id.'/get-available-booking-times', $data);

        $response->assertStatus(200);
        
        #assert available booking times
        $response->assertJson([
            'available_booking_times' => [
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
