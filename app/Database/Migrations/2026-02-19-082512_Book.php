<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Book extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'uid' => [
                'type'           => 'VARCHAR',
                'constraint'     => '36',
            ],
            'category_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'title' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'author' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'publisher' => [
                'type'           => 'VARCHAR',
                'constraint'     => '64',
            ],
            'release_date' => [
                'type' => 'DATE',
            ],
            'sipnosis' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'img_url' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'price' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('category_id', 'category', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('book');
    }

    public function down()
    {
        $this->forge->dropTable('book');
    }
}
