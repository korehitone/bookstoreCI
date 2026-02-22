<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'uid'      => '6ba7b810-9dad-11d1-80b4-00c04fd430c0',
                'username' => 'johndoe',
                'email'    => 'john.doe@email.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'address'  => 'Jl. Sudirman No. 123, Jakarta',
            ],
            [
                'uid'      => '6ba7b810-9dad-11d1-80b4-00c04fd430c1',
                'username' => 'janesmth',
                'email'    => 'jane.smith@email.com',
                'password' => password_hash('password456', PASSWORD_DEFAULT),
                'address'  => 'Jl. Thamrin No. 45, Jakarta',
            ],
            [
                'uid'      => '6ba7b810-9dad-11d1-80b4-00c04fd430c2',
                'username' => 'bookworm88',
                'email'    => 'bookworm88@email.com',
                'password' => password_hash('passwordabc', PASSWORD_DEFAULT),
                'address'  => 'Jl. Asia Afrika No. 78, Bandung',
            ],
            [
                'uid'      => '6ba7b810-9dad-11d1-80b4-00c04fd430c3',
                'username' => 'reader_pro',
                'email'    => 'readerpro@email.com',
                'password' => password_hash('passwordxyz', PASSWORD_DEFAULT),
                'address'  => 'Jl. Malioboro No. 56, Yogyakarta',
            ],
            [
                'uid'      => '6ba7b810-9dad-11d1-80b4-00c04fd430c4',
                'username' => 'bookfan21',
                'email'    => 'bookfan21@email.com',
                'password' => password_hash('passworddef', PASSWORD_DEFAULT),
                'address'  => 'Jl. Diponegoro No. 99, Surabaya',
            ],
        ];

        $this->db->table('customer')->insertBatch($data);
    }
}
