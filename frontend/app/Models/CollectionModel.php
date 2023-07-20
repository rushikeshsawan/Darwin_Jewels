<?php

namespace App\Models;

use CodeIgniter\Model;

class CollectionModel extends Model
{
    protected $table = 'featuredcollection';
    protected $primaryKey = 'id';
    protected $allowedFields = ['featuredcollection', 'description', 'image','created_at'];

    public function list()
    {
        return $this->findAll();
    } 
}
