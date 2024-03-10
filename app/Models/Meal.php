<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = ['user_id', 'recipe', 'servings'];

    // Define the relationship with the Ingredient model
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    // Assuming you have a User model and want to link the meal to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

}