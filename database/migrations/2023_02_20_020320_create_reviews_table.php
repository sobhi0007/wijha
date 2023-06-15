<?php

use App\Enums\ReviewStatus;
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
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id')->unsigned()->nullable();
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete("cascade");
            $table->decimal('accuracy', 10, 2)->nullable();
            $table->decimal('cleanliness', 10, 2)->nullable();
            $table->decimal('services', 10, 2)->nullable();
            $table->decimal('location', 10, 2)->nullable();
            $table->decimal('overall_rating', 10, 2)->nullable();
            $table->text('review');
            $table->tinyInteger('status')->default(ReviewStatus::INACTIVE->value);
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
        Schema::dropIfExists('reviews');
    }
};
