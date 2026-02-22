<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        // Order is important because of Foreign Key constraints!
        $this->call('CategoryTableSeeder');
        $this->call('BookTableSeeder');
        $this->call('CustomerTableSeeder');
        $this->call('AdminTableSeeder');
        $this->call('CartTableSeeder');
        $this->call('CategoryBookTableSeeder');
        $this->call('BookCartTableSeeder');
    }
}
