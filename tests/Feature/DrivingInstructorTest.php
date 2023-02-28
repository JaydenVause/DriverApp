<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\LocationData;

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
}
