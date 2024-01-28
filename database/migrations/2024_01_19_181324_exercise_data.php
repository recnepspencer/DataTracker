<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('exercise_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('duration'); // Duration in seconds
            $table->enum('intensity_level', ['low', 'moderate', 'intense']);
            $table->decimal('distance')->nullable(); // Distance run, nullable
            $table->boolean('treadmill')->default(false); // True if treadmill
            $table->timestamps(); // Automatically adds created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('exercise_data');
    }
};