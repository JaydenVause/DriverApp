<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SecureFileTest extends TestCase
{

    /**
     * tests admin can access medical files
     */
    public function test_admin_can_access_medical_file(){
        $admin = User::factory()->admin()->create();

        $medical = UploadedFile::fake()->image('medical.png')->size(20000);

        Storage::put('medicals', $medical);

        $response = $this->actingAs($admin)->get('/secure-store/' . $medical->hashName());

        $response->assertOk();

        $response->assertDownload($medical->hashName());
    }

    /**
     * test must be admin to access secure files
     */
    public function test_must_be_admin_access_secure_file(){
        $admin = User::factory()->create();

        $medical = UploadedFile::fake()->image('medical.png')->size(20000);
        
        Storage::put('medicals', $medical);

        $response = $this->actingAs($admin)->get('/secure-store/' . $medical->hashName());

        $response->assertStatus(403);
    }


    /**
     * tests must be logged in to access secure files
     */
    public function test_must_be_logged_in_access_secure_file(){


        $medical = UploadedFile::fake()->image('medical.png')->size(20000);

        Storage::put('medicals', $medical);

        $response = $this->get('/secure-store/' . $medical->hashName());

        $response->assertStatus(302);
    }
}
