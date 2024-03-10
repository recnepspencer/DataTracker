<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consumption;


class ConsumptionController extends Controller
{
    // Fetch all consumptions
    public function index()
    {
        $consumptions = Consumption::all();
        return response()->json($consumptions);
    }

    // Fetch a single consumption
    public function show($id)
    {
        $consumption = Consumption::findOrFail($id);
        return response()->json($consumption);
    }

    // Store a new consumption
    public function store(Request $request)
    {
        $validated = $request->validate([
            'meal_id' => 'required|integer',
            'servings_consumed' => 'required|integer',
        ]);

        $consumption = new Consumption();
        $consumption->user_id = auth()->id();
        $consumption->meal_id = $validated['meal_id'];
        $consumption->servings_consumed = $validated['servings_consumed'];
        $consumption->save();

        return response()->json($consumption, 201);
    }

    // Update an existing consumption
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'meal_id' => 'required|integer',
            'servings_consumed' => 'required|integer',
        ]);

        $consumption = Consumption::findOrFail($id);
        $consumption->meal_id = $validated['meal_id'];
        $consumption->servings_consumed = $validated['servings_consumed'];
        $consumption->save();

        return response()->json($consumption);
    }

    // Delete a consumption
    public function destroy($id)
    {
        $consumption = Consumption::findOrFail($id);
        $consumption->delete();

        return response()->json(['message' => 'Consumption deleted successfully']);
    }

    public function caloriesLast7Days()
    {
        $caloriesData = Consumption::caloriesConsumedLast7Days();
        return response()->json($caloriesData);
    }

    public function totalMacrosLast7Days()
    {
        $macrosData = Consumption::totalMacrosLast7Days();
        return response()->json($macrosData);
    }
}
