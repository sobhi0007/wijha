<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoolUnitPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pool_unit', function (Blueprint $table) {
            $table->unsignedInteger('pool_id')->index();
            $table->foreign('pool_id')->references('id')->on('pools')->onDelete('cascade');
            $table->unsignedInteger('unit_id')->index();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->primary(['pool_id', 'unit_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pool_unit');
    }
}
