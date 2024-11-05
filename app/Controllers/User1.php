<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class User1 extends ResourceController
{
    use ResponseTrait;
    /**
     * Handle GET requests to list filter by user_id.
     */
    public function index()
    {
        $model = new UserModel();

        // Retrieve 'user_id' from query parameters if provided.
        $userId = $this->request->getGet('user_id');

        // Filter the data by user_id if provided, otherwise retrieve all entries.
        $data = $userId ? $model->where('user_id', $userId)->findAll() : $model->findAll();

        // Use HTTP 200 to return data.
        return $this->respond($data);
    }

    /**
     * Handle GET requests to retrieve a single by its ID.
     */
    public function show($id = null)
    {
        $model = new UserModel();

        // Attempt to retrieve the specific education entry by ID.
        $data = $model->find($id);

        // Check if data was found.
        if ($data) {
            return $this->respond($data);
        } else {
            // Return a 404 error if no data is found.
            return $this->failNotFound("No found with ID: {$id}");
        }
    }

    /**
     * Handle POST requests to create a new category entry.
     */
    public function create()
    {
        $model = new UserModel();
        $data = [
            'user_name' => $this->request->getPost('user_name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];
    
        if ($model->insert($data)) {
            $newUserId = $model->insertID();  // Get the ID of the newly created user
            $this->createDefaultCategory($newUserId);  // Call function to create default category
            return redirect()->to('/admin')->with('message', 'User added successfully. Default category created.');
        } else {
            return $this->failServerError('Failed to create user.');
        }
    }
    
    private function createDefaultCategory($userId) {
        $categoryModel = new \App\Models\CategoryModel();
        $defaultCategory = [
            'user_id' => $userId,
            'category_name' => 'Default Category'
        ];
        $categoryModel->insert($defaultCategory);
    }
    
    

    
    /**
     * Handle PUT requests to update an existing category entry by its ID.
     */
    public function update($id = null)
    {
        $model = new UserModel();
        $id = $this->request->getPost('user_id');
        $data = [
            'user_name' => $this->request->getPost('user_name'),
            'email' => $this->request->getPost('email'),
            // Add other fields as necessary
        ];
    
        if (!$model->find($id)) {
            return $this->failNotFound("No user found with ID: {$id}");
        }
    
        if ($model->update($id, $data)) {
            return redirect()->to('/admin')->with('message', 'User updated successfully');
        } else {
            return $this->failServerError('Failed to update user.');
        }
    }
    
    


    /**
     * Handle DELETE requests to remove an existing category entry by its ID.
     */
    public function delete($id = null)
{
    $model = new UserModel();
    $id = $this->request->getPost('user_id') ?: $id; // Fallback to direct ID from URL if not in POST data

    if (!$model->find($id)) {
        return $this->failNotFound("No user found with ID: {$id}");
    }

    if ($model->delete($id)) {
        return redirect()->to('/admin')->with('message', 'User deleted successfully.');
    } else {
        return $this->failServerError('Failed to delete user.');
    }
}

    













}