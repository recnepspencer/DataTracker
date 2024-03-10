<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('ingredients', function (Blueprint $table) {
            // Add a new 'meal_id' unsigned big integer column
            $table->unsignedBigInteger('meal_id')->nullable()->after('id');
            // Add a foreign key constraint referencing the 'id' column on the 'meals' table
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('ingredients', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['meal_id']);
            // Remove the 'meal_id' column
            $table->dropColumn('meal_id');
        });
    }
};