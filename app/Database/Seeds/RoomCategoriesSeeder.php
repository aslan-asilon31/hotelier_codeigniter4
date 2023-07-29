<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoomCategoriesSeeder extends Seeder
{
    // protected $name        = 'seed:RoomCategoriesSeeder';

    public function run()
    {
        $data = [
            [
                'name' => 'Standard Room',
                'image' => '',
                'description' => 'Standard room description.',
            ],
            [
                'name' => 'Deluxe Room',
                'image' => '',
                'description' => 'Deluxe room description.',
            ],
            [
                'name' => 'Suite Room',
                'image' => '',
                'description' => 'Suite room description.',
            ],
        ];

        $this->db->table('room_categories')->insertBatch($data);
    }
}
