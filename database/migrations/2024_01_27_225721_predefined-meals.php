<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('predefined_meals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('total_servings')->nullable(); // Total number of servings in the meal
            $table->decimal('total_calories')->nullable(); // Optional: total calories of the meal
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('predefined_meals');
    }
};