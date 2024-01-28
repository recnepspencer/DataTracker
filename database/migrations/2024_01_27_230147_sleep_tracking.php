<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sleep_tracking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Assuming you have a users table
            $table->timestamp('sleep_time'); // When the user went to sleep
            $table->timestamp('awake_time'); // When the user woke up
            $table->tinyInteger('sleep_quality')->comment('Sleep quality on a scale of 1-10');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sleep_tracking');
    }
};