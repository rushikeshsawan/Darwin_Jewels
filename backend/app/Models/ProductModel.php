<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $allowedFields = ['id', 'product_name', 'category_id', 'description', 'prize', 'image','image1','image2','image3', 'rating', 'created_at'];

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
    public function saveRating($productId, $rating)
    {
        $this->update($productId, ['rating' => $rating]);
    }
    public function getCategoryImage($id)
    {
        return $this->db->table('product')
            ->select('image')
            ->where('id', $id)
            ->get()
            ->getRow('image');
    }
 
}
