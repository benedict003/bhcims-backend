<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    //
    protected $fillable = [
        'resident_id',
        'symptoms',
        'diagnosis',
        'treatment',
        'prescription',
        'consultation_date',
    ];
}
