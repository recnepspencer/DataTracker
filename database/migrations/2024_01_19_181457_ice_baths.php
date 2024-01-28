<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ice_baths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('duration'); // Duration in seconds
            $table->timestamps(); // Automatically adds created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('ice_baths');
    }
};