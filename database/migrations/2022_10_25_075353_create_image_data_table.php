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
        Schema::create('image_data', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->integer('image_id');
            $table->string('category');
            $table->boolean('teaser')->nullable();
            $table->integer('sort_index');
            $table->bigInteger('hotel_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('hotel_id')->references('id')->on('string_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_data');
    }
};
