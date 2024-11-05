<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'order_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],  
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'totalPrice' => [
                'type' => 'Decimal',
                'constraint' => '10,2',
                'unsigned' => TRUE,
            ],
            'tableNum' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 20,  
                'default' => 'Pending',  // Default status
            ]
        ]);
        
        $this->forge->addKey('order_id', TRUE); // Set order_id as primary key
        $this->forge->createTable('Orders'); // Create the Order table
        // define foreign key
        $this->forge->addForeignKey('user_id', 'User', 'user_id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        //
       // Drop the Order table if needed
       $this->forge->dropTable('Orders'); 
    }
}
