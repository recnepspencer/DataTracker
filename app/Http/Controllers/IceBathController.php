<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IceBath;
use Illuminate\Support\Facades\Auth;

class IceBathController extends Controller
{
    // Method to create a new ice bath record
    public function store(Request $request)
    {
        $request->validate([
            'duration' => 'required|integer',
        ]);

        $iceBath = new IceBath;
        $iceBath->user_id = Auth::id(); // Assuming the user is authenticated
        $iceBath->duration = $request->duration;
        $iceBath->save();

        return response()->json($iceBath, 201);
    }

    // Method to show all ice baths for the authenticated user
    public function index()
    {
        $iceBaths = IceBath::where('user_id', Auth::id())->get();
        return response()->json($iceBaths);
    }

    // Method to update an ice bath record
    public function update(Request $request, $id)
    {
        $request->validate([
            'duration' => 'required|integer',
        ]);

        $iceBath = IceBath::where('user_id', Auth::id())->findOrFail($id);
        $iceBath->duration = $request->duration;
        $iceBath->save();

        return response()->json($iceBath);
    }

    // Method to delete an ice bath record
    public function destroy($id)
    {
        $iceBath = IceBath::where('user_id', Auth::id())->findOrFail($id);
        $iceBath->delete();

        return response()->json(null, 204); // No content to return upon successful deletion
    }
}