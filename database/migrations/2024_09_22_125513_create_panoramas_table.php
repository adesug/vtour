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
        Schema::create('panoramas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tourist_spot_id');
            $table->string('panorama_url');
            $table->string('title');
            $table->float('pitch')->nullable();
            $table->float('yaw')->nullable();
            $table->foreign('tourist_spot_id')->references('id')->on('tourist_spots')->onDelete('cascade');
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
        Schema::dropIfExists('panoramas');
    }
};
