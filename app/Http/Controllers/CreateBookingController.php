<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\DayTimeDrivingDrivingInstructor;
use DateTime;
use DateTimezone;
use App\Models\DrivingLesson;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CreateBookingController extends Controller
{

    public function process_booking(Request $request, $instructor_id){
        $validated = $request->validate([
            'dates' => 'required|date_format:Y-m-d h:i:s'
        ]);
        
        $user = Auth::user();

        $instructor = User::where('id', $instructor_id)->first();

        $booking = $validated['dates'];

        
        $datetime_start = new DateTime($booking);
        $datetime_finish = new DateTime($booking);
        $datetime_finish->modify('+1 hour');
        DrivingLesson::create([
            'user_id' => $user->id,
            'instructor_id' => $instructor->id,
            'lesson_datetime' => $datetime_start->format('Y-m-d H:i'),
            'finish_datetime' => $datetime_finish->format('Y-m-d H:i')
        ]);
    

        return to_route('dashboard', [
            'messages' => [
                'main' => 'Booking completed!'
            ],
        ]);
    }

    public function index($instructor_id){
        return Inertia::render('CreateBooking', [
            'instructor_id' => $instructor_id
        ]);
    }

    public function getDaysWithTimeslot(Request $request, $instructor_id){
    $validated = $request->validate([
        'dates' => 'required',
        'dates.*' => 'date_format:Y-m-d'
    ]);

    $dates = $validated['dates'];
    $times_available_to_from = DayTimeDrivingDrivingInstructor::where('instructor_id', $instructor_id)->first();
    
    $dates_available = [];
    $driving_instructors_schedule = [];

    foreach($dates as $date){
        $day = new DateTime($date);
        $day_name = strtolower($day->format('l'));
       
        $time_instructors_schedule[$day_name]['from'] = $times_available_to_from->{$day_name . '_from'};
        $time_instructors_schedule[$day_name]['to'] = $times_available_to_from->{$day_name . '_to'};
        $driving_instructor_bookings[$date] = 
        DrivingLesson::where('instructor_id', $instructor_id)->where('lesson_datetime', 'like', $date.'%')->get();
    }

    // dd($dates, $driving_instructors_schedule);

    foreach($dates as $date){
        //check if driving instructor has 1 hour of free timeslots between times he is driving
        $dateTimeCurrent = new DateTime($date);
        $day_name = strtolower($dateTimeCurrent->format('l'));
        $booking_allowed = false;

        // check instructor is driving on that day
        if(!$time_instructors_schedule[$day_name]['to'] && !$time_instructors_schedule[$day_name]['from']){
            continue;
        }

        //get the day that that date is of
        $day = new DateTime($date);
        $day_name = strtolower($day->format('l'));
        
        //start from when driver starts driving
        $day_current = new DateTime($date . ' ' . $time_instructors_schedule[$day_name]['from']);
        //when driver finishes driving
        $day_end = new DateTime($date . ' ' . $time_instructors_schedule[$day_name]['to']);

        $x = 0;

        while($day_current < $day_end){
            foreach($driving_instructor_bookings[$date] as $booking ){
                $booking = new DateTime($booking->lesson_datetime);

                if($day_current == $booking){
                    $day_current->modify('+30 minutes');
                    $x = 0;
                    continue;
                }
                $day_current->modify('+30 minutes');
                $x += 1;
                continue;
            }
            $day_current->modify('+30 minutes');

            $x += 1;

            if($x >= 2){
               $booking_allowed = true;
               break;
            }
        }

        // dd($x, $day_current);
            
        if($booking_allowed){
            $dates_available[] = $date;
        }
    }

    // dd($dates_available);
    
    return [
        'days_available' => $dates_available
    ];
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

        // get current driving lessons
        $driving_instructor = User::where('id', $instructor_id)->first();

       

        $driving_availablity = DayTimeDrivingDrivingInstructor::where('instructor_id', $instructor_id)->first();
       // fetch the driving availability for the instructor and day
        if(!isset($driving_availablity->{$day . '_to'}) || !isset($driving_availablity->{$day . '_from'})){
            return;
        }
        $driving_starts = $driving_availablity->{$day.'_from'};
        $driving_finishes = $driving_availablity->{$day.'_to'};

        // convert the datetime string to a DateTime object in UTC timezone
        $date = new DateTime($validated['datetime']);
        
        

        // create a DateTime object for the same date as the input datetime string and with the time set to the value of $driving_starts
        $appointment_start = new DateTime($date->format('Y-m-d') . ' ' . $driving_starts);
        $appointment_end = new DateTime($date->format('Y-m-d') . ' ' . $driving_finishes);

        
        // create an empty array to store available appointment times
        $available_times = array();




        // loop over half-hour intervals until we reach the driving finish time
        while ($appointment_start < $appointment_end) {
            // check if the appointment time is available
                $shallow_copy = clone $appointment_start;

                $conflicting_appointments = $driving_instructor
                ->drivingLessons()
                ->where('lesson_datetime', '=', $appointment_start->format('Y-m-d h:i:s')) #check booking isnt made for when date made
                ->orWhere('lesson_datetime',  '=', $shallow_copy->modify('+30 minutes')->format('Y-m-d H:i:s')) #check booking isnt made for 30 minute after date
                ->orWhere('lesson_datetime',  '=', $shallow_copy->modify('-60 minutes')->format('Y-m-d H:i:s')) #check booking isnt made for 30 minutes before
                ->get();

                

                if(! count($conflicting_appointments) > 0){
                    // if the appointment time is available, add it to the array
                    $available_times[] = $appointment_start->format('Y-m-d H:i:s');    
                }

                
            
            // increment the appointment time by 30 minutes
            $appointment_start->modify('+30 minutes');
        }


        return [
            'available_booking_times' => $available_times
        ];

        // return the array of available appointment times
       




    }
}
