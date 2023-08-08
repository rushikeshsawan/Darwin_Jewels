<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\OrderDetailModel;
use CodeIgniter\Email\Email;
use Dompdf\Dompdf;
 
class OrderController extends BaseController
{
    protected $adminModel;
    protected $productModel;
    protected $categoryModel;
    protected $OrderDetailModel;
    protected $userModel;
    protected $session;
    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->userModel = new userModel();
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->OrderDetailModel = new OrderDetailModel();
        $this->session = \Config\Services::session();
        
    }
 
    public function index()
    { 
        $data['order'] = $this->OrderDetailModel->list();
        return view('Order/order_details', $data);
    }
    public function getOrderDetails()
    {
        $orderId = $this->request->getVar('order_id'); 
        $orderDetails=$this->OrderDetailModel->getOrderDetailsById($orderId);
        return $this->response->setJSON($orderDetails);
    }
    public function updateOrderStatus()
    { 
        $orderId = $this->request->getPost('orderId');
        $newStatus = $this->request->getPost('newStatus');  
        $this->OrderDetailModel->updateOrderStatus($orderId, $newStatus); 
        $response = ['success' => true];
        return $this->response->setJSON($response);
    }
    public function increase_wallet()
    {
        $orderId = $this->request->getPost('orderId'); 
        $orderDetail = $this->OrderDetailModel->find($orderId); 
        $userId = $orderDetail['user_id'];
        if ($userId) {
            $userModel = new UserModel();
            $userModel->increaseWalletAmount($userId, 100); 
            $response = ['success' => true];
        } else {
            $response = ['success' => false, 'message' => 'User ID not found'];
        } 
        return $this->response->setJSON($response);
    }
    public function fetch_invoice_data($order_id = null)
    {
        // $order_id = $this->request->getPost('order_id');  
        $data['order'] = $this->OrderDetailModel->getOrderDetailsById($order_id);
        $dompdf = new Dompdf();
        $html = view('Order/bill', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("Order/bill.pdf", array("Attachment" => false));
    }
}
