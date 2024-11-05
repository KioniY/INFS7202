<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CategoryModel;

class Category1 extends ResourceController
{
    use ResponseTrait;
    /**
     * Handle GET requests to list education entries or filter by user_id.
     */
    public function index()
    {
        $model = new CategoryModel();

        // Retrieve 'user_id' from query parameters if provided.
        $userId = $this->request->getGet('user_id');

        // Filter the data by user_id if provided, otherwise retrieve all entries.
        $data = $userId ? $model->where('user_id', $userId)->findAll() : $model->findAll();

        // Use HTTP 200 to return data.
        return $this->respond($data);
    }

    /**
     * Handle GET requests to retrieve a single education entry by its ID.
     */
    public function show($id = null)
    {
        $model = new CategoryModel();

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
        $model = new CategoryModel();
        $data = $this->request->getJSON(true);  // Ensure the received data is an array.

        // Validate input data before insertion.
        if (empty($data)) {
            return $this->failValidationErrors('No data provided.');
        }

        // Insert data and check for success.
        $inserted = $model->insert($data);
        if ($inserted) {
            return $this->respondCreated($data, 'Category data created successfully.');
        } else {
            return $this->failServerError('Failed to create category data.');
        }
    }
    
    /**
     * Handle PUT requests to update an existing category entry by its ID.
     */
    public function update($id = null)
    {
        $model = new CategoryModel();
        $data = $this->request->getJSON(true);  // Ensure the received data is an array.

        // Check if the record exists before attempting update.
        if (!$model->find($id)) {
            return $this->failNotFound("No Category entry found with ID: {$id}");
        }

        // Update the record and handle the response.
        if ($model->update($id, $data)) {
            return $this->respondUpdated($data, 'Category data updated successfully.');
        } else {
            return $this->failServerError('Failed to update category data.');
        }
    }

    /**
     * Handle DELETE requests to remove an existing category entry by its ID.
     */
    public function delete($id = null)
    {
        $model = new CategoryModel();

        // Check if the record exists before attempting deletion.
        if (!$model->find($id)) {
            return $this->failNotFound("No Category entry found with ID: {$id}");
        }

        // Attempt to delete the record.
        if ($model->delete($id)) {
            return $this->respondDeleted(['id' => $id, 'message' => 'category data deleted successfully.']);
        } else {
            return $this->failServerError('Failed to delete category data.');
        }
    }













}