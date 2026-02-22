<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CartItemTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['cart_id' => 1, 'book_id' => 1, 'quantity' => 1], // SAO
            ['cart_id' => 1, 'book_id' => 3, 'quantity' => 1], // One Piece
            ['cart_id' => 2, 'book_id' => 4, 'quantity' => 1], // Sapiens
            ['cart_id' => 3, 'book_id' => 3, 'quantity' => 1], // One Piece
            ['cart_id' => 4, 'book_id' => 2, 'quantity' => 1], // Caterpillar
            ['cart_id' => 4, 'book_id' => 1, 'quantity' => 1], // SAO
            ['cart_id' => 5, 'book_id' => 2, 'quantity' => 1], // Caterpillar
        ];

        $this->db->table('cart_item')->insertBatch($data);
    }
}
