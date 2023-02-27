<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\DrivingInstructorRegistration;
use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Storage;

class AdminTest extends TestCase
{
    /**
     * test admin can access admin dashboard
     */
    public function test_admin_can_access_admin_page(): void
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(200);
    }

    /**
     * tests user logged in to access dashboard
     */
    public function test_must_be_logged_in_to_access_admin_page(){
        $response = $this->get('/admin');
        $response->assertStatus(302);
    }


    /**
     * tests user admin to access dashboard
     */
    public function test_must_be_admin_access_admin_page(){
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(403);
    }

    /**
     * tests admin can access instructor registration applications
     */
    public function test_admin_can_access_instructor_applications(){
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)->get('/admin/approve-instructors');

        $response->assertStatus(200);
    }

    /**
     * tests user logged in to access instructor applications
     */
    public function test_must_be_logged_in_access_approve_instructor_applications(){
        $response = $this->get('/admin/approve-instructors');

        $response->assertStatus(302);
    }

    /**
     * tests user must be logged in to access approve applications page
     */
    public function test_must_be_admin_access_approve_instructor_applications(){
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/approve-instructors');

        $response->assertStatus(403);
    }

    /**
     * tests user is an admin to access approve applications page
     */
    public function test_admin_can_see_applications(){
        $admin = User::factory()->admin()->create();

        $driving_instructors = [];

        $registrations = DrivingInstructorRegistration::factory()
            ->count(3)
            ->for(User::factory())
            ->create();

        $response = $this->actingAs($admin)->get('/admin/approve-instructors');

        $response->assertStatus(200);

        foreach($registrations as $reg){
            $response->assertSee($reg->created_at);
            $response->assertSee($reg->user->name);
            $response->assertSee($reg->user->email);
        }

    }

    /**
     * tests admin can approve driving instructor
     */
    public function test_admin_approve_instructor(){
        $user = User::factory()->admin()->create();

        $application = DrivingInstructorRegistration::factory()->for($user)->create();

        $response = $this->actingAs($user)->post('/admin/approve-instructors/' . $application->id);

        $response->assertStatus(200);

        $this->assertDatabaseHas('driving_instructor_registrations', [
            'id' => $application->id,
            'approved' => true
        ]);
    }

}
