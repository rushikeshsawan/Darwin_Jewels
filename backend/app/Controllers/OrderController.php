<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\OrderDetailModel;
use CodeIgniter\Email\Email;
use Endroid\QrCode\QrCode;
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
        $orderModel = new OrderDetailModel();
        $orderList = $orderModel->paginate(10);

        $qrCodeUrls = [];
        foreach ($orderList as $orderItem) {
            $qrCodeUrls[$orderItem['order_id']] = site_url('order/generateQrCode/' . $orderItem['order_id']);
        }

        $data = [
            'orderList' => $orderList,
            'qrCodeUrls' => $qrCodeUrls,
            'pager' => $orderModel->pager
        ];

        return view('order/order_details', $data);
    }

    public function generateQrCode($orderId)
    {
        $qrCode = new QrCode($orderId);

        // Output the image directly to the browser
        header('Content-Type: ' . $qrCode->getContentType());
        echo $qrCode->writeString();
    }
    public function getOrderDetails()
    {
        $orderId = $this->request->getVar('order_id');
        $orderDetails = $this->OrderDetailModel->getOrderDetailsById($orderId);
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
