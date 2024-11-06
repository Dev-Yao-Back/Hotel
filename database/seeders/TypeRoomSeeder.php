<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeRoom;

class TypeRoomSeeder extends Seeder
{
    public function run(): void
    {
        $typeChambres = [
            ['uname' => 'Chambre VIP'],
            ['uname' => 'Chambre Standard'],
        ];

        foreach ($typeChambres as $typeChambre) {
            TypeRoom::create($typeChambre);
        }
    }
}
