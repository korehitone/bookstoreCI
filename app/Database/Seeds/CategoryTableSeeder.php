<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Light Novel'],
            ['name' => 'Children Book'],
            ['name' => 'Comics'],
            ['name' => 'Non-Fiction'],
            ['name' => 'Fiction'],
        ];

        $this->db->table('category')->insertBatch($data);
    }
}
