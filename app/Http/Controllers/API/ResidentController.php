<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    public function index()
    {
        return response()->json(Resident::all());
    }

    public function store(Request $request)
    {
        return response()->json(
            Resident::create($request->all())
        );
    }

    public function show($id)
    {
        return response()->json(
            Resident::findOrFail($id)
        );
    }

    public function update(Request $request, $id)
    {
        $resident = Resident::findOrFail($id);
        $resident->update($request->all());
        
        $user = auth()->user();
        $resident = $user->resident;

        if (!$resident) {
            return response()->json([
                'message' => 'Resident not found'
            ], 404);
        }

        $resident->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'blood_type' => $request->blood_type,
            'civil_status' => $request->civil_status,
        ]);

        return response()->json([
            'message' => 'Profile updated',
            'resident' => $resident
        ]);
    }

    public function destroy($id)
    {
        Resident::destroy($id);

        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}