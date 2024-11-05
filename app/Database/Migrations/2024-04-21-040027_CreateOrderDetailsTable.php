<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderDetailsTable extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],  
            'order_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'product_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'price' => [
                'type' => 'Decimal',
                'constraint' => '10,2',
                'unsigned' => TRUE,
            ]
            
        ]);
        $this->forge->addKey('id', TRUE); 
        $this->forge->createTable('OrderDetails'); 
        // define foreign key
        $this->forge->addForeignKey('order_id', 'Orders', 'order_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'Products', 'product_id', 'CASCADE', 'CASCADE'); 
        $this->forge->addForeignKey('price', 'Products', 'price', 'CASCADE', 'CASCADE');  
    }

    public function down()
    {
        //
        $this->forge->dropTable('OrderDetails'); 
    }
}
