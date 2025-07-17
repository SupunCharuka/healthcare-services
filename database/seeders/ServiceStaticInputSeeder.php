<?php

namespace Database\Seeders;

use App\Models\ServiceStaticInput;
use Illuminate\Database\Seeder;

class ServiceStaticInputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceStaticInput::upsert([
            ['name' => 'Name', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Email', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Phone', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Province/District/City', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Map', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ConferenceMode', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Duration', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'DateAndTime', 'created_at' => now(), 'updated_at' => now()],
        ], 'name');
    }
}
