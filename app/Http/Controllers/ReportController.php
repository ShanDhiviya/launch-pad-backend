<?php

namespace App\Http\Controllers;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Report::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       $fields= $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'string|max:255',
            'location'=>'required|string|max:100',
            'date_of_incident'=>'required|date',
            'time_of_incident'=>'required|time',
            'damage_severity'=>'required|string|max:100',
            'estimated_cost'=>'required|numeric',
            'photos'=>'array',
            'status'=>'required|string|max:100',
        ]);

        $post = Post::create($fields);
        return $post;

    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        return $report;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
           $fields= $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'string|max:255',
            'location'=>'required|string|max:100',
            'date_of_incident'=>'required|date',
            'time_of_incident'=>'required|time',
            'damage_severity'=>'required|string|max:100',
            'estimated_cost'=>'required|numeric',
            'photos'=>'array',
            'status'=>'required|string|max:100',
        ]);

        $report->update($fields);
        return $report;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return response()->json(['message' => 'Report deleted successfully'], 204);
    }
}
