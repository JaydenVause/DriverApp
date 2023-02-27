<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Http\UploadedFile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\DrivingInstructorRegistration;


class InstructorRegistrationTest extends TestCase
{
    /**
     * testing that a user can access driving instructor registration page
     */
    public function test_register_instructor_page(){
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/register/driving-instructor');

        $response->assertStatus(200);

    }

    /**
     * tests must be a user to access instructor registration page
     */
    public function test_user_registered_access_instructor_page(){
        $response = $this->get('/register/driving-instructor');

        $response->assertStatus(302);
    }


    /**
     * tests user can register to be a driving instructor
     */
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

    /**
     * tests user cannot submit multiple attempts to be driving instructor
     */
    public function test_cant_register_twice_driving_instructor(){
        $user = User::factory()->has(DrivingInstructorRegistration::factory())->create();

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
        $response->assertStatus(403);
    }

    /**
     * tests user is registered user to register as driving instructor
     */
    public function test_user_must_user_register_driving_instructor(){
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
        
        $response = $this->post('/register/driving-instructor', $data);

        $response->assertStatus(302);
    }

    /**
     * tests driving instructor is registered after approved
     */
    public function test_instructor_registered_after_approved(){
        $instructor = User::factory()->create();

        $registration = DrivingInstructorRegistration::factory()->for($instructor)->create();

        $admin = User::factory()->admin()->create();

        print_r("HELLO WORLD");



        $this->actingAs($admin)->post('/admin/approve-instructors/'.$registration->id);

        $this->assertDatabaseHas('driving_instructors', [
            'user_id' => $instructor->id
        ]);

    }
}
