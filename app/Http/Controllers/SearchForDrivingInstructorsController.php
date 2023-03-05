<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\LocationData;
use App\Models\DrivingInstructorLocationData;
use App\Models\User;
use Inertia\Inertia;

class SearchForDrivingInstructorsController extends Controller
{
    public function find(Request $request){
        $validated = Validator::make($request->all(), [
            'query' => 'required|string|max:255'
        ]);

        $query = $validated->safe()->collect();

        $driving_instructor_ids = DrivingInstructorLocationData::select('instructor_id')->where('location_data_id', $query['query'])->get();

        $location = LocationData::where('id', $query['query'])->first();

        $found_ids = [];

        foreach($driving_instructor_ids as $instructor){
            $found_ids[] = $instructor->instructor_id;
        }

        

        
        $driving_instructors = User::whereIn('id', $found_ids)->get();

        // dd($driving_instructors);
        
        return  Inertia::render('SearchForDrivingInstructors', [
            'driving_instructors' => $driving_instructors,
            'location' => $location
        ]);

    }
}
