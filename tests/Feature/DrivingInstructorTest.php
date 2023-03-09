<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\LocationData;
use App\Models\DayTimeDrivingDrivingInstructor;
use App\Models\DrivingInstructorLocationData;

class DrivingInstructorTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Tests instructor can add areas they offer lessons to
     */
    public function test_driving_instructor_manage_profile(){
        #schedule of days of week that instructor is driving

        $location = LocationData::factory()->create();
        $data = [
            'days_times_driving' => [
                'monday' => [
                    'from' => '09:00',
                    'to' => '18:00'
                ],
                'tuesday' => [
                    'from' => '10:30',
                    'to' => '13:00'
                ],
                'friday' => [
                    'from' => '09:00',
                    'to' => '21:00',
                ],
            ],

            'areas_driving' => [
                [
                    'id' => $location->id
                ]
            ],
        ];

        $instructor = User::factory()->driving_instructor()->create();

        $this->actingAs($instructor)->patch('/instructor/update-profile', $data);

        $this->assertDatabaseHas('location_data_driving_instructor', [
            'instructor_id' => $instructor->id,
            'location_data_id' => $data['areas_driving'][0]['id']
        ]);

        $this->assertDatabaseHas('days_times_driving_driving_instructors', 
            [
                'monday_from' => $data['days_times_driving']['monday']['from'],
                'monday_to' => $data['days_times_driving']['monday']['to'],
                'tuesday_to' => $data['days_times_driving']['tuesday']['to'],
                'tuesday_from' => $data['days_times_driving']['tuesday']['from'],
                'friday_from' => $data['days_times_driving']['friday']['from'],
                'friday_to' => $data['days_times_driving']['friday']['to']
            ]
        );
    }

    /**
     * tests that when a driving instructor updates their timetable it removes
     * non existent times and locations
     */
    public function test_updating_profile_removes_removed_data(){
        $instructor = User::factory()->driving_instructor()->create();

        $days_times_driving = DayTimeDrivingDrivingInstructor::factory()->for($instructor)->create();

        $location = DrivingInstructorLocationData::factory()->for($instructor)->for(LocationData::factory()->create())->create();

        $new_location = LocationData::factory()->create();


        $data = [
            'days_times_driving' => [
                'monday' => [
                    'from' => '07:00',
                    'to' => '12:00'
                ],
                'tuesday' => [
                    'from' => '02:30',
                    'to' => '10:00'
                ],
                'friday' => [
                    'from' => '03:00',
                    'to' => '04:00',
                ],
            ],

            'areas_driving' => [
                [
                    'id' => $new_location->id
                ]
            ],
        ];

        $response = $this->actingAs($instructor)->patch('/instructor/update-profile', $data);

        $response->assertOk();

        $this->assertDatabaseMissing('location_data_driving_instructor', [
            'id' => $location->id
        ]);

        $this->assertDatabaseHas('location_data_driving_instructor', [
            'location_data_id' => $new_location->id
        ]);


        $this->assertDatabaseHas('days_times_driving_driving_instructors', [
            'id' => $days_times_driving->id
        ]);



        $this->assertDatabaseHas('location_data_driving_instructor', [
            'id' => $new_location->id
        ]);

        

        $this->assertDatabaseHas('days_times_driving_driving_instructors', [
            'id' => $days_times_driving->id,
            'monday_from' => $data['days_times_driving']['monday']['from'].":00",
            'monday_to' => $data['days_times_driving']['monday']['to'].":00",
            'tuesday_from' => $data['days_times_driving']['tuesday']['from'].":00",
            'tuesday_to' => $data['days_times_driving']['tuesday']['to'].":00",
            'friday_from' => $data['days_times_driving']['friday']['from'].":00",
            'friday_to' => $data['days_times_driving']['friday']['to'].":00",
        ]);
    }


    public function test_driving_instructor_manage_profile_page(){
        $user = User::factory()->driving_instructor()->create();

        $response = $this->actingAs($user)->get('/instructor/update-profile');

        $response->assertStatus(200);
    }

    public function test_must_be_user_instructor_profile(){
        $response = $this->get('/instructor/update-profile');

        $response->assertStatus(302);
    }

    public function test_must_be_driving_instructor_manage_instructor(){
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/instructor/update-profile');

        $response->assertStatus(403);
    }

    public function test_must_be_user_instructor_manage_profile_page(){
        $response = $this->patch('/instructor/update-profile');

        $response->assertStatus(302);
    }

    public function test_must_be_driving_instructor_manage_profile(){
        $user = User::factory()->create();

        $response = $this->actingAs($user)->patch('/instructor/update-profile');

        $response->assertStatus(403);
    }

}
