<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\GroupHotel;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        $group = GroupHotel::first(); // Assurez-vous que le groupe existe

        $hotels = [
            [
                'uname' => "NEFERTITI SIGNATURE",
                'location' => "Cocody",
                'adresse' => "Riviera Attoban non loin de Doraville",
                'description' => "Test",
                'group_hotels_id' => $group->id,
            ],
            [
                'uname' => "NEFERTITI PALACE",
                'location' => "Yopougon",
                'adresse' => "Yopougon, Cocody, Abidjan",
                'description' => "Test",
                'group_hotels_id' => $group->id,
            ],
            [
                'uname' => "NEFERTITI BLUE",
                'location' => "Cocody",
                'adresse' => "Cocody, Abidjan Côte d'Ivoire",
                'description' => "Test",
                'group_hotels_id' => $group->id,
            ],
        ];

        foreach ($hotels as $hotelData) {
            Hotel::create($hotelData);
        }
    }
}
