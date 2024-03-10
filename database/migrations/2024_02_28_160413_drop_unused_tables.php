<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        // Drop tables in reverse order of their creation
        // to avoid foreign key constraint issues.
        Schema::dropIfExists('meal_consumptions');
        Schema::dropIfExists('meal_compositions');
        Schema::dropIfExists('predefined_meals');
        Schema::dropIfExists('ingredients');

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Recreate dropped tables if necessary.
    }
};