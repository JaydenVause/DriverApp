<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DrivingLesson extends Model
{
    use HasFactory;

    protected $fillable =  [
        'user_id',
        'instructor_id',
        'lesson_datetime',
        'finish_datetime'
    ];

    

    public function driving_instructor():BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
