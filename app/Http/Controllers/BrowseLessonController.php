<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DrivingLesson;
use Inertia\Inertia;

class BrowseLessonController extends Controller
{
    public function index(){
        $user = Auth::user();

        $driving_lessons = DrivingLesson::where('user_id' , $user->id)->get();

        return Inertia::render('User/DrivingLessons', [
            'driving_lessons' => $driving_lessons
        ]);
    }
}
