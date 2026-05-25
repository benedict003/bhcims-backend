<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Resident extends Model
{
    //
     protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'birth_date',
        'contact_number',
        'address',
        'blood_type',
        'civil_status'
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}
}
