<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RestaurantSection;
use App\Models\Hotel;
use Faker\Factory as Faker;

class RestaurantSectionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $hotels = Hotel::all();

        foreach ($hotels as $hotel) {
            RestaurantSection::create([
                'hotel_id' => $hotel->id,
                'background_image' => $faker->imageUrl(1920, 1080, 'restaurant', true, 'Faker'),
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'button_text' => 'Voir le restaurant',
                'button_link' => $faker->url,
            ]);
        }
    }
}
