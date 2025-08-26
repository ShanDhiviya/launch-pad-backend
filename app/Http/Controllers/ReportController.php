<?php

namespace App\Http\Controllers;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReportRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReportController extends Controller implements HasMiddleware
{

    public static function middleware(){
        return [new Middleware('auth:sanctum', except:['index','show'])];
    }

    public function index(Request $request)
    {

        if (Auth::user()->isRole('admin')) {
            return Report::with('user')->get();
        }

        return Report::with('user')->where('user_id', Auth::id())->get();

    }

    public function store(ReportRequest $request)
    {

       $fields= $request->validated();

        $report = $request->user()->reports()->create($fields);
        return $report;

    }

    public function show(Report $report)
    {
        return $report;
    }

    public function update(ReportRequest $request, Report $report)
    {

        Gate::authorize('modify', $report);

            $fields= $request->validated();

        $report->update($fields);
             return response()->json([
            'success' => true,
            'message' => 'Report updated successfully.',
            'data' => $report
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        Gate::authorize('modify', $report);
        $report->delete();
        return response()->json(['message' => 'Report deleted successfully'], 204);
    }
}
