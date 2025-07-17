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
        Schema::table('tables', function (Blueprint $table) {

            // Rename column in the 'sub_categories' table
            Schema::table('sub_categories', function (Blueprint $table) {
                $table->renameColumn('service_categories_id', 'service_category_id');
            });

            // Rename column in the 'services' table
            Schema::table('services', function (Blueprint $table) {
                $table->renameColumn('service_categories_id', 'service_category_id');
            });

            // Rename column in the 'inquiries' table
            Schema::table('inquiries', function (Blueprint $table) {
                $table->renameColumn('service_categories_id', 'service_category_id');
            });

             // Rename column in the 'inputs' table
            Schema::table('inputs', function (Blueprint $table) {
                $table->renameColumn('service_categories_id', 'service_category_id');
            });

             // Rename column in the 'service_static_input_data' table
            Schema::table('service_static_input_data', function (Blueprint $table) {
                $table->renameColumn('service_categories_id', 'service_category_id');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
};
