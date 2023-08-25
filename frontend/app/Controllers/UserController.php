<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\AddressModel;
use App\Models\OrderDetailModel;
use App\Models\PaymentModel;
use App\Models\UserModel;
use CodeIgniter\Email\Email;
use Config\Razorpay;
use Razorpay\Api\Api;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{

    protected $adminModel;
    protected $productModel;
    protected $categoryModel;
    protected $addressModel;
    protected $OrderDetailModel;
    protected $userModel;
    protected $session;
    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->addressModel = new AddressModel();
        $this->userModel = new UserModel();
        $this->OrderDetailModel = new OrderDetailModel();
        $this->session = \Config\Services::session();
    }

    public function login()
    {
        // Check if the user is already logged in, redirect to home if logged in
        $isLoggedIn = $this->session->get('user');
        if ($isLoggedIn) {
            return redirect()->to('home');
        }

        if ($this->request->getMethod() === 'post') {
            $response = $this->request->getPost('g-recaptcha-response');
            $secretKey = '6Leud3gnAAAAANy_HGJn3y_ZHI5sjCgJrpk5v-oG';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $response);
            $responseData = json_decode($verifyResponse);

            if (!$responseData->success) {
                $this->session->setFlashdata('error', 'reCAPTCHA verification failed');
            } else {
                $rules = [
                    'username' => 'required',
                    'password' => 'required'
                ];

                if ($this->validate($rules)) {
                    $username = $this->request->getPost('username');
                    $password = $this->request->getPost('password');
                    $user = $this->userModel->where('username', $username)->first();

                    if ($user && password_verify($password, $user['password'])) {
                        if ($user['active'] == 1) {
                            $userData = [
                                'username' => $username,
                                'id' => $user['id'],
                            ];
                            $this->session->set('user', $userData);
                            session()->setTempdata('success', 'Successfully logged in', 1);
                            return redirect()->to('checkout');
                        } else {
                            $this->session->setFlashdata('error', 'Please contact the admin for further assistance.');
                        }
                    } else {
                        $this->session->setFlashdata('error', 'Invalid Credentials');
                    }
                } else {
                    $this->session->setFlashdata('error', $this->validator->listErrors());
                }
            }
        }
        return view('userLogin');
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
    public function verifyPayment()
    {
        $paymentId = $this->request->getPost('payment_id');
        $orderId = $this->request->getPost('order_id');
        $signature = $this->request->getPost('signature');
        $amount = 0;
        $paymentModel = new PaymentModel();
        $paymentModel->insert([
            'order_id' => $orderId,
            'payment_id' => $paymentId,
        ]);

        // Send a response indicating successful payment verification
        return $this->response->setJSON(['success' => true, 'message' => 'Payment verified successfully']);
    }
    public function initiatePayment()
    {
        // Get the necessary data for payment initiation from the form
        $selectedAddressId = $this->request->getPost('address_id');
        $totalPrice = $this->request->getPost('total_price'); 
         $orderId = uniqid(); 
        $razorpayKeyId = 'rzp_test_GGXHzqc5bmnUdI'; 
        $razorpayKeySecret = '8kfCJqLqQVqPcMet5NKBqaB2'; 
        $razorpay = new Api($razorpayKeyId, $razorpayKeySecret);

        // Create an order
        try {
            $orderData = [
                'amount' => $totalPrice * 100,  
                'currency' => 'INR',
                'receipt' => $orderId,  
                'payment_capture' => 1,  
            ]; 
            $order = $razorpay->order->create($orderData); 
            $orderId = $order['id']; 
            $response = [
                'success' => true,
                'order_id' => $orderId,
            ];
            return $this->response->setJSON($response);
        } catch (\Exception $e) { 
            $response = [
                'success' => false,
                'message' => 'Error creating Razorpay order.',
            ];
            return $this->response->setJSON($response);
        }
    }

    public function clearCartItems()
    {
        $session = \Config\Services::session();
        $session->remove('cart_items');
        return $this->response->setJSON(['success' => true]);
    }

    public function placeOrder()
    {
        $loggedInUserId = $this->session->get('user')['id'];
        $lastOrder = $this->OrderDetailModel->selectMax('order_id')->first();
        $lastOrderId = $lastOrder['order_id'];
        $newOrderId = $lastOrderId + 1;
        $addressId = $this->request->getPost('address_id');
        $product_ids = $this->request->getPost('product_id');
        $totalPrice = $this->request->getPost('total_price');
        $quantity = $this->request->getPost('quantity');
        $Qprice = $this->request->getPost('Qprice');
        $payment_id = $this->request->getPost('payment_id');
        $useWallet = $this->request->getPost('useWallet');

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
                'total_price' => $totalPrice,
                'payment_id' => $payment_id,
                'useWallet' => $useWallet,
            ];
        }
        $inserted = $this->OrderDetailModel->insertBatch($orderData);

        if ($inserted) {
            return $this->response->setJSON(['success' => true, 'message' => 'Order placed successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to place order.']);
        }
    }
   
    public function update_wallet() {
        $wallet = $this->request->getPost('wallet');
        $userId = $this->session->get('user')['id'];
        
        $userModel = new UserModel();
        $userModel->update($userId, ['wallet' => $wallet]);
        
        // You might want to return a JSON response indicating success or failure.
        return $this->response->setJSON(['message' => 'Wallet updated successfully']);
    }    
    

    public function getUserOrders()
    {
        $loggedInUserId = $this->session->get('user')['id'];
        $data['orders'] = $this->OrderDetailModel->getUserOrders($loggedInUserId);
        return view('order_list', $data);
    }
    public function getOrderDetails()
    {
        $orderId = $this->request->getVar('order_id');
        $orderDetailModel = new OrderDetailModel();
        $orderDetails = $orderDetailModel->getOrderDetailsById($orderId);
        return $this->response->setJSON($orderDetails);
    }
    public function get_payment_options()
    {
        $userModel = new UserModel();

        $loggedInUserId = $this->session->get('user')['id'];
        $walletBalance = $userModel->getWalletBalanceByUsername($loggedInUserId);
        $response = array(
            'walletBalance' => $walletBalance
        );
        return $this->response->setJSON($response);
    }
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('');
    }
}
