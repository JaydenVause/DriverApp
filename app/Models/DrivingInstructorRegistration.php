<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DrivingInstructorRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'drivers_license_number',
        'country_id',
        'wwcc',
        'medical',
        'tandc'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
