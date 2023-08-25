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

class MarketingController extends BaseController
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
        return view('Marketing/marketing');
    }
    public function setSelectedFilter($filter)
    {
        $session = \Config\Services::session();
        $users = $this->userModel->getUsersByFilter($filter);
        // $session->set('selected_filter', $filter);
        return $this->response->setJSON([
            'message' => 'Selected filter stored in session',
            'users' => $users
        ]);
    }
    // public function sendEmail()
    // {
    //     $email = \Config\Services::email();
    //     $userSessionData = $this->session->get('selected_filter');
      
    //     $to=$this->request->getPost('to');
    //     $subject = $this->request->getPost('title');
    //     $message = $this->request->getPost('message');

    //     $email->setTo($to);
    //     $email->setFrom('vishal.naik@darwinpgc.com', 'Password Reset Request');
    //     $email->setSubject($subject);
    //     $email->setMessage($message);
    //     $email->send();
    //     return $this->response->setJSON(['message' => $to]);

    //     // if ($email->send()) {
    //     //     return $this->response->setJSON(['message' => 'Email sent successfully']);
    //     // } else {
    //     //     $errorData = [
    //     //         'to' => $to,
    //     //         'subject' => $subject,
    //     //         'message' => $message
    //     //     ];
    //     //     $data = $email->printDebugger(['headers']);
    //     //     return $this->response->setJSON(['message' => $errorData]);
    //     // }
    // }

    public function sendEmail()
{
    $email = \Config\Services::email();
    $userSessionData = $this->session->get('selected_filter');

    $to = $this->request->getPost('to');
    $emailAddresses = explode(';', $to);

    $subject = $this->request->getPost('title');
    $message = $this->request->getPost('message');

    foreach ($emailAddresses as $emailAddress) {
        $email->clear(); // Clear any previous recipients/settings
        $email->setTo(trim($emailAddress)); // Trim to remove spaces
        $email->setFrom('vishal.naik@darwinpgc.com', 'Password Reset Request');
        $email->setSubject($subject);
        $email->setMessage($message);
        $email->send();
    }

    return $this->response->setJSON(['message' => 'Emails sent successfully']);
}

}
