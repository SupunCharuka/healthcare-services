<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        User::where('member_type', 'service_provider')->update(['member_type' => 'service-provider']);
        DB::statement("ALTER TABLE `users` CHANGE `member_type` `member_type` ENUM('customer', 'service-provider', 'doctor', 'hotel') NULL DEFAULT NULL;");
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
