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

        return response()->json($resident);
    }

    public function destroy($id)
    {
        Resident::destroy($id);

        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}