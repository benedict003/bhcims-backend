<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use App\Models\Consultation;
use App\Models\Appointment;
use App\Models\Medicine;

class DashboardController extends Controller
{
    public function stats()
    {
        return response()->json([
            'residents' => Resident::count(),
            'appointments' => Appointment::count(),
            'consultations' => Consultation::count(),
            'medicines' => Medicine::count(),
        ]);
    }
}
