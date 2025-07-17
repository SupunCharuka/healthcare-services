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
            Schema::table('districts', function (Blueprint $table) {
                $table->dropForeign(['province_id']); 
                $table->dropColumn('province_id'); 
            });
    
            Schema::table('services', function (Blueprint $table) {
                $table->dropForeign(['province_id']); 
                $table->dropColumn('province_id'); 
            });
    
            Schema::table('inquiries', function (Blueprint $table) {
                $table->dropForeign(['province_id']); 
                $table->dropColumn('province_id'); 
            });
    
            Schema::table('orders', function (Blueprint $table) {
                $table->dropForeign(['province_id']); 
                $table->dropColumn('province_id'); 
            });
    
            Schema::table('businesses', function (Blueprint $table) {
                $table->dropForeign(['province_id']); 
                $table->dropColumn('province_id'); 
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
