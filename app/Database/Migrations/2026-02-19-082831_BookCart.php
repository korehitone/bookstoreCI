<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BookCart extends Migration
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
            'cart_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'book_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'quantity' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 1,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('cart_id', 'cart', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('book_id', 'book', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('book_cart');
    }

    public function down()
    {
        $this->forge->dropTable('book_cart');
    }
}
