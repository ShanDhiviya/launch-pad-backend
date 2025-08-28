<?php

namespace App\Http\Controllers;
use App\Models\Feature;
use Illuminate\Http\Request;
use App\Http\Requests\FeatureRequest;
use Illuminate\Support\Facades\Auth;

class FeatureController extends Controller
{

    public function index()
    {

        if (Auth::user()->isRole('admin')) {
             return Feature::all();
        }

        return response()->json([
            "message" => "Access denied"
        ], 403);

    }

    public function store(FeatureRequest $request)
    {
        $fields = $request->validated();
        $feature = Feature::create($fields);

        return response()->json([
            'message' => 'Feature created successfully.',
            'data' => $feature
        ], 201);
    }

    public function show(Feature $feature)
    {
        return $feature;
    }

    public function update(FeatureRequest $request, Feature $feature)
    {
        $feature->update($request->validated());

        return response()->json([
            'message' => 'Feature updated successfully.',
            'data' => $feature
        ]);
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();
        return response()->json(['message' => 'Feature deleted successfully'], 204);
    }


    public function status(Request $request)
{
    $status = $request->query('status');
    $query = Feature::query();

    if ($status) {
        $query->where('status', $status);
    }

    return response()->json($query->get());
}

}
