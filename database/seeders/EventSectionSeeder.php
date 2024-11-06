<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventSection;
use App\Models\Hotel;
use Faker\Factory as Faker;

class EventSectionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $hotels = Hotel::all();

        foreach ($hotels as $hotel) {
            foreach (range(1, 3) as $index) {
                EventSection::create([
                    'hotel_id' => $hotel->id,
                    'title' => $faker->sentence,
                    'subtitle' => $faker->sentence,
                    'event_title' => $faker->sentence,
                    'event_date' => $faker->date,
                    'event_description' => $faker->paragraph,
                ]);
            }
        }
    }
}
