<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeQuantityToStringInIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('ingredients', function (Blueprint $table) {
            // Change quantity to string
            $table->string('quantity')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('ingredients', function (Blueprint $table) {
            // Change quantity back to decimal
            $table->decimal('quantity', 8, 2)->change();
        });
    }
}

