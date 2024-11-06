<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TestimonialSection;
use App\Models\Hotel;
use Faker\Factory as Faker;

class TestimonialSectionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $hotels = Hotel::all();

        foreach ($hotels as $hotel) {
            foreach (range(1, 3) as $index) {
                TestimonialSection::create([
                    'hotel_id' => $hotel->id,
                    'title' => $faker->sentence,
                    'subtitle' => $faker->sentence,
                    'author' => $faker->name,
                    'rating' => $faker->numberBetween(1, 5),
                    'description' => $faker->paragraph,
                    'source' => $faker->url,
                    'image' => $faker->imageUrl(200, 200, 'people', true, 'Faker'),
                ]);
            }
        }
    }
}
