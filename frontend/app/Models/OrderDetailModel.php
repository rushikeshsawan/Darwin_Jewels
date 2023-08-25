<?php

namespace App\Models;
use CodeIgniter\Model;

class OrderDetailModel extends Model
{
    protected $table = 'order_details';
    protected $allowedFields = ['id','order_id','user_id','product_id','signature','payment_id','quantity', 'Qprice', 'address_id', 'total_price','useWallet','status', 'created_at'];  
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
        $builder = $this->db->table('order_details od');
        $builder->select('od.id AS order_detail_id,
                          p.id AS product_id,
                          p.prize,
                          p.product_name,
                          p.image,
                          p.rating,
                          a.id AS admin_id,
                          a.email,
                          a.username,
                          od.order_id,
                          od.quantity,
                          od.Qprice,
                          od.total_price,
                          addr.id AS address_id,
                          addr.address');
    
        $builder->join('products p', 'od.product_id = p.id');
        $builder->join('admin a', 'od.user_id = a.id');
        $builder->join('address addr', 'od.address_id = addr.id');
        $builder->where('od.order_id', $orderId);
    
        $query = $builder->get();
        return $query->getResult();
    }
    
}
   
 
