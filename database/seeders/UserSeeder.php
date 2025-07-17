<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                //Super Admin
                [
                    'name' => 'Super Admin',
                    'email' => 'superadmin@gmail.com',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'password' => bcrypt('password'),
                ],
                //Admin
                [
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'password' => bcrypt('password'),
                ],
                //Member 
                [
                    'name' => 'Member',
                    'email' => 'member@gmail.com',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'password' => bcrypt('password'),
                ],
                 //Customers 
                 [
                    'name' => 'Customer',
                    'email' => 'customer@gmail.com',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'password' => bcrypt('password'),
                ],
            ]
        );
    }
}
