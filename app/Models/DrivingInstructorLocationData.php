<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DrivingInstructorLocationData extends Model
{
    use HasFactory;

    protected $table = 'location_data_driving_instructor';

    protected $fillable = [
        'instructor_id',
        'location_data_id'
    ];

    public function user(){
        return $this->BelongsTo(User::class, 'instructor_id');
    }

    public function locationData(){
        return $this->BelongsTo(LocationData::class, 'location_data_id');
    }
}
