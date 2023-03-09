<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\LocationData;
use App\Models\User;

class UserSearchDrivingInstructorTest extends TestCase
{
    /**
     * tests we can find driving instructor in location id
     */
    public function test_user_can_find_instructors_by_location(): void
    {        
        $driving_instructor = User::factory()->driving_instructor()->has(LocationData::factory())->create();
        $location = $driving_instructor->LocationDatas()->first();
        
        $response = $this->get('/driving-instructors?query='.$location->id);
        
        $response->assertStatus(200);

        $response->assertSee($driving_instructor->name);

    }
}
