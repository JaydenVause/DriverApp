<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function drivingInstructorRegistration(): HasOne
    {
        return $this->hasOne(DrivingInstructorRegistration::class);
    }

    public function dayTimeDrivingDrivingInstructor(): HasOne
    {
        return $this->hasOne(DayTimeDrivingDrivingInstructor::class, 'instructor_id');
    }

    public function locationDatas(): BelongsToMany
    {
        return $this
        ->belongsToMany(
            LocationData::class,
             'location_data_driving_instructor', 
             'instructor_id', 
             'location_data_id'
         );
    }

    public function drivingLessons(): HasMany
    {
        return $this->hasMany(DrivingLesson::class, 'instructor_id');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(DrivingLesson::class, 'user_id');
    }
}
