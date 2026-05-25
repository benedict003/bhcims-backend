<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    protected $fillable = [
        'resident_id',
        'doctor_id',
        'appointment_date',
        'appointment_time',
        'purpose',
        'status',
    ];

    public function resident()
    {
        return $this->belongsTo(User::class, 'resident_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
