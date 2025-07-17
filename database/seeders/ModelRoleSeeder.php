<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('model_has_roles')->insert(
            [
                // Super Admin
                [
                    'role_id' => '1',
                    'model_id' => '1',
                    'model_type' => 'App\Models\User',
                ],
                // Admin
                [
                    'role_id' => '2',
                    'model_id' => '2',
                    'model_type' => 'App\Models\User',
                ],
                // Member
                [
                    'role_id' => '3',
                    'model_id' => '3',
                    'model_type' => 'App\Models\User',
                ],
                // Customer
                [
                    'role_id' => '4',
                    'model_id' => '4',
                    'model_type' => 'App\Models\User',
                ],
            ]
        );
    }
}
