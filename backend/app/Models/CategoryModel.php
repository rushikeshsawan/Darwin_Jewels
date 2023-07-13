<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $allowedFields = ['categoryname', 'description', 'image', 'star', 'created_at'];

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
    public function Uupdate($id, $categoryname, $description, $image, $star)
    {
        $data = [
            'categoryname' => $categoryname,
            'image' => $image,
            'description' => $description,
            'star' => $star,
        ];
        $this->where('id', $id)->set($data)->update();
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
}
