<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'Products';
    protected $primaryKey       = 'product_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['product_id','product_name','price', 'category_id','description'];

    public function getProductsByCategoryId($categoryId)
    {
        return $this->where('category_id', $categoryId)->findAll();
    }
}
