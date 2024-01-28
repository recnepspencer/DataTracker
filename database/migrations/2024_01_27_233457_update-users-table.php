<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Change 'gender' and 'weight' columns to be nullable
            $table->string('gender')->nullable()->change();
            $table->decimal('weight', 8, 2)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert back to non-nullable (assuming they were non-nullable before)
            $table->string('gender')->nullable(false)->change();
            $table->decimal('weight', 8, 2)->nullable(false)->change();
        });
    }
};