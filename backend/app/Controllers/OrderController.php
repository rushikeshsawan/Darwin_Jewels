<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\OrderDetailModel;
use CodeIgniter\Email\Email;
use CodeIgniter\Pager\Pager;
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
        $orderList = $orderModel->listWithPagination(10);
        $data = [
            'order' => $orderList, // Directly use the paginated result
            'pager' => $orderModel->pager, // Access pager information
        ];
        return view('order/order_details', $data);
    }

    // public function generateQrCode($orderId)
    // {
    //     $qrCode = new QrCode($orderId);

    //     // Output the image directly to the browser
    //     header('Content-Type: ' . $qrCode->getContentType());
    //     echo $qrCode->writeString();
    // }
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
    
        if (!$orderDetail) {
            $response = ['success' => false, 'message' => 'Order Detail not found'];
        } else {
            $userId = $orderDetail['user_id'];
    
            if (!$userId) {
                $response = ['success' => false, 'message' => 'User ID not found'];
            } else {
                $userModel = new UserModel();
                $userModel->increaseWalletAmount($userId, 100);
    
                // Fetch user details for the email content and "To" address
                $emailDetail = $userModel->getUserById($userId);
                $toEmail = $emailDetail['email']; // Assuming email is a field in the user details
    
                // Create the email content using a view
                $viewData = [
                    'emailDetail' => $emailDetail,
                ];
                $email = \Config\Services::email();
                $subject = 'Order Delivery Successful';
                $message = "Your order has been successfully delivered. Order Id:-".$orderId; 
                $email->setTo($toEmail); 
                $email->setFrom('vishal.naik@darwinpgc.com', 'Test');
                $email->setSubject($subject);
                $email->setMessage($message);  
    
                if ($email->send()) {
                    $response = ['success' => true, 'message' => 'Wallet increased and email sent successfully'];
                } else {
                    $response = ['success' => false, 'message' => 'Failed to send email'];
                }
            }
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
    public function exportToCSV(){
        $data=$this->OrderDetailModel->list();
        header('Content-Type:text/csv');
        header('Content-Disposition: attachment; filename="exported_data.csv"');
        $output=fopen('php://output','w');
        fputcsv($output, array_keys($data[0]));
        foreach ($data as $row) {
            fputcsv($output, $row);
        } 
        fclose($output);
    }

}
