<?php namespace App\Controllers;

use CodeIgniter\Controller;
// use App\Libraries\Hash;
use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\TableModel;
use App\Models\OrderModel;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;

class menuController extends BaseController
{
    public function __construct()
    {
        // Load the URL helper, it will be useful in the next steps
        // Adding this within the __construct() function will make it 
        // available to all views in the ResumeController
        helper(['url','form']); 
        $this->session = session();
    }
    /**
     * @return login
     */
    public function index()
    {
        return view('login'); 
    }
    /**
     * @return register
     */
    public function register()
    {
        return view('register');
    }
    /**
     * @return home
     */
    public function home()
    {
        return view('home');
    }
    

    /**
     * Save user to database
     */
    public function registerUser(){
        //Validate user input


        $validated = $this -> validate([
            'user_name' =>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Your name is required',
                ]
            ],
            'email' =>[
                'rules'=>'required|valid_email',
                'errors'=>[
                    'required'=>'Your email is required',
                    'valid_email'=>'Email is already used.',
                ]
            ],
            'password' =>[
                'rules'=>'required|min_length[5]|max_length[20]',
                'errors'=>[
                    'required'=>'Your password is required',
                    'min_length'=>'Password must be no less than 5 characters',
                    'max_length'=>'Password must be no longer than 20 characters',
                ]
            ],
            'confirmpassword' =>[
                'rules'=>'required|min_length[5]|max_length[20]|matches[password]',
                'errors'=>[
                    'required'=>'Your password is required',
                    'min_length'=>'Password must be no less than 5 characters',
                    'max_length'=>'Password must be no longer than 20 characters',
                    'matches'=>'Confirm password must match the password',
                ]
            ],
        ]);
        if(!$validated)
        {return view('register', ['validation' => $this->validator]);}
        //Save data
        $username = $this->request->getPost('user_name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirmpassword = $this->request->getPost('confirmpassword');
        $data=[
            'user_name'=>$username,
            'email'=>$email,
            'password'=> password_hash($password, PASSWORD_DEFAULT)
        ];

        //Storing data
        $userModel = new \App\Models\UserModel();
        $query= $userModel ->insert($data);
        if(!$query){
            return redirect()->back()->with('fail', 'Saving user failed');
        }
         // Retrieve the new user's ID
            $newUserId = $userModel->insertID();
            // Create a default category for the new user
            $this->createDefaultCategory($newUserId);
            return redirect()->to('')->with('success', 'Account created successfully. Please login.');
        }

        private function createDefaultCategory($userId) {
            $categoryModel = new \App\Models\CategoryModel();
            $defaultCategoryData = [
                'user_id' => $userId,
                'category_name' => 'Default Category'
            ];
            $categoryModel->insert($defaultCategoryData);
        }


    /**
     * User login method
     */
    public function loginUser(){
        //validating user input
        
        $validated = $this -> validate([
            
            'email' =>[
                'rules'=>'required|valid_email',
                'errors'=>[
                    'required'=>'Your email is required',
                    'valid_email'=>'Email is already used.',
                ]
            ],
            'password' =>[
                'rules'=>'required|min_length[5]|max_length[20]',
                'errors'=>[
                    'required'=>'Your password is required',
                    'min_length'=>'Password must be no less than 5 characters',
                    'max_length'=>'Password must be no longer than 20 characters',
                ]
            ],
            
        ]);
        if(!$validated)
        {return view('login', ['validation' => $this->validator]);}
        else{
            //check user data
            $email = $this ->request ->getPost('email');
            $password = $this ->request ->getPost('password');
            $userModel = new \App\Models\UserModel();
            $userInfo = $userModel->where('email', $email)->first();

            if (!password_verify($password, $userInfo['password'])) {
                session()->setFlashdata('fail', 'Incorrect password');
                return redirect()->to('login');
            }
        
            session()->set('loggedInUser', $userInfo['user_id']);
            session()->set('userName', $userInfo['user_name']);
            if ($userInfo['role'] === 'Admin') {
                return redirect()->to('admin');  
            } else {
                return redirect()->to('home');
            }


        }



    }



    /**
     * log out method
     */
    public function logout() {
        session()->destroy();  
        return redirect()->to(base_url());  // back to index
    }

    /**
     * user protofile
     */
    public function profile() {
        if (!session()->has('loggedInUser')) {
            return redirect()->to('login'); 
        }
    
        $userId = session()->get('loggedInUser');
        $userModel = new \App\Models\UserModel();
        $userInfo = $userModel->find($userId);
        $tableModel = new \App\Models\TableModel();
    
        if (!$userInfo) {
            return redirect()->to('home');  
        }

         
        $tables = $tableModel->where('user_id', $userId)->findAll();

    
        return view('profile', ['userInfo' => $userInfo, 'tables' => $tables]);
    }
    public function editProfile() {
        if (!session()->has('loggedInUser')) {
            return redirect()->to('login'); 
        }
    
        $userId = session()->get('loggedInUser');
        $userModel = new \App\Models\UserModel();
        $userInfo = $userModel->find($userId);
    
        if (!$userInfo) {
            return redirect()->to('home');  
        }
    
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
    
            // update user
            if ($userModel->update($userId, $data)) {
                // update table number
                if (isset($data['tableNum'])) {
                    $this->updateTableNumbers($userId, (int)$data['tableNum']);
                }
                $this->session->setFlashdata('success', 'Profile updated successfully.');
            } else {
                $this->session->setFlashdata('error', 'Failed to update profile. Please try again.');
            }
    
            return redirect()->to('menu/profile');
        }
    
        return view('edit_profile', ['userInfo' => $userInfo]);
    }
    /**
     * UPDATE TABLES
     */
    public function updateTableNumbers($userId, $newTableCount) {
        $tableModel = new \App\Models\TableModel();
        $qrCodeWriter = new \Endroid\QrCode\Writer\PngWriter();
    
        $currentTables = $tableModel->where('user_id', $userId)->findAll();
        $currentTableCount = count($currentTables);
    
        // Increase table count
        if ($newTableCount > $currentTableCount) {
            for ($i = $currentTableCount + 1; $i <= $newTableCount; $i++) {
                $insertResult = $tableModel->insert([
                    'user_id' => $userId,
                    'table_number' => $i
                ]);
    
                if ($insertResult) {
                    $tableId = $tableModel->insertID(); // Getting the newly inserted table ID
                    $url = base_url("customerview?user_id={$userId}&table_id={$tableId}");
                    $qrCode = new \Endroid\QrCode\QrCode($url);
                    $qrCode->setSize(300);
                    $qrCode->setMargin(10);
                    $result = $qrCodeWriter->write($qrCode);
                    $dataUri = $result->getDataUri();
    
                    $tableModel->update($tableId, ['qr_code' => $dataUri]);
                    error_log('QR code inserted successfully for table ' . $i);
                } else {
                    $db = db_connect(); 
                    $error = $db->error();
                    error_log('Failed to insert QR code for table ' . $i . ': ' . json_encode($error));
                }
            }
        } 
    
        // Decrease table count
        if ($newTableCount < $currentTableCount) {
            for ($i = $newTableCount + 1; $i <= $currentTableCount; $i++) {
                $deleteResult = $tableModel->where('user_id', $userId)->where('table_number', $i)->delete();
    
                if (!$deleteResult) {
                    $error = $tableModel->errors(); 
                    error_log('Failed to delete QR code for table ' . $i . ': ' . json_encode($error));
                } else {
                    error_log('QR code deleted successfully for table ' . $i);
                }
            }
        }
    
        // Create or update QR code for existing tables
        for ($i = 1; $i <= $newTableCount; $i++) {
            $table = $tableModel->where('user_id', $userId)->where('table_number', $i)->first();
            if (!empty($table) && empty($table['qr_code'])) {
                $url = base_url("customerview?user_id={$userId}&table_id={$table['id']}");
                $qrCode = new \Endroid\QrCode\QrCode($url);
                $qrCode->setSize(300);
                $qrCode->setMargin(10);
                $result = $qrCodeWriter->write($qrCode);
                $dataUri = $result->getDataUri();
    
                $updateResult = $tableModel->update($table['id'], ['qr_code' => $dataUri]);
                if (!$updateResult) {
                    $db = db_connect(); 
                    $error = $db->error();
                    error_log('Failed to update QR code for table ' . $i . ': ' . json_encode($error));
                } else {
                    error_log('QR code updated successfully for table ' . $i);
                }
            }
        }
    }
    
    /**
     * SHOW QR CODES
     */
    public function seeQrCodes() {
        $userId = session()->get('loggedInUser');
        $tableModel = new \App\Models\TableModel();
        $tables = $tableModel->where('user_id', $userId)->findAll();
    
        return view('see_qr_codes', ['tables' => $tables]);
    }
    
    
    


    
    
    

    
    /**
     * SET CATEGORY
     */

    public function category()
    {   
        
        $session = session();
        $userId = $session->get('loggedInUser');
    
        if (is_null($userId)) {
            // Log the error or handle it as appropriate
            log_message('error', 'User ID is missing from the session.');
            return redirect()->to('/login'); // Redirect to login or appropriate page
        }
    
        $categoryModel = new \App\Models\CategoryModel();
        $categories = $categoryModel->getCategoriesByUserId($userId);
    
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($userId);
    
        return view('category', ['categories' => $categories, 'user_id' => $userId, 'user' => $user]);
    }

    /**
     * SET ORDERS
     */
    public function orders()
{   $session = session();
    $orderModel = new \App\Models\OrderModel();
    $userId = $session->get('loggedInUser'); // Assuming user_id is stored in session

    $data['pendingOrders'] = $orderModel->getPendingOrders($userId);
    $data['finishedOrders'] = $orderModel->getFinishedOrders($userId);
    $data['canceledOrders'] = $orderModel->getCancelledOrders($userId);

    return view('orders', $data);
}


 
    /**
     * SET PRODUCTS
     */
    public function products()
{   $session = session();
    
    $categoryId = $this->request->getGet('category_id');
   
    $productModel = new \App\Models\ProductModel();
    $categoryModel = new \App\Models\CategoryModel();
    $data = [];

    
    $userId = $session->get('loggedInUser'); 
    if (!$userId) {
        return redirect()->to('/login')->with('error', 'Please log in to view products.');
    }

    // check the category id
    if ($categoryId) {
        // find the category which belongs to this user
        $category = $categoryModel->where('category_id', $categoryId)
                                  ->where('user_id', $userId)
                                  ->first();
        if ($category) {
            
            $data['products'] = $productModel->where('category_id', $categoryId)->findAll();
            $data['category'] = $category;
        } else {
            $data['products'] = [];
            $data['category'] = null;
            return redirect()->back()->with('error', 'Category not found or not accessible.');
        }
    } else {
        $categories = $categoryModel->where('user_id', $userId)->findAll();
        $categoryIds = array_column($categories, 'category_id');
        if (!empty($categoryIds)) {
            $data['products'] = $productModel->whereIn('category_id', $categoryIds)->findAll();
        } else {
            $data['products'] = [];  
        }
        $data['category'] = null;
    }
    return view('products', $data);
}

    /**
     * CUSTOMER'S VIEW
     */
    public function customerview()
    {
        // get user id and table id
        $userId = $this->request->getGet('user_id');
        $tableId = $this->request->getGet('table_id');
    
        $categoryModel = new \App\Models\CategoryModel();
        $productModel = new \App\Models\ProductModel();
    
        $categories = $categoryModel->where('user_id', $userId)->findAll();
    
        $products = [];
        if ($categoryId = $this->request->getGet('category_id')) {
            $category = $categoryModel->where('category_id', $categoryId)
                                      ->where('user_id', $userId) 
                                      ->first();
            if ($category) {
                $products = $productModel->where('category_id', $categoryId)->findAll();
            }
        } else {
            $categoryIds = array_column($categories, 'category_id');
            if (!empty($categoryIds)) {
                $products = $productModel->whereIn('category_id', $categoryIds)->findAll();
            }
        }
        
        return view('customerview', [
            'user_id' => $userId,
            'table_id' => $tableId,
            'categories' => $categories,
            'products' => $products,
        ]);
    }
    

    public function userinformation()
    {
        return view('userinformation');
    }

    /**
     * check out function
     */
    public function checkout()
    {
        $json = $this->request->getJSON(true);
        if (empty($json)) {
            return redirect()->back()->with('error', 'No data received.');
        }
    
        $index = 1;
        while (isset($json["product_name_$index"])) {
            $data = [
                'user_id' => $json['user_id'],
                'table_id' => $json['table_id'],
                'product_name' => $json["product_name_$index"],
                'quantity' => $json["quantity_$index"],
                'totalPrice' => $json['totalPrice'], 
                'status' => 'Pending'
            ];
    
            if (!$this->OrderModel->createOrder($data)) {
                log_message('error', 'Failed to insert order item with totalPrice: ' . $data['totalPrice'] . ', data: ' . json_encode($orderData));

                return redirect()->back()->with('error', 'Failed to place order for item: ' . $data['product_name']);
            }
            $index++;
        }
    
        return redirect()->to('/customerview')->with('message', 'Order placed successfully');
    }
    
    /**
     * if check is the admin account
     * return admin page
     */
    public function admin()
    {
    $db = \Config\Database::connect();
    $query = $db->query("SELECT * FROM `User` WHERE `role` != 'Admin' OR `role` IS NULL");
    $users = $query->getResultArray();
        
        return view('admin', ['users' => $users]);
    }
    
    
    
    


  





    
}