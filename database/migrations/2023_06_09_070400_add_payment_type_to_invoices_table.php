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
        Schema::table('invoices', function (Blueprint $table) {
            $table->enum('payment_type', ['bank_transfer', 'online'])->nullable()->after('amount');
            $table->string('document')->nullable()->after('payment_type');
            $table->longText('comment')->nullable()->after('document');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('payment_type');
            $table->dropColumn('document');
            $table->dropColumn('comment');
        });
    }
};
