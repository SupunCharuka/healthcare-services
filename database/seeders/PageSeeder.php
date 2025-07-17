<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([

            [
                'title' => 'ABOUT US',
                'slug' => 'about-us',
                'image' => null,
                'content' =>  null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'CONTACT US',
                'slug' => 'contact-us',
                'image' => null,
                'content' =>  null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'TERM CONDITIONS',
                'slug' => 'term-conditions',
                'image' => null,
                'content' =>  null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'PRIVACY POLICY',
                'slug' => 'privacy-policy',
                'image' => null,
                'content' =>  null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
