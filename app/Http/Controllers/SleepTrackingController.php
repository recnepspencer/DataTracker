<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SleepTracking;
use Illuminate\Support\Facades\Auth;

class SleepTrackingController extends Controller
{
    // Method to create a new sleep tracking record
    public function store(Request $request)
    {
        $request->validate([
            'sleep_time' => 'required|date',
            'awake_time' => 'required|date',
            'sleep_quality' => 'required|integer|min:1|max:10',
        ]);

        $sleepTracking = new SleepTracking;
        $sleepTracking->user_id = Auth::id();
        $sleepTracking->sleep_time = $request->sleep_time;
        $sleepTracking->awake_time = $request->awake_time;
        $sleepTracking->sleep_quality = $request->sleep_quality;
        $sleepTracking->save();

        return response()->json($sleepTracking, 201);
    }

    // Method to show all sleep tracking records for the authenticated user
    public function index()
    {
        $sleepTrackings = SleepTracking::where('user_id', Auth::id())->get();
        return response()->json($sleepTrackings);
    }

    // Method to update a sleep tracking record
    public function update(Request $request, $id)
    {
        $request->validate([
            'sleep_time' => 'required|date',
            'awake_time' => 'required|date',
            'sleep_quality' => 'required|integer|min:1|max:10',
        ]);

        $sleepTracking = SleepTracking::where('user_id', Auth::id())->findOrFail($id);
        $sleepTracking->sleep_time = $request->sleep_time;
        $sleepTracking->awake_time = $request->awake_time;
        $sleepTracking->sleep_quality = $request->sleep_quality;
        $sleepTracking->save();

        return response()->json($sleepTracking);
    }

    // Method to delete a sleep tracking record
    public function destroy($id)
    {
        $sleepTracking = SleepTracking::where('user_id', Auth::id())->findOrFail($id);
        $sleepTracking->delete();

        return response()->json(null, 204); // No content to return upon successful deletion
    }
}