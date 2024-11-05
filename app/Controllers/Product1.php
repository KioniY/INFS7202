<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class Product1 extends ResourceController
{
    use ResponseTrait;
    /**
     * Handle GET requests to list education entries or filter by user_id.
     */
    public function index()
    {
        $model = new ProductModel();

        // Retrieve 'user_id' from query parameters if provided.
        $categoryId = $this->request->getGet('category_id');


        // Filter the data by user_id if provided, otherwise retrieve all entries.
        $data = $categoryId ? $model->where('category_id', $categoryId)->findAll() : $model->findAll();

        // Use HTTP 200 to return data.
        return $this->respond($data);
    }

    /**
     * Handle GET requests to retrieve a single education entry by its ID.
     */
    public function show($id = null)
    {
        $model = new ProductModel();

        // Attempt to retrieve the specific education entry by ID.
        $data = $model->find($id);

        // Check if data was found.
        if ($data) {
            return $this->respond($data);
        } else {
            // Return a 404 error if no data is found.
            return $this->failNotFound("No Education entry found with ID: {$id}");
        }
    }

    /**
     * Handle POST requests to create a new category entry.
     */
    public function create()
    {
        $model = new ProductModel();
        $categoryModel = new CategoryModel(); 
        $data = $this->request->getJSON(true);
    
        if (empty($data) || !isset($data['category_id'])) {
            return $this->failValidationErrors('No data provided or category_id missing.');
        }
    
        // check category_id exists
        if (!$categoryModel->find($data['category_id'])) {
            return $this->failValidationErrors('Invalid category_id: Category does not exist.');
        }
    
        if ($model->insert($data)) {
            return $this->respondCreated($data, 'Product data created successfully.');
        } else {
            return $this->failServerError('Failed to create product data.');
        }
    }
    
    /**
     * Handle PUT requests to update an existing product entry by its ID.
     */
    public function update($id = null)
    {
        $model = new ProductModel();
        $data = $this->request->getJSON(true);  // Ensure the received data is an array.

        // Check if the record exists before attempting update.
        if (!$model->find($id)) {
            return $this->failNotFound("No product entry found with ID: {$id}");
        }

        // Update the record and handle the response.
        if ($model->update($id, $data)) {
            return $this->respondUpdated($data, 'product data updated successfully.');
        } else {
            return $this->failServerError('Failed to update product data.');
        }
    }

    /**
     * Handle DELETE requests to remove an existing category entry by its ID.
     */
    public function delete($id = null)
    {
        $model = new ProductModel();

        // Check if the record exists before attempting deletion.
        if (!$model->find($id)) {
            return $this->failNotFound("No product entry found with ID: {$id}");
        }

        // Attempt to delete the record.
        if ($model->delete($id)) {
            return $this->respondDeleted(['id' => $id, 'message' => 'product data deleted successfully.']);
        } else {
            return $this->failServerError('Failed to delete product data.');
        }
    }













}