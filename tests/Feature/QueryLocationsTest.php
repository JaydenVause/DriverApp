<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\LocationData;
use App\Models\User;

class QueryLocationsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $location = LocationData::factory()->create();

        $data = [
            'id' => $location->id,
            'suburb' => $location->suburb,
            'postcode' => $location->postcode,
            'state' => $location->state
        ];

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/search/location-data?query='.$location->postcode);

        $response->assertStatus(200);

        $response->assertJson([$data], $strict=false);
    }
}
