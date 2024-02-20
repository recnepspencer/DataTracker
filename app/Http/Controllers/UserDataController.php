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
            'gender' => 'sometimes|string|max:255',
            'weight' => 'sometimes|numeric',
        ]);
    
        $user = Auth::user();
    
        // Update gender only if it's provided in the request
        if ($request->has('gender')) {
            $user->gender = $request->input('gender');
        }
    
        // Update weight only if it's provided in the request
        if ($request->has('weight')) {
            $user->weight = $request->input('weight');
        }
    
        $user->save();
    
        return response()->json(['message' => 'User data updated successfully']);
    }

    // Method to retrieve user's gender and weight
    public function show()
    {
        $user = Auth::user();
        return response()->json([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'username' => $user->username,
            'gender' => $user->gender,
            'weight' => $user->weight,
        ]);
    }

}