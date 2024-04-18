<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\Ingredient;

class MealController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'recipeName' => 'required|string|max:255',
            'servings' => 'required|integer',
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string|max:255',
            'ingredients.*.calories' => 'required|numeric',
            'ingredients.*.quantity' => 'required|string',
            'ingredients.*.protein' => 'required|numeric',
            'ingredients.*.fat' => 'required|numeric',
            'ingredients.*.carbs' => 'required|numeric',
        ]);

        // Create the meal
        $meal = Meal::create([
            'user_id' => auth()->id(), // Assuming you have authentication
            'recipe' => $validated['recipeName'],
            'servings' => $validated['servings'],
        ]);

        // Loop through each ingredient and create them
        foreach ($validated['ingredients'] as $ingredientData) {
            $meal->ingredients()->create($ingredientData);
        }

        return response()->json(['message' => 'Meal and ingredients added successfully'], 200);
    }

    public function show($mealId)
    {
        $meal = Meal::with('ingredients')->findOrFail($mealId); // Eager load ingredients to minimize queries

        return response()->json($meal, 200);
    }

    public function update(Request $request, $mealId)
    {
        $meal = Meal::findOrFail($mealId);
    
        $validated = $request->validate([
            'recipeName' => 'sometimes|string|max:255',
            'servings' => 'sometimes|integer',
            'ingredients' => 'sometimes|array',
            'ingredients.*.id' => 'required|integer|exists:ingredients,id',
            'ingredients.*.name' => 'sometimes|string|max:255',
            'ingredients.*.quantity' => 'sometimes|string',
            'ingredients.*.protein' => 'sometimes|numeric',
            'ingredients.*.fat' => 'sometimes|numeric',
            'ingredients.*.carbs' => 'sometimes|numeric',
        ]);
    
        $meal->update([
            'recipe' => $validated['recipeName'] ?? $meal->recipe,
            'servings' => $validated['servings'] ?? $meal->servings,
        ]);
    
        if (isset($validated['ingredients'])) {
            foreach ($validated['ingredients'] as $ingredientData) {
                $ingredient = Ingredient::findOrFail($ingredientData['id']);
                $ingredient->update($ingredientData);
            }
        }
    
        return response()->json(['message' => 'Meal and ingredients updated successfully'], 200);
    }

    public function index()
    {
        $meals = Meal::with('ingredients')->get(); // Eager load ingredients to minimize queries

        return response()->json($meals, 200);
    }

    public function destroy($id)
    {
        $meal = Meal::findOrFail($id);

        // Delete the meal
        $meal->delete();

        // Return a response to indicate success
        return response()->json(['message' => 'Meal deleted successfully'], 200);
    }

}
