<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    //
    public function index()
    {
         return Appointment::with(['resident', 'doctor'])->get()->map(function ($a) {
        return [
                'id' => $a->id,
                'resident_id' => $a->resident_id,
                'resident_name' => $a->resident?->name,
                'doctor_name' => $a->doctor?->name,
                'appointment_date' => $a->appointment_date,
                'appointment_time' => $a->appointment_time,
                'purpose' => $a->purpose,
                'status' => $a->status,
            ];
    });;
    }

    public function store(Request $request)
{
    $request->validate([
        'resident_id' => 'required',
        'doctor_id' => 'required',
        'appointment_date' => 'required',
        'appointment_time' => 'required',
        'purpose' => 'required',
    ]);

    $user = auth()->user();

if (!$user || !$user->resident) {
    return response()->json([
        'message' => 'Resident profile not found for this user'
    ], 403);
}

$residentId = $user->resident->id;

    $appointment = Appointment::create([
        'resident_id' => $request->resident_id,
        'doctor_id' => $request->doctor_id,
        'appointment_date' => $request->appointment_date,
        'appointment_time' => $request->appointment_time,
        'purpose' => $request->purpose,
        'status' => 'pending',
    ]);

    return response()->json([
        'message' => 'Appointment created successfully',
        'data' => $appointment
    ], 201);
}

    public function show($id)
    {
        return response()->json(
            Appointment::findOrFail($id)
        );
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());

        return response()->json($appointment);
    }

    public function destroy($id)
    {
        Appointment::destroy($id);

        return response()->json(['message' => 'Deleted']);
    }
    
}
