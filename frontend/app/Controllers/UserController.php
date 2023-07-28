<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\AddressModel;
use App\Models\OrderDetailModel;
use CodeIgniter\Email\Email;


class UserController extends BaseController
{
    protected $adminModel;
    protected $productModel;
    protected $categoryModel;
    protected $addressModel;
    protected $OrderDetailModel;
    protected $session;
    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->addressModel = new AddressModel();
        $this->OrderDetailModel = new OrderDetailModel();
        $this->session = \Config\Services::session();
    }
    public function login()
    {
        $isLoggedIn = $this->session->get('admin');
        if ($isLoggedIn) {
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'username' => 'required',
                'password' => 'required'
            ];
            if ($this->validate($rules)) {
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');

                // Get the admin data from the database
                $admin = $this->adminModel->where('username', $username)->first();
                if ($admin && password_verify($password, $admin['password'])) {
                    if ($admin['active'] == 1) {
                        $adminData = [
                            'username' => $username,
                            'id' => $admin['id'],
                        ];
                        $this->session->set('admin', $adminData);
                        session()->setTempdata('success', 'Successfully logged in', 1);
                        return redirect()->to('/dashboard');
                    } else {
                        $data['validation'] = 'Please contact the admin for further assistance.';
                        return view('userLogin', $data);
                    }
                } else {
                    $data['validation'] = 'Invalid Credentials';
                    return view('userLogin', $data);
                }
            } else {
                $data['validation'] = $this->validator;
                return view('userLogin', $data);
            }
        } else {
            $data['validation'] = $this->validator;
            return view('userLogin', $data);
        }
    }


    public function address()
    {
        $user_id = $this->request->getPost('user_id');
        $name = $this->request->getPost('name');
        $address = $this->request->getPost('address');
        $mobile = $this->request->getPost('mobile');
        $email = $this->request->getPost('email');
        $zip = $this->request->getPost('zip');
        if (!$this->validate($this->addressModel->getValidationRules())) {
            $validationErrors = $this->validator->getErrors();
            return json_encode(['success' => false, 'errors' => $validationErrors]);
        }
        $userData = [
            'user_id' => $user_id,
            'name' => $name,
            'address' => $address,
            'mobile' => $mobile,
            'email' => $email,
            'zip' => $zip,
        ];

        $this->addressModel->insert($userData);
        $newAddress = $this->addressModel->find($this->addressModel->insertID());
        return json_encode(['success' => true, 'message' => 'Address Added successfully!', 'address' => $newAddress]);
    }
 
    public function removeFromCart()
    {
        if ($this->request->isAJAX()) {
            $key = $this->request->getVar('key');
            $cartItems = session('cart_items') ?? [];

            if (isset($cartItems[$key])) {
                unset($cartItems[$key]);
                session()->set('cart_items', $cartItems);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Product removed from cart.']);
            }

            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid cart item key.']);
        }
    } 
 
    public function storeSelectedAddress()
    {
        if ($this->request->isAJAX()) {
            $addressId = $this->request->getPost('address_id');
            $address = $this->addressModel->find($addressId);
            if (!$address) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Address not found.']);
            }
            $session = \Config\Services::session();
            $session->set('selected_address', $address);

            return $this->response->setJSON(['status' => 'success', 'message' => 'Address stored in session.', 'address' => $address]);
        }
    }

    public function placeOrder()
    {
        $loggedInUserId = $this->session->get('admin')['id'];
        $lastOrder = $this->OrderDetailModel->selectMax('order_id')->first();
        $lastOrderId = $lastOrder['order_id'];
        $newOrderId = $lastOrderId + 1;
        $addressId = $this->request->getPost('address_id');
        $product_ids = $this->request->getPost('product_id');
        $totalPrice = $this->request->getPost('total_price');
        $quantity = $this->request->getPost('quantity');
        $Qprice = $this->request->getPost('Qprice');  
         $sanitizedQprice = array_map(function ($qprice) {
            return filter_var($qprice, FILTER_SANITIZE_NUMBER_INT);
        }, $Qprice);

        $orderData = [];
        foreach ($product_ids as $index => $productId) {
            $orderData[] = [
                'order_id' => $newOrderId,
                'user_id' => $loggedInUserId,
                'address_id' => $addressId,
                'product_id' => $productId,
                'quantity' => $quantity[$index],
                'Qprice' => $sanitizedQprice[$index],  
                'total_price' => $totalPrice
            ];
        } 
         $inserted = $this->OrderDetailModel->insertBatch($orderData);

        if ($inserted) {
            return $this->response->setJSON(['success' => true, 'message' => 'Order placed successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to place order.']);
        }
    }
    public function getUserOrders()
    {
         $loggedInUserId = $this->session->get('admin')['id']; 
         $data['orders'] = $this->OrderDetailModel->getUserOrders($loggedInUserId);

         return view('order_list', $data);
    }

    public function getOrderDetails($orderId)
    {
         $data['orders'] = $this->OrderDetailModel->getOrderDetailsById($orderId); 
        return view('order_details', $data);
    }
}
