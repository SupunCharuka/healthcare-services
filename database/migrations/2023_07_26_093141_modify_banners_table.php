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
        Schema::table('banners', function (Blueprint $table) {
            // Rename the 'order' column to 'local_order'
            $table->renameColumn('order', 'local_order');

            // Add a new column 'foreign_order'
            $table->integer('foreign_order')->nullable()->default(0)->after('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->renameColumn('local_order', 'order');
            $table->dropColumn('foreign_order');
        });
    }
};
