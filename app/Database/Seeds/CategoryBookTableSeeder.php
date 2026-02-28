<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoryBookTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['book_id' => 1, 'category_id' => 1], // SAO -> Light Novel
            ['book_id' => 2, 'category_id' => 2], // Caterpillar -> Children Book
            ['book_id' => 3, 'category_id' => 3], // One Piece -> Comics
            ['book_id' => 4, 'category_id' => 4], // Sapiens -> Non-Fiction
            ['book_id' => 5, 'category_id' => 5], // Hunger Games -> Fiction
        ];

        $this->db->table('category_book')->insertBatch($data);
    }
}
