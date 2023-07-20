<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $allowedFields = ['categoryname', 'description', 'image','created_at'];

    public function list()
    {
        return $this->findAll();
    } 
}
