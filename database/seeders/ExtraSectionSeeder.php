<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExtraSection;
use App\Models\Hotel;
use Faker\Factory as Faker;

class ExtraSectionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $hotels = Hotel::all();

        foreach ($hotels as $hotel) {
            foreach (range(1, 3) as $index) {
                ExtraSection::create([
                    'hotel_id' => $hotel->id,
                    'title' => $faker->sentence,
                    'subtitle' => $faker->sentence,
                    'background_image' => $faker->imageUrl(1920, 1080, 'extra', true, 'Faker'),
                    'button_text' => 'En savoir plus',
                    'button_link' => $faker->url,
                ]);
            }
        }
    }
}
