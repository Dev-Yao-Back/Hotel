<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GroupHotel;
use App\Models\Hotel;
use App\Models\TypeRoom;
use App\Models\Room;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GroupHotelSeeder::class,
            HotelSeeder::class,
            TypeRoomSeeder::class,
            RoomSeeder::class,
            HotelSeeder::class,
            HeroSectionSeeder::class,
            DescriptionSectionSeeder::class,
            RoomCarouselSectionSeeder::class,
            ExtraSectionSeeder::class,
            MessageSectionSeeder::class,
            ServiceSectionSeeder::class,
            EventSectionSeeder::class,
            RestaurantSectionSeeder::class,
            TestimonialSectionSeeder::class,
            FooterSectionSeeder::class,
            HeaderSectionSeeder::class,
        ]);
    }
}
