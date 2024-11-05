<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuDataSeeder extends Seeder
{
    public function run()
    {
        // Insert sample data into the User table for multiple users
        $user_data = [
            [
                'user_name' => 'User1 Lastname1',
                'email' => 'user1@example.com',
                'phone' => '123-456-2232',
                'password' => '000000',
                'address' => '000 road',
                'tableNum' =>'10'
            ],
            [
                'user_name' => 'User2 Lastname2',
                'email' => 'user2@example.com',
                'phone' => '123-456-2311',
                'password' => '000000',
                'address' => '111 road',
                'tableNum' =>'10'
            ],
            [
                'user_name' => 'User3 Lastname3',
                'email' => 'user3@example.com',
                'phone' => '123-456-0000',
                'password' => '000000',
                'address' => '000 road',
                'tableNum' =>'10'
            ]
            // Add more users as needed
        ];

        $userIds = [];

        foreach ($user_data as $user) {
            $this->db->table('User')->insert($user);
            $userIds[] = $this->db->insertID();
        }
        foreach ($userIds as $userId) {
             // Insert 2 sample records into the Categories table for each user
            $category_data=[
                [   'user_id' => $userId,
                    'category_name' => 'Appetizers',


            ],
                ['user_id' => $userId,
                'category_name' => 'Main Courses']
            ];
        
            $this->db->table('Categories')->insertBatch($category_data);
            $categoryIds = [];

            // get category_id
            $insertedCategories = $this->db->table('Categories')
                                        ->whereIn('category_name', ['Appetizers', 'Main Courses'])
                                        ->get()->getResult();

            foreach ($insertedCategories as $category) {
                $categoryIds[] = $category->category_id;
            }
            // insert product samples
            foreach ($categoryIds as $categoryId) {
                $product_data = [
                    [
                        'category_id' => $categoryId,
                        'product_name' => 'Product 1 for ' . $categoryId,
                        'price' => 9.99
                    ],
                    [
                        'category_id' => $categoryId,
                        'product_name' => 'Product 2 for ' . $categoryId,
                        'price' => 19.99
                    ]
                ];

                $this->db->table('Products')->insertBatch($product_data);
            }










        }
    }
}
