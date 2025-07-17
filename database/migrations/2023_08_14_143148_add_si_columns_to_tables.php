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
            Schema::table('service_categories', function (Blueprint $table) {
                $table->string('name_si')->after('name')->nullable();
                $table->string('caption_si')->after('caption')->nullable();
            });

            Schema::table('districts', function (Blueprint $table) {
                $table->string('name_si')->after('name')->nullable();
            });

            Schema::table('cities', function (Blueprint $table) {
                $table->string('name_si')->after('name')->nullable();
            });

            Schema::table('product_categories', function (Blueprint $table) {
                $table->string('name_si')->after('name')->nullable();
            });

            Schema::table('sub_categories', function (Blueprint $table) {
                $table->string('name_si')->after('name')->nullable();
            });

            Schema::table('inputs', function (Blueprint $table) {
                $table->string('placeholder_si')->after('placeholder')->nullable();
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

            Schema::table('service_categories', function (Blueprint $table) {
                $table->dropColumn(['name_si', 'caption_si']);
            });

            Schema::table('districts', function (Blueprint $table) {
                $table->dropColumn('name_si');
            });

            Schema::table('cities', function (Blueprint $table) {
                $table->dropColumn('name_si');
            });

            Schema::table('product_categories', function (Blueprint $table) {
                $table->dropColumn('name_si');
            });

            Schema::table('sub_categories', function (Blueprint $table) {
                $table->dropColumn('name_si');
            });

            Schema::table('inputs', function (Blueprint $table) {
                $table->dropColumn('placeholder_si');
            });
        });
    }
};
