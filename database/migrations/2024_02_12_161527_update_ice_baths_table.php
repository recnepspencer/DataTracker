<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('ice_baths', function (Blueprint $table) {
            $table->dateTime('ice_bath_time')->after('duration'); // Add this line to include the new column
        });
    }

    public function down()
    {
        Schema::table('ice_baths', function (Blueprint $table) {
            $table->dropColumn('ice_bath_time'); // Make sure to drop the column in the down method
        });
    }
};