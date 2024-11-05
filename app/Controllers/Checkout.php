<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\OrderModel;  

class Checkout extends ResourceController
{
    use ResponseTrait;

    /**
     * Handle POST requests to process a checkout.
     */
    public function index()
    {
        $model = new OrderModel();

       
        $data = $this->request->getJSON(true);

       
        if (empty($data['user_id']) || empty($data['table_id']) || empty($data['totalPrice'])) {
            return $this->failValidationErrors('Missing required fields: user_id, table_id, or totalPrice.');
        }

        $success = true;
        $index = 1;
        
        while (isset($data["product_name_$index"])) {
            $orderData = [
                'user_id' => $data['user_id'],
                'table_id' => $data['table_id'],
                'product_name' => $data["product_name_$index"],
                'quantity' => $data["quantity_$index"],
                'totalPrice' => floatval($data['totalPrice']), // Assuming total price is for the whole order
                'status' => 'Pending'
            ];

            
            if (!$model->insert($orderData)) {
                $success = false;
                log_message('error', 'Failed to insert order item: ' . json_encode($orderData));
                break;  
            }
            $index++;
        }

        if ($success) {
            return $this->respondCreated($data, 'Order processed successfully.');
        } else {
            return $this->failServerError('Failed to process order.');
        }
    }

    public function finish($orderId)
    {
        
        $orderModel = new OrderModel();

        // update status 'Finish'
        $data = ['status' => 'Finish'];
        $success = $orderModel->update($orderId, $data);

        if ($success) {
            return $this->respondUpdated(['status' => 'Finish'], 'Order finished successfully.');
        } else {
            return $this->failNotFound('Order not found.');
        }
    }

    /**
     * Handle DELETE requests to cancel an order.
     */
    public function cancel($orderId)
    {
        
        $orderModel = new OrderModel();

        // update status 'Cancel'
        $data = ['status' => 'Cancel'];
        $success = $orderModel->update($orderId, $data);

        if ($success) {
            return $this->respondUpdated(['status' => 'Cancel'], 'Order cancelled successfully.');
        } else {
            return $this->failNotFound('Order not found.');
        }
    }

}
