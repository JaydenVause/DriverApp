<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrivingInstructorLocationData extends Model
{
    use HasFactory;

    protected $table = 'location_data_driving_instructor';

    protected $fillable = [
        'instructor_id',
        'location_data_id'
    ];
}
