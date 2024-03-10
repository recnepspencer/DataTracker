<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\Ingredient;

class IngredientController extends Controller
{

    public function store(Request $request, $mealId)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'calories' => 'required|numeric',
            'quantity' => 'required|string', // Notice the validation as a string
            'protein' => 'required|numeric',
            'fat' => 'required|numeric',
            'carbs' => 'required|numeric',
        ]);

        // Find the meal or fail
        $meal = Meal::findOrFail($mealId);

        // Add the ingredient to the meal
        $ingredient = $meal->ingredients()->create($validated);

        // Return a response
        return response()->json($ingredient, 201);
    }

    public function destroy($ingredientId)
    {
        $ingredient = Ingredient::findOrFail($ingredientId);
        $ingredient->delete();
        return response()->json(['message' => 'Ingredient deleted successfully']);
    }
    
    public function update(Request $request, $ingredientId)
    {
        $ingredient = Ingredient::findOrFail($ingredientId);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'calories' => 'sometimes|numeric',
            'quantity' => 'sometimes|string',
            'protein' => 'sometimes|numeric',
            'fat' => 'sometimes|numeric',
            'carbs' => 'sometimes|numeric',
        ]);

        $ingredient->update($validated);

        return response()->json(['message' => 'Ingredient updated successfully'], 200);
    }
}
