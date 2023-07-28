<?php

namespace App\Models;
use CodeIgniter\Model;

class OrderDetailModel extends Model
{
    protected $table = 'order_details';
    protected $allowedFields = ['id','order_id','user_id','product_id', 'quantity', 'Qprice', 'address_id', 'total_price','status', 'created_at'];  
    public function insertOrder($data)
    {
        return $this->insert($data);
    }
    public function getUserOrders($userId)
    {
        return $this->where('user_id', $userId)
                    ->groupBy('order_id')   
                    ->findAll();
    }
    public function getOrderDetailsById($orderId)
    {
        return $this->where('order_id', $orderId)
                    ->findAll();
    }
}
   
 
