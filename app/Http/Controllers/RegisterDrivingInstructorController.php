<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Inertia\Inertia;
use App\Models\DrivingInstructorRegistration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class RegisterDrivingInstructorController extends Controller
{   
    /**
     * register as driving instructor page
     */
    public function register(){
        return Inertia::render('DrivingInstructor/Register');
    }

    /**
     * process users driving instructor registration
     */
    public function process(Request $request){

        $user = Auth::user();

        if(count($user->DrivingInstructorRegistration()->get()) >= 1){
            return abort(403);
        }

        $validated = $request->validate([
            'date_of_birth' => 'required|date_format:Y-m-d',
            'drivers_license_number' => 'required|string|max:255',
            'country' => 'required|integer|max:10000',
            'wwcc' => 'required|string|max:255',
            'medical' => [
                'required',
                File::types(['png', 'jpg', 'jpeg'])->min(0)->max(20 * 1024),
            ],
            'tandc' => 'required'
        ]);

        $user = Auth::user();
        $date_of_birth = $validated['date_of_birth'];

        $drivers_license_number = $validated['drivers_license_number'];
        $country = $validated['country'];
        $wwcc = $validated['wwcc'];
        $medical_file = $validated['medical'];
        $tandc = $validated['tandc'];

        DrivingInstructorRegistration::create([
            'user_id' => $user->id,
            'date_of_birth' => $date_of_birth,
            'drivers_license_number' => $drivers_license_number,
            'country_id' => $country,
            'wwcc' => $wwcc,
            'medical' => $medical_file->hashName(),
            'tandc' => $tandc
        ]);

        Storage::put('medicals', $medical_file);

        return Inertia::render('DrivingInstructor/Success')->with('success', 'Registration successful!');
    }
}
