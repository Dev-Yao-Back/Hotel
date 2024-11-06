<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeaderSection;
use App\Models\Hotel;
use Faker\Factory as Faker;

class HeaderSectionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $hotels = Hotel::all();

        foreach ($hotels as $hotel) {
            HeaderSection::create([
                'hotel_id' => $hotel->id,
                'call_number' => $faker->phoneNumber,
                'location' => $faker->address,
                'social_facebook' => $faker->url,
                'social_twitter' => $faker->url,
                'social_instagram' => $faker->url,
                'social_tiktok' => $faker->url,
            ]);
        }
    }
}
