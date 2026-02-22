<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CartTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // ['uid' => '550e8400-e29b-41d4-a716-446655440000', 'customer_id' => 1],
            // ['uid' => '550e8400-e29b-41d4-a716-446655440001', 'customer_id' => 2],
            // ['uid' => '550e8400-e29b-41d4-a716-446655440002', 'customer_id' => 3],
            // ['uid' => '550e8400-e29b-41d4-a716-446655440003', 'customer_id' => 4],
            // ['uid' => '550e8400-e29b-41d4-a716-446655440004', 'customer_id' => 5],
            // Fixed the duplicate UID from your SQL

            ['customer_id' => '6ba7b810-9dad-11d1-80b4-00c04fd430c0'],
            ['customer_id' => '6ba7b810-9dad-11d1-80b4-00c04fd430c1'],
            ['customer_id' => '6ba7b810-9dad-11d1-80b4-00c04fd430c2'],
            ['customer_id' => '6ba7b810-9dad-11d1-80b4-00c04fd430c3'],
            ['customer_id' => '6ba7b810-9dad-11d1-80b4-00c04fd430c4'],
        ];

        $this->db->table('cart')->insertBatch($data);
    }
}
