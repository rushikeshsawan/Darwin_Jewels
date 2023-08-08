<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\OrderDetailModel;
use App\Models\UserModel;
use CodeIgniter\Email\Email;

class UserController extends BaseController
{
    protected $adminModel;
    protected $UserModel;
    protected $productModel;
    protected $categoryModel;
    protected $orderModel;
    protected $session;
    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->UserModel = new UserModel();
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->orderModel = new OrderDetailModel();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        $data['user'] = $this->UserModel->list();
        return view('User/list', $data);
    }
    public function login_user()
    {
        $userId = $this->request->getPost('id');
        $user = $this->UserModel->getUserById($userId);

        if ($user) {
            $userData = [
                'userId' => $userId,
                'id' => $user['id'],
            ];
            $this->session->set('user', $userData); // Set the user_id session variable
            echo json_encode(["message" => "User logged in successfully"]);
        } else {
            echo json_encode(["message" => "User not found"]);
        }
    }

    public function getUserOrders()
    {
        $userSession = $this->session->get('user');
        $loggedInUserId = $userSession['id'];
        
        $data['orders'] = $this->orderModel->getUserOrders($loggedInUserId);
        return view('user/order_details ', $data);
    }
}
