<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;


class ReportController extends Controller
{
    public function index()
    {
        return response()->json(Report::all());
    }

    public function store(Request $request)
    {
        $report = Report::create($request->all());

        return response()->json($report, 201);
    }

    public function update(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $report->update($request->all());

        return response()->json($report);
    }

    public function destroy($id)
    {
        Report::destroy($id);

        return response()->json(['message' => 'Deleted']);
    }
}
