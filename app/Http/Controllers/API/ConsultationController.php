<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\Medicine;
use App\Models\InventoryLog;

class ConsultationController extends Controller
{
    //
    public function index()
{
    return Consultation::with(['resident', 'doctor'])
        ->get()
        ->map(function ($c) {
            return [
                'id' => $c->id,
                'resident_id' => $c->resident_id,
                'resident_name' => $c->resident?->name ?? 'Unknown',
                'doctor_name' => $c->doctor?->name ?? 'Unknown',
                'symptoms' => $c->symptoms,
                'diagnosis' => $c->diagnosis,
                'treatment' => $c->treatment,
                'consultation_date' => $c->consultation_date,
            ];
        });

    $query = Consultation::with(['resident', 'doctor']);

    // FILTER BY LOGGED USER (resident)
    if ($request->has('resident_id')) {
        $query->where('resident_id', $request->resident_id);
    }

    return $query->get()->map(function ($c) {
        return [
            'id' => $c->id,
            'resident_id' => $c->resident_id,
            'resident_name' => $c->resident?->name,
            'doctor_name' => $c->doctor?->name,
            'diagnosis' => $c->diagnosis,
            'symptoms' => $c->symptoms,
            'treatment' => $c->treatment,
            'consultation_date' => $c->consultation_date,
            'status' => $c->status,
        ];
    });
}

    public function store(Request $request)
{
    try {

        $request->validate([
            'resident_id' => 'required',
            'symptoms' => 'required',
            'diagnosis' => 'required',
            'medicine_id' => 'nullable|exists:medicines,id',
            'quantity_used' => 'nullable|integer|min:1',
        ]);

        $consultation = Consultation::create([
            'resident_id' => $request->resident_id,
            'symptoms' => $request->symptoms,
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
            'prescription' => $request->prescription,
            'consultation_date' => $request->consultation_date,
        ]);

        if ($request->medicine_id && $request->quantity_used > 0) {

            $medicine = Medicine::find($request->medicine_id);

            if (!$medicine) {
                return response()->json(['message' => 'Medicine not found'], 404);
            }

            if ($medicine->stock_quantity < $request->quantity_used) {
                return response()->json(['message' => 'Not enough stock'], 400);
            }

            $medicine->stock_quantity -= $request->quantity_used;
            $medicine->save();

            // SAFE CHECK (IMPORTANT)
            if (method_exists($medicine, 'inventoryLogs')) {
                $medicine->inventoryLogs()->create([
                    'quantity' => $request->quantity_used,
                    'type' => 'deducted'
                ]);
            }
        }

        return response()->json([
            'message' => 'Consultation created successfully',
            'data' => $consultation
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Server error',
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function show($id)
    {
        return response()->json(
            Consultation::findOrFail($id)
        );
    }

    public function update(Request $request, $id)
    {
        $consultation = Consultation::findOrFail($id);
        $consultation->update($request->all());

        return response()->json($consultation);
    }

    public function destroy($id)
    {
        Consultation::destroy($id);

        return response()->json(['message' => 'Deleted']);
    }
}
