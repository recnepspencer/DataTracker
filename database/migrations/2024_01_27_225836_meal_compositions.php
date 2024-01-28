<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('meal_compositions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('predefined_meal_id')->constrained('predefined_meals')->onDelete('cascade');
            $table->foreignId('ingredient_id')->constrained('ingredients')->onDelete('cascade');
            $table->decimal('amount_used'); // Amount of ingredient used
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meal_compositions');
    }
};