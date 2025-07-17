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
        Schema::create('bank_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->nullable()->constrained('services')->cascadeOnDelete();
            $table->string('account_holder')->nullable();
            $table->string('account_number')->nullable();
            $table->foreignId('bank_id')->nullable()->constrained('banks')->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('bank_branches')->cascadeOnDelete();
            $table->string('bank_book')->nullable();
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
        Schema::dropIfExists('bank_details');
    }
};
