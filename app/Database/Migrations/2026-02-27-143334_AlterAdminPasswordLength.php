<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterAdminPasswordLength extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('admin', [
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('admin', [
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
                'null'       => false,
            ],
        ]);
    }
}
