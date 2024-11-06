<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MessageSection;
use App\Models\Hotel;
use Faker\Factory as Faker;

class MessageSectionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $hotels = Hotel::all();

        foreach ($hotels as $hotel) {
            MessageSection::create([
                'hotel_id' => $hotel->id,
                'title' => $faker->sentence,
                'subtitle' => $faker->sentence,
                'background_image' => $faker->imageUrl(1920, 1080, 'message', true, 'Faker'),
                'dg_title' => $faker->jobTitle,
                'dg_subtitle' => $faker->sentence,
                'dg_message' => $faker->paragraph,
                'dg_image' => $faker->imageUrl(200, 200, 'people', true, 'Faker'),
                'dg_signature' => $faker->name,
                'video_url' => $faker->url,
                'video_alt' => $faker->sentence,
            ]);
        }
    }
}
