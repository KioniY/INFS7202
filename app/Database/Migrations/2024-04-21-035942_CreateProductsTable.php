<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        // 
        $this->forge->addField([
            'product_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],  
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'product_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'price' => [
                'type' => 'Decimal',
                'constraint' => '10,2',
                'unsigned' => TRUE,
            ]
            
        ]);
        
        $this->forge->addKey('product_id', TRUE); 
        $this->forge->createTable('Products'); 
        // define foreign key
        $this->forge->addForeignKey('category_id', 'Categories', 'category_id', 'CASCADE', 'CASCADE');
        
    }

    public function down()
    {
        //
        $this->forge->dropTable('Products'); 
    }
}
