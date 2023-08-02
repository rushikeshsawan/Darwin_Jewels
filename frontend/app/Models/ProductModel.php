<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $allowedFields = ['id', 'product_name', 'category_id', 'description', 'prize', 'image', 'rating', 'created_at'];

    public function store($product_name, $category_id, $description, $prize, $image)
    {
        $data = [
            'product_name' => $product_name,
            'category_id' => $category_id,
            'description' => $description,
            'prize' => $prize,
            'image' => $image
        ];
        $this->insert($data);
    }
    public function list()
    {
        $db = $this->db;
        $query = $db->table('category');
        $query->select('*');
        $query->join('products', 'category.id = products.category_id');
        return $query->get()->getResultArray(); // Use getResultArray() instead of getResult()
    }
    
    public function listOrderByPrice($order = 'asc')
    {
        if ($order === 'asc') {
            return $this->orderBy('prize', 'asc')->findAll();
        } else {
            return $this->orderBy('prize', 'desc')->findAll();
        }
    }
}
