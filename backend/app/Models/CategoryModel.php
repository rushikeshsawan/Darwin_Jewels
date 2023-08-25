<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $allowedFields = ['categoryname', 'description', 'image', 'rating', 'created_at'];

    public function list()
    {
        return $this->findAll();
    }
    public function store($categoryname, $image, $description, $star)
    {
        $data = [
            'categoryname' => $categoryname,
            'description' => $description,
            'image' => $image,
            'star' => $star,
        ];
        $this->insert($data);
    }
    public function updateCategory($id, $categoryname, $description, $imageName)
    {
        $data = [
            'categoryname' => $categoryname,
            'description' => $description,
            'image' => $imageName
        ];
        $this->update($id, $data);
    }
    public function getCategoryImage($id)
    {
        return $this->db->table('category')
            ->select('image')
            ->where('id', $id)
            ->get()
            ->getRow('image');
    }


    public function getAddedCategoriesCountLast7Days()
    {
        return $this->where('created_at >=', date('Y-m-d', strtotime('-7 days')))
            ->countAllResults();
    }
    public function getTotalCategoriesCount()
    {
        return $this->countAllResults();
    }
    public function updateRating($category_id, $rating)
    {
        $this->where('id', $category_id)->set(['rating' => $rating])->update();
    }
}
