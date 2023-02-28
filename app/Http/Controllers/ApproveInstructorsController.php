<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\DrivingInstructorRegistration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\DrivingInstructor;

class ApproveInstructorsController extends Controller
{
    /**
     * view pending registrations page
     */
    public function index(){
        $user = Auth::user();
        
        if(!Gate::allows('access-secure-file', $user)){
            return abort(403);
        }

        $registrations = DB::table('driving_instructor_registrations')
        ->join('users', 'driving_instructor_registrations.user_id', '=', 'users.id')
        ->select('driving_instructor_registrations.*', 'users.name', 'users.email')
        ->get();

        Return Inertia::render('Admin/ApproveInstructors', [
            'registrations' => $registrations,
        ]);
    }

    /**
     * approve a registration
     */
    public function approve($registration_id){
        $registration = DrivingInstructorRegistration::where('id', $registration_id)->first();
        
        $registration->approved = true;
        
        $user = $registration->user;

        $user->driving_instructor = true;

        $registration->save();

        $user->save();
    }
}
