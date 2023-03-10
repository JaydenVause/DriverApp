<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DayTimeDrivingDrivingInstructor;
use App\Models\DrivingInstructorLocationData;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Rules\AtleastOneOfArray;
use App\Rules\FromTimeGreater;
use App\Models\LocationData;
use Illuminate\Support\Facades\Gate;

class UpdateDrivingInstructorTimetableController extends Controller
{

    /**
     * get instructor update timetable and location table page
     */
    public function index(){
        $user = Auth::user();

        if(!Gate::allows('access-driving-instructor', $user)){
            return abort(403);
        }

        $current_driving_schedule = DayTimeDrivingDrivingInstructor::where('instructor_id', '=', $user->id)->first();
        $current_areas_driving = DrivingInstructorLocationData::where('instructor_id', '=', $user->id)
        ->get('location_data_id');
        $current_areas_driving_ids = [];

        foreach($current_areas_driving as $area){
            $current_areas_driving_ids[] = $area->location_data_id;
        }
        $current_areas_driving = LocationData::whereIn('id', $current_areas_driving_ids)
            ->select('id', 'postcode', 'suburb', 'state')
            ->get();

        return Inertia::render('DrivingInstructor/UpdateProfile', [
            'current_driving_schedule' => $current_driving_schedule,
            'current_areas_driving' => $current_areas_driving,
        ]);
    }

    /**
     * patch up instructor timetable and location table
     */
    public function patch(Request $request){

        $user = Auth::user();
        
        if(!Gate::allows('access-driving-instructor', $user)){
            return abort(403);
        }

        $validated = $request->validate([
            'days_times_driving' => ['required', new AtleastOneOfArray],
            'days_times_driving.*' => [new FromTimeGreater],
            'days_times_driving.*.to' => 'date_format:H:i',
            'days_times_driving.*.from' => 'date_format:H:i',
            'areas_driving' => ['required'],
            'areas_driving.*.id' => 'required|integer'
        ],
        [
            'days_times_driving' => 'You need atleast one day available to drive.',
            'days_times_driving.*.to' => 'Invalid time given.',
            'days_times_driving.*.from' => 'Invalid time given.',

        ]

    );

        $days_times_driving = $validated['days_times_driving'];

        $areas_driving = $validated['areas_driving'];

        $areas_driving_ids = [];

       

        if(!$entry_field = DayTimeDrivingDrivingInstructor::where('instructor_id', $user->id)->first()){
            $entry_field = DayTimeDrivingDrivingInstructor::factory()->for($user)->create();
        }


        foreach($areas_driving as $area_id => $value){
            $areas_driving_ids[] = $area_id;
        }

        DrivingInstructorLocationData::where('instructor_id', $user->id)->whereNotIn('location_data_id', $areas_driving_ids)->delete();

        #manage their field in database
        foreach($days_times_driving as $day_driving => $time_vals){
            if($days_times_driving[$day_driving] !== false){
                $entry_field->{$day_driving.'_to'} = $time_vals['to'];
                $entry_field->{$day_driving.'_from'} = $time_vals['from'];
            }else{
                $entry_field->{$day_driving.'_to'} = null;
                $entry_field->{$day_driving.'_from'} = null;
            }
        }

        $entry_field->save();

        #mark driver as serving those locations
        foreach($areas_driving as $area){
            DrivingInstructorLocationData::create([
                'instructor_id' => $user->id,
                'location_data_id' => $area['id'],
            ]);
        }

        $request->session()->flash('flash.success', 'You have succesfully updated your instructor profile!');
    }
}