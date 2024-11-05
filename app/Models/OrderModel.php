<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'Orders'; // Specifies the database table that this model should interact with.
    protected $primaryKey = 'order_id'; // Defines the primary key field of the table for CRUD operations.
    // Lists the fields that are allowed to be set using the model. This is for security and prevents mass assignment vulnerabilities.
    protected $allowedFields = ['order_id', 'user_id', 'status','totalPrice', 'table_id', 'product_name', 'quantity']; 
    protected $returnType = 'array'; 



    public function createOrder($data)
    {
    
        return $this->insert($data);
    }

    public function getPendingOrders($userId) {
        return $this->select('Orders.*, Tables.table_number')
                    ->join('Tables', 'Tables.id = Orders.table_id')
                    ->where('Orders.status', 'Pending')
                    ->where('Orders.user_id', $userId) // Filter by user_id
                    ->findAll();
    }

    public function getFinishedOrders($userId) {
        return $this->select('Orders.*, Tables.table_number')
                    ->join('Tables', 'Tables.id = Orders.table_id')
                    ->where('Orders.status', 'Finish')
                    ->where('Orders.user_id', $userId) // Filter by user_id
                    ->findAll();
    }
    
    public function getCancelledOrders($userId) {
        return $this->select('Orders.*, Tables.table_number')
                    ->join('Tables', 'Tables.id = Orders.table_id')
                    ->where('Orders.status', 'Cancel')
                    ->where('Orders.user_id', $userId) // Filter by user_id
                    ->findAll();
    }
    


}
