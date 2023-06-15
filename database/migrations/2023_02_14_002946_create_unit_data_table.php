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
        Schema::create('unit_data', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('average_rating', 2, 1)->nullable();
            $table->integer('ratings_count')->nullable();
            $table->text('rules')->nullable();
            $table->text('arrival_instructions')->nullable();
            $table->text('cancellation_policy')->nullable();
            $table->text('parking_information')->nullable();
            $table->text('wifi_information')->nullable();
            $table->integer('unit_id')->unsigned()->nullable();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit_data');
    }
};
