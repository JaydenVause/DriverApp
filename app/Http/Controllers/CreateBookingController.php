<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\DayTimeDrivingDrivingInstructor;
use DateTime;
use DateTimezone;

class CreateBookingController extends Controller
{
    public function index($instructor_id){
        return Inertia::render('CreateBooking', [
            'instructor_id' => $instructor_id
        ]);
    }

    public function getAvailableBookingTimes(Request $request, $instructor_id){
        $validated = $request->validate([
            'day' => ['required', 'integer', 'max:6', 'min:0'],
            'datetime' => 'required|string|max:100',
        ]);

        // get day to determine when driver is opertating
        switch ($validated['day']) {
            case 0:
                $day = 'sunday';
                break;
            case 1:
                $day = 'monday';
                break;
            case 2:
                $day = 'tuesday';
                break;
            case 3:
                $day = 'wednesday';
                break;
            case 4:
                $day = 'thursday';
                break;
            case 5:
                $day = 'friday';
                break;
            case 6:
                $day = 'saturday';
                break;
        }

        $driving_availablity = DayTimeDrivingDrivingInstructor::where('instructor_id', $instructor_id)->first();
       // fetch the driving availability for the instructor and day
        if(!isset($driving_availablity->{$day . '_to'}) || !isset($driving_availablity->{$day . '_from'})){
            return;
        }
        $driving_starts = $driving_availablity->{$day.'_from'};
        $driving_finishes = $driving_availablity->{$day.'_to'};

        // convert the datetime string to a DateTime object in UTC timezone
        $date = new DateTime($validated['datetime'], new DateTimeZone('UTC'));

        // create a DateTime object for the same date as the input datetime string and with the time set to the value of $driving_starts
        $appointment_start = new DateTime($date->format('Y-m-d') . ' ' . $driving_starts, new DateTimeZone('UTC'));
        $appointment_end = new DateTime($date->format('Y-m-d') . ' ' . $driving_finishes, new DateTimeZone('UTC'));

        
        // create an empty array to store available appointment times
        $available_times = array();

        // loop over half-hour intervals until we reach the driving finish time
        while ($appointment_start <= $appointment_end) {
            // check if the appointment time is available
            // if (/* add your availability check here */) {
                // if the appointment time is available, add it to the array
                $available_times[] = $appointment_start->format('Y-m-d H:i:s');
            // }
            
            // increment the appointment time by 30 minutes
            $appointment_start->modify('+30 minutes');
        }

        // return the array of available appointment times
        return [
            'available_booking_times' => $available_times
        ];


    }
}
