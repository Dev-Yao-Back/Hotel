<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomCarouselSection;
use App\Models\Hotel;
use Faker\Factory as Faker;

class RoomCarouselSectionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $hotels = Hotel::all();

        foreach ($hotels as $hotel) {
            RoomCarouselSection::create([
                'hotel_id' => $hotel->id,
                'title' => $faker->sentence,
                'subtitle' => $faker->sentence,
                'background_image' => $faker->imageUrl(1920, 1080, 'room', true, 'Faker'),
                'button_text' => 'Voir les chambres',
                'button_link' => $faker->url,
            ]);
        }
    }
}
