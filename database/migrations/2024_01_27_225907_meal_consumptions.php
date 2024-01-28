<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('meal_consumptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Assuming you have a users table
            $table->foreignId('predefined_meal_id')->nullable()->constrained('predefined_meals')->onDelete('set null');
            $table->decimal('amount_consumed')->nullable(); // Amount of the meal consumed by the user
            $table->timestamp('consumed_at'); // When the meal was consumed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meal_consumptions');
    }
};
