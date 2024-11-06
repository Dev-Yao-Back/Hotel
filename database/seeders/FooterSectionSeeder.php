<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FooterSection;
use App\Models\Hotel;
use Faker\Factory as Faker;

class FooterSectionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $hotels = Hotel::all();

        foreach ($hotels as $hotel) {
            FooterSection::create([
                'hotel_id' => $hotel->id,
                'about_description' => $faker->paragraph,
                'contact_call' => $faker->phoneNumber,
                'contact_email' => $faker->email,
                'contact_location' => $faker->address,
                'useful_links' => json_encode([
                    ['title' => 'Link 1', 'url' => $faker->url],
                    ['title' => 'Link 2', 'url' => $faker->url],
                ]),
                'newsletter_title' => 'Newsletter',
                'newsletter_placeholder' => 'Votre email',
            ]);
        }
    }
}
