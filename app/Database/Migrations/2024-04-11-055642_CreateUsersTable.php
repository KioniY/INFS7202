<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
       // Define the User table
       $this->forge->addField([
        'user_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => TRUE,
            'auto_increment' => TRUE
        ],
        'user_name' => [
            'type' => 'VARCHAR',
            'constraint' => '255',
        ],
        'password' => [
            'type' => 'CHAR',
            'constraint' =>'64',
        ],
        'email' => [
            'type' => 'VARCHAR',
            'constraint' => '255',
        ],
        'phone' => [
            'type' => 'VARCHAR',
            'constraint' => '20',
        ],
        'address' => [
            'type' => 'VARCHAR',
            'constraint' => '255',
        ],
        'tableNum' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => TRUE,
        ],
    ]);
    
    $this->forge->addKey('user_id', TRUE); // Set user_id as primary key
    $this->forge->createTable('User'); // Create the User table
    }

    public function down()
    {
        // Drop the User table if needed
        $this->forge->dropTable('User');
    }
}
