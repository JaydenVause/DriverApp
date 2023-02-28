<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DayTimeDrivingDrivingInstructor extends Model
{
    use HasFactory;

    protected $table = 'days_times_driving_driving_instructors';

    protected $fillable = [
        'instructor_id',
        'location_data_id'
    ];


    public function user(){
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
