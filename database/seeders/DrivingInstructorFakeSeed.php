<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\LocationData;
use App\Models\DrivingInstructorLocationData;

class DrivingInstructorFakeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = LocationData::all();

        foreach($locations as $location){
            $user = User::factory()->driving_instructor()->create();

            DrivingInstructorLocationData::factory()->for($user)->for($location)->create();

        }
        
    }
}
