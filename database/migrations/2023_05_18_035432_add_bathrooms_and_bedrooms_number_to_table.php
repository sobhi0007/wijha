<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->integer('bathrooms_number')->after('price');
            $table->integer('bedrooms_number')->after('bathrooms_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unit_data', function (Blueprint $table) {
            $table->dropColumn('bathrooms_number');
            $table->dropColumn('bedrooms_number');
        });
    }
};
