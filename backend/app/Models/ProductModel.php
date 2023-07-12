<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $allowedFields = ['id','product_name', 'category_id', 'description', 'created_at'];

    public function store($product_name, $category_id, $description)
    {
        $data = [
            'product_name' => $product_name,
            'category_id' => $category_id,
            'description' => $description,
        ];
        $this->insert($data);
    }

    public function list()
    {
        $db = $this->db; 
        $query = $db->table('category');
        $query->select('*');
        $query->join('products', 'category.id = products.category_id');
        return $query->get()->getResult();    
    }
}
   
