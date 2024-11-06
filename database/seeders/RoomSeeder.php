<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\TypeRoom;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            ['hotel_id' => 1, 'type_id' => 1, 'name' => 'Deluxe Room', 'price' => 150.00, 'capacity' => 2, 'number_of_beds' => 1, 'number_of_baths' => 1, 'amenities' => 'WiFi, Air conditioning', 'status' => 'available'],
            ['hotel_id' => 1, 'type_id' => 1, 'name' => 'Executive Suite', 'price' => 250.00, 'capacity' => 2, 'number_of_beds' => 1, 'number_of_baths' => 1, 'amenities' => 'WiFi, Air conditioning', 'status' => 'booked'],
            ['hotel_id' => 1, 'type_id' => 2, 'name' => 'Presidential Suite', 'price' => 350.00, 'capacity' => 4, 'number_of_beds' => 2, 'number_of_baths' => 2, 'amenities' => 'WiFi, Jacuzzi', 'status' => 'available'],
            ['hotel_id' => 1, 'type_id' => 2, 'name' => 'Royal Suite', 'price' => 450.00, 'capacity' => 4, 'number_of_beds' => 2, 'number_of_baths' => 2, 'amenities' => 'WiFi, Private pool', 'status' => 'available'],
            ['hotel_id' => 2, 'type_id' => 1, 'name' => 'Standard Room', 'price' => 120.00, 'capacity' => 2, 'number_of_beds' => 1, 'number_of_baths' => 1, 'amenities' => 'WiFi', 'status' => 'available'],
            ['hotel_id' => 2, 'type_id' => 1, 'name' => 'Standard Plus Room', 'price' => 130.00, 'capacity' => 2, 'number_of_beds' => 1, 'number_of_baths' => 1, 'amenities' => 'WiFi, TV', 'status' => 'booked'],
            ['hotel_id' => 2, 'type_id' => 2, 'name' => 'Family Room', 'price' => 180.00, 'capacity' => 4, 'number_of_beds' => 2, 'number_of_baths' => 1, 'amenities' => 'WiFi, TV', 'status' => 'available'],
            ['hotel_id' => 2, 'type_id' => 2, 'name' => 'Double Deluxe Room', 'price' => 200.00, 'capacity' => 4, 'number_of_beds' => 2, 'number_of_baths' => 1, 'amenities' => 'WiFi, TV', 'status' => 'available'],
            ['hotel_id' => 3, 'type_id' => 1, 'name' => 'Single Room', 'price' => 90.00, 'capacity' => 1, 'number_of_beds' => 1, 'number_of_baths' => 1, 'amenities' => 'WiFi', 'status' => 'available'],
            ['hotel_id' => 3, 'type_id' => 1, 'name' => 'Couple Room', 'price' => 100.00, 'capacity' => 2, 'number_of_beds' => 1, 'number_of_baths' => 1, 'amenities' => 'WiFi', 'status' => 'booked'],
            ['hotel_id' => 3, 'type_id' => 2, 'name' => 'Family Suite', 'price' => 220.00, 'capacity' => 4, 'number_of_beds' => 2, 'number_of_baths' => 1, 'amenities' => 'WiFi, Kitchenette', 'status' => 'available'],
            ['hotel_id' => 3, 'type_id' => 2, 'name' => 'Luxury Suite', 'price' => 300.00, 'capacity' => 4, 'number_of_beds' => 2, 'number_of_baths' => 2, 'amenities' => 'WiFi, Ocean view', 'status' => 'available'],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
