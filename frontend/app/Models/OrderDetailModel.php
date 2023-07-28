<?php

namespace App\Models;
use CodeIgniter\Model;

class OrderDetailModel extends Model
{
    protected $table = 'order_details';
    protected $allowedFields = ['id','order_id','user_id','product_id', 'quantity', 'Qprice', 'address_id', 'total_price', 'created_at'];  
    public function insertOrder($data)
    {
        return $this->insert($data);
    }
}
   
 
