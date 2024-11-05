<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'category_id' => [
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
            'category_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ]
            
        ]);
        
        $this->forge->addKey('category_id', TRUE); 
        $this->forge->createTable('Categories'); 
        // define foreign key
        $this->forge->addForeignKey('user_id', 'User', 'user_id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        // Drop the User table if needed
        $this->forge->dropTable('Categories');
    }
}
