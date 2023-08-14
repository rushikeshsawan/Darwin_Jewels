<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDetailModel extends Model
{
    protected $table = 'order_details';
    protected $allowedFields = ['id', 'order_id', 'user_id', 'product_id', 'signature', 'payment_id', 'quantity', 'Qprice', 'address_id', 'total_price', 'status', 'created_at'];
    public function insertOrder($data)
    {
        return $this->insert($data);
    }
    public function list()
    {
        return $this
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
                          od.payment_id,
                          od.useWallet,
                          od.Qprice,
                          od.total_price,
                          od.created_at,
                          addr.id AS address_id,
                          addr.address');

        $builder->join('products p', 'od.product_id = p.id');
        $builder->join('admin a', 'od.user_id = a.id');
        $builder->join('address addr', 'od.address_id = addr.id');
        $builder->where('od.order_id', $orderId);

        $query = $builder->get();
        return $query->getResult();
    }
    public function listPaginated($page = 1, $perPage = 10)
    {
        $builder = $this->db->table($this->table);
        $builder->groupBy('order_id'); 
        $offset = max(($page - 1) * $perPage, 0);
        $builder->limit($perPage, $offset);

        $query = $builder->get();
        $result['data'] = $query->getResultArray();
        $totalResults = $this->db->table($this->table)->countAllResults();
        $result['total_results'] = $totalResults;
        $result['per_page'] = $perPage;
        return $result;
    }


    public function updateOrderStatus($orderId, $newStatus)
    {
        $this->set('status', $newStatus)
            ->where('order_id', $orderId)
            ->update();
    }
    public function getUserOrders($loggedInUserId)
    {
        return $this->where('user_id', $loggedInUserId)
            ->groupBy('order_id')
            ->findAll();
    }
    public function getTotalOrderCount()
    {
        $query = $this->db->table('order_details')
            ->select('COUNT(DISTINCT order_id) AS unique_order_count')
            ->groupBy('order_id')
            ->get();
        $result = $query->getResult();
        return count($result);
    }
    public function countUniqueInProgressOrders()
    {
        $query = $this->db->table('order_details')
            ->select('COUNT(DISTINCT order_id) AS unique_in_progress_count')
            ->where('status', 'progress') // Add the WHERE condition for status
            ->groupBy('order_id')
            ->get();

        $result = $query->getResult();

        return count($result);
    }
    public function countUniqueOrdersByStatus($status)
    {
        $query = $this->db->table('order_details')
            ->select('COUNT(DISTINCT order_id) AS unique_order_count')
            ->where('status', $status) // Add the WHERE condition for status
            ->groupBy('order_id')
            ->get();

        $result = $query->getResult();

        return count($result);
    }
    public function countUniqueShippedOrders()
    {
        return $this->countUniqueOrdersByStatus('shipped');
    }

    public function countUniqueCanceledOrders()
    {
        return $this->countUniqueOrdersByStatus('cancel');
    }

    public function countUniqueDeliveredOrders()
    {
        return $this->countUniqueOrdersByStatus('delivered');
    }

    public function countUniqueAcceptedOrders()
    {
        return $this->countUniqueOrdersByStatus('accepted');
    }
}
