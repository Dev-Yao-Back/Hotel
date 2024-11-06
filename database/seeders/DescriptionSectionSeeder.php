<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DescriptionSection;
use App\Models\Hotel;
use Faker\Factory as Faker;

class DescriptionSectionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $hotels = Hotel::all();

        foreach ($hotels as $hotel) {
            DescriptionSection::create([
                'hotel_id' => $hotel->id,
                'title' => $faker->sentence,
                'subtitle' => $faker->sentence,
                'content' => $faker->paragraph,
                'button_text' => 'En savoir plus',
                'button_link' => $faker->url,
                'image_1' => $faker->imageUrl(400, 300, 'hotel', true, 'Faker'),
                'image_2' => $faker->imageUrl(400, 300, 'hotel', true, 'Faker'),
                'image_3' => $faker->imageUrl(400, 300, 'hotel', true, 'Faker'),
            ]);
        }
    }
}
