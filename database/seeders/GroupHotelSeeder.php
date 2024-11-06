<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GroupHotel;

class GroupHotelSeeder extends Seeder
{
    public function run(): void
    {
        GroupHotel::create([
            'uname' => 'NEFERTITI GROUP',
            'location' => 'Abidjan',
            'adresse' => "Abidjan, Côte d'Ivoire",
            'description' => 'Test'
        ]);
    }
}
