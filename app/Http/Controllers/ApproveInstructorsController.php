<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\DrivingInstructorRegistration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ApproveInstructorsController extends Controller
{
    public function index(){

        // $registrations = DrivingInstructorRegistration::where('approved', '=', false)->get();

        $user = Auth::user();
        
        if(!Gate::allows('access-secure-file', $user)){
            return abort(403);
        }

        $registrations = DB::table('driving_instructor_registrations')->join('users', 'driving_instructor_registrations.user_id', '=', 'users.id')
        ->select('driving_instructor_registrations.*', 'users.name', 'users.email')->get();

        Return Inertia::render('Admin/ApproveInstructors', [
            'registrations' => $registrations,
        ]);
    }

    public function approve($registration_id){
        $registration = DrivingInstructorRegistration::where('id', $registration_id)->first();
        $registration->approved = true;
        $registration->save();
    }
}
