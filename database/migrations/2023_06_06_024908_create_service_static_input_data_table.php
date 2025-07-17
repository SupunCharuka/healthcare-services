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
        Schema::create('service_static_input_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_categories_id')->nullable();
            $table->foreign('service_categories_id')->references('id')->on('service_categories')->onDelete('cascade');
            $table->unsignedBigInteger('service_static_inputs_id')->nullable();
            $table->foreign('service_static_inputs_id')->references('id')->on('service_static_inputs')->onDelete('cascade');
            $table->integer('availability')->nullable();
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
        Schema::dropIfExists('service_static_input_data');
    }
};
