<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserDataController extends Controller
{
    // Method to update user's gender and weight
    public function update(Request $request)
    {
        $request->validate([
            'gender' => 'required|string|max:255',
            'weight' => 'required|numeric',
        ]);

        $user = Auth::user();
        $user->gender = $request->gender;
        $user->weight = $request->weight;
        $user->save();

        return response()->json(['message' => 'User data updated successfully']);
    }

    // Method to retrieve user's gender and weight
    public function show()
    {
        $user = Auth::user();
        return response()->json([
            'gender' => $user->gender,
            'weight' => $user->weight,
        ]);
    }

}