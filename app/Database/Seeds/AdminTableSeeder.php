<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin_master',
                'email'    => 'admin@bookstore.com',
                'password' => password_hash('adminpass001', PASSWORD_DEFAULT),
            ],
            [
                'username' => 'super_admin',
                'email'    => 'superadmin@bookstore.com',
                'password' => password_hash('adminpass002', PASSWORD_DEFAULT),
            ],
            [
                'username' => 'manager_store',
                'email'    => 'manager@bookstore.com',
                'password' => password_hash('adminpass003', PASSWORD_DEFAULT),
            ],
            [
                'username' => 'moderator01',
                'email'    => 'mod01@bookstore.com',
                'password' => password_hash('adminpass004', PASSWORD_DEFAULT),
            ],
            [
                'username' => 'admin_support',
                'email'    => 'support@bookstore.com',
                'password' => password_hash('adminpass005', PASSWORD_DEFAULT),
            ],
        ];

        $this->db->table('admin')->insertBatch($data);
    }
}
