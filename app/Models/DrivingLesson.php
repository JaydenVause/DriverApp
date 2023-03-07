<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrivingLesson extends Model
{
    use HasFactory;

    protected $fillable =  [
        'user_id',
        'instructor_id',
        'lesson_datetime'
    ];
}
