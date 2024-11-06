<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceSection;
use App\Models\Hotel;
use Faker\Factory as Faker;

class ServiceSectionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $hotels = Hotel::all();

        foreach ($hotels as $hotel) {
            foreach (range(1, 5) as $index) {
                ServiceSection::create([
                    'hotel_id' => $hotel->id,
                    'icon' => $faker->imageUrl(50, 50, 'icon', true, 'Faker'),
                    'title' => $faker->sentence,
                    'description' => $faker->paragraph,
                ]);
            }
        }
    }
}
