<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToiletUnitPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toilet_unit', function (Blueprint $table) {
            $table->unsignedInteger('toilet_id')->index();
            $table->foreign('toilet_id')->references('id')->on('toilets')->onDelete('cascade');
            $table->unsignedInteger('unit_id')->index();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->primary(['toilet_id', 'unit_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('toilet_unit');
    }
}
