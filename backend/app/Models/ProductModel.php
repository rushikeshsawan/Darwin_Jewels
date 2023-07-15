<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $allowedFields = ['id', 'product_name', 'category_id', 'description', 'rating', 'created_at'];

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
    public function getAddedProductsCountLast7Days()
    {
        return $this->where('created_at >=', date('Y-m-d', strtotime('-7 days')))
            ->countAllResults();
    }
    public function getTotalProductsCount()
    {
        return $this->countAllResults();
    }
    public function storeRating($productId, $rating)
    {
        $this->set('rating', $rating)
            ->where('id', $productId)
            ->update();
    }
}
