<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DayTimeDrivingDrivingInstructor;
use App\Models\DrivingInstructorLocationData;
use Illuminate\Support\Facades\Auth;


class UpdateDrivingInstructorTimetableController extends Controller
{
    public function patch(Request $request){
        $validated = $request->validate([
            'days_times_driving' => 'required',
            'days_times_driving.*.to' => 'required|date_format:H:i',
            'days_times_driving.*.from' => 'required|date_format:H:i',
            'areas_driving' => 'required',
            'areas_driving.*.id' => 'required|integer'
        ]);

        $days_times_driving = $validated['days_times_driving'];

        $areas_driving = $validated['areas_driving'];

        $user = Auth::user();

        $entry_field = DayTimeDrivingDrivingInstructor::factory()->for($user)->create();

        #manage their field in database
        foreach($days_times_driving as $day_driving => $time_vals){
            $entry_field->{$day_driving.'_to'} = $time_vals['to'];
            $entry_field->{$day_driving.'_from'} = $time_vals['from'];
        }

        $entry_field->save();

        #mark driver as serving those locations
        foreach($areas_driving as $area){
            DrivingInstructorLocationData::create([
                'instructor_id' => $user->id,
                'location_data_id' => $area['id'],
            ]);
        }

    }
}