<?php

namespace App\Http\Controllers;
use App\Models\Feature;
use Illuminate\Http\Request;
use App\Http\Requests\FeatureRequest;

class FeatureController extends Controller
{

    public function index()
    {
        return Feature::all();
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
}
