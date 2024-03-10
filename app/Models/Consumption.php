<?php

namespace App\Models;

use Illuminate\Support\Facades\db;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Consumption extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'meal_id', 'servings_consumed'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }

    public static function caloriesConsumedLast7Days()
    {
        return DB::table('consumptions')
            ->join('meals', 'consumptions.meal_id', '=', 'meals.id')
            ->join('ingredients', 'meals.id', '=', 'ingredients.meal_id')
            ->select(
                DB::raw('DAYNAME(consumptions.created_at) as day_of_week'),
                DB::raw('WEEKDAY(consumptions.created_at) as weekday_index'), // Add the weekday index to the selected columns
                DB::raw('SUM((ingredients.calories / meals.servings) * consumptions.servings_consumed) as total_calories')
            )
            ->where('consumptions.created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('day_of_week', 'weekday_index') // Group by both day_of_week and weekday_index
            ->orderBy('weekday_index') // Now, order by the numeric index for correct weekday order
            ->get();
    }

    public static function totalMacrosLast7Days()
    {
        return DB::table('consumptions')
            ->join('meals', 'consumptions.meal_id', '=', 'meals.id')
            ->join('ingredients', 'meals.id', '=', 'ingredients.meal_id')
            ->select(
                DB::raw('SUM(ingredients.protein * (consumptions.servings_consumed / meals.servings)) as total_protein'),
                DB::raw('SUM(ingredients.fat * (consumptions.servings_consumed / meals.servings)) as total_fat'),
                DB::raw('SUM(ingredients.carbs * (consumptions.servings_consumed / meals.servings)) as total_carbs')
            )
            ->where('consumptions.created_at', '>=', Carbon::now()->subDays(7))
            ->get();
    }
}
