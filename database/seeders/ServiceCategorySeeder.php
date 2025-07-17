<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_categories')->insert([

            [
                'name' => 'Home Visit',
                'caption' => 'Out Patient Care',
                'slug' => 'home-visit',
                'image' =>  null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Video / Audio Consultation',
                'caption' => 'Tele-Channeling',
                'slug' => 'video-audio-consultation',
                'image' =>  null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Channel a Doctor',
                'caption' => 'Specialist Consultations',
                'slug' => 'channel-a-doctor',
                'image' =>  null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Foreign Insurance',
                'caption' => 'Travel & Tourism',
                'slug' => 'foreign-insurance',
                'image' =>  null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Medicine to your Doorstep',
                'caption' => 'Order Medicine',
                'slug' => 'medicine-to-your-doorstep',
                'image' =>  null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Emergency Medical Care',
                'caption' => 'Ambulance Service',
                'slug' => 'emergency-medical-care',
                'image' =>  null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Home Nursing',
                'caption' => 'Care Patients',
                'slug' => 'home-nursing',
                'image' =>  null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
