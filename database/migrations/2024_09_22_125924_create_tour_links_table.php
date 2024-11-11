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
        Schema::create('tour_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('source_panorama_id');
            $table->unsignedBigInteger('destination_panorama_id');
            $table->string('link_description');
            $table->float('pitch')->nullable();
            $table->float('yaw')->nullable();
            $table->foreign('source_panorama_id')->references('id')->on('panoramas')->onDelete('cascade');
            $table->foreign('destination_panorama_id')->references('id')->on('panoramas')->onDelete('cascade');
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
        Schema::dropIfExists('tour_links');
    }
};
