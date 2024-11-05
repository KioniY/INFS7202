<?php

namespace App\Models;

use CodeIgniter\Model;

class TableModel extends Model
{
    protected $table = 'Tables'; // Specifies the database table that this model should interact with.
    protected $primaryKey = 'id'; // Defines the primary key field of the table for CRUD operations.
    // Lists the fields that are allowed to be set using the model. This is for security and prevents mass assignment vulnerabilities.
    protected $allowedFields = ['id','user_id','table_number', 'qr_code']; 
    protected $returnType = 'array'; // Sets the default return type of the results. This model will return results as arrays.

    public function saveQRCode($userId, $tableNumber) {
        $data = "Data for table $tableNumber User $userId";
        $qrCode = new \Endroid\QrCode\QrCode($data);
        $qrCode->setSize(300);
        $qrCode->setMargin(10);
    
        $writer = new \Endroid\QrCode\Writer\PngWriter();
        $result = $writer->write($qrCode);
        $dataUri = $result->getDataUri();
    
        // update qr code
        return $this->update($tableNumber, ['qr_code' => $dataUri]);
    }
    
}
