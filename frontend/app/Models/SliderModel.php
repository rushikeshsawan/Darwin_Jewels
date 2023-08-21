<?php

namespace App\Models;

use CodeIgniter\Model;

class SliderModel extends Model
{
    protected $table = 'slider';
    protected $primaryKey = 'id';
    protected $allowedFields = ['image', 'main_heading', 'sub_heading'];

    public function list()
    {
        return $this->findAll();
    } 
}
