<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Http\UploadedFile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class InstructorTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_register_instructor_page(){
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/register/driving-instructor');

        $response->assertStatus(200);

    }

    public function test_user_can_register_as_driving_instructor(){
        $user = User::factory()->create();

        $medical = UploadedFile::fake()->image('medical.png')->size(20000);

        $data = [
            'date_of_birth' => '1996-01-17',
            'drivers_license_number' => '2938 2324 2324 2342',
            'country' => '1',
            'wwcc' => '283229384', 
            'medical' => $medical,
            'tandc' => true
        ];


        $date_of_birth =  $data['date_of_birth'];
        $response = $this->actingAs($user)->post('/register/driving-instructor', $data);

        $this->assertDatabaseHas('driving_instructor_registrations', [
            'user_id' => $user->id,
            'date_of_birth' => $date_of_birth,
            'drivers_license_number' => $data['drivers_license_number'],
            'country_id' => $data['country'],
            'wwcc' => $data['wwcc'],
            'medical' => $medical->hashName(),
            'tandc' => true
        ]);

        Storage::disk('medicals')->assertExists($medical->hashName());


        $response->assertStatus(200);

        $response->assertSee('Registration successful!');
    }
}
