<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine;

class MedicineController extends Controller
{
    //
    public function index()
    {
        return response()->json(Medicine::all());
    }

    public function store(Request $request)
    {
        return response()->json(
            Medicine::create($request->all())
        );
    }

    public function show($id)
    {
        return response()->json(
            Medicine::findOrFail($id)
        );
    }

    public function update(Request $request, $id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->update($request->all());

        return response()->json($medicine);
    }

    public function destroy($id)
    {
        Medicine::destroy($id);

        return response()->json(['message' => 'Deleted']);
    }
}
