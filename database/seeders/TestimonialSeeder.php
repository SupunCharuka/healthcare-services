<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Storage;
use Str;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            // Generate a fake image and save it locally
            $imageName = Str::random(10) . '.jpg';
            $imagePath = 'uploads/testimonial/' . $imageName;

            // Use Faker's image generation function to create a local image
            $imageContent = file_get_contents($faker->image(category: 'people'));
            Storage::put($imagePath, $imageContent);

            // Save the testimonial record with the local image path
            Testimonial::create([
                'name' => $faker->name,
                'title' => $faker->jobTitle,
                'image' => $imageName,
                'country' => $faker->country,
                'description' => $faker->paragraph,
                'is_active' => $faker->boolean(90), // 90% chance of being true
            ]);
        }
    }
}
