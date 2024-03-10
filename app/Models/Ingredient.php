<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = ['meal_id', 'name', 'calories', 'quantity', 'protein', 'fat', 'carbs'];

    // Define the relationship with the Meal model
    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
}
