<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\AddressModel;
use App\Models\OrderDetailModel;
use App\Models\PaymentModel;
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
    // public function verifyPayment()
    // {
    //     try {
    //         // Get the payment details from the AJAX request
    //         $paymentId = $this->request->getPost('payment_id');
    //         $orderId = $this->request->getPost('order_id');
    //         $signature = $this->request->getPost('signature');

    //         $razorpayKeyId = 'rzp_test_GGXHzqc5bmnUdI'; // Replace with your actual Razorpay Key ID
    //         $razorpayKeySecret = '8kfCJqLqQVqPcMet5NKBqaB2'; // Replace with your actual Razorpay Key Secret

    //         // Initialize the Razorpay API with your key ID and key secret
    //         $razorpay = new Api($razorpayKeyId, $razorpayKeySecret);

    //         // Verify the payment signature
    //         $attributes = array(
    //             'order_id' => $orderId,
    //             'payment_id' => $paymentId,
    //             'signature' => $signature,
    //         );

    //         $razorpay->utility->verifyPaymentSignature($attributes);

    //         // Payment signature verification successful
    //         $response = [
    //             'success' => true,
    //             'message' => 'Payment successful. Your order will be processed shortly.',
    //         ];
    //         return $this->response->setJSON($response); // Correct JSON response for successful payment

    //     } catch (\Exception $e) {
    //         // Log the error for debugging purposes
    //         log_message('error', 'Payment verification error: ' . $e->getMessage());

    //         // If there was an error, return an error response
    //         $response = [
    //             'success' => false,
    //             'message' => 'Payment verification failed. Please try again later.',
    //         ];
    //         return $this->response->setJSON($response)->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }
    // public function verifyPayment()
    // {
    //     // Load the Razorpay configuration
    //     $razorpayConfig = new Razorpay();

    //      $keyId = $razorpayConfig->keyId;
    //     $keySecret = $razorpayConfig->keySecret;

    //      if ($keyId === 'received_key_id' && $keySecret === 'received_key_secret') { 
    //         header("Location: https://example.com/myOtherPage.php"); 
    //     } else { 
    //         header("Location: https://example.com/myOtherPage.php");
    //     }
    // }
    public function initiatePayment()
    {
        // Get the necessary data for payment initiation from the form
        $selectedAddressId = $this->request->getPost('address_id');
        $totalPrice = $this->request->getPost('total_price');

        // Create an order ID using your own logic (example below)
        $orderId = uniqid(); // Generate a unique order ID (you can use your own logic)

        // Initialize Razorpay API with your key ID and key secret
        $razorpayKeyId = 'rzp_test_GGXHzqc5bmnUdI'; // Replace with your actual Razorpay Key ID
        $razorpayKeySecret = '8kfCJqLqQVqPcMet5NKBqaB2'; // Replace with your actual Razorpay Key Secret
        $razorpay = new Api($razorpayKeyId, $razorpayKeySecret);

        // Create an order
        try {
            $orderData = [
                'amount' => $totalPrice * 100, // Amount in paise (Rupees * 100)
                'currency' => 'INR',
                'receipt' => $orderId, // Your unique order ID
                'payment_capture' => 1, // Auto-capture payment on success
            ];

            $order = $razorpay->order->create($orderData);

            // The order ID will be used in the Razorpay checkout form
            $orderId = $order['id'];

            // Now return the order ID to the client-side for initiating payment
            $response = [
                'success' => true,
                'order_id' => $orderId,
            ];
            return $this->response->setJSON($response);
        } catch (\Exception $e) {
            // Handle the error, show an error message, or log it
            $response = [
                'success' => false,
                'message' => 'Error creating Razorpay order.',
            ];
            return $this->response->setJSON($response);
        }
    }

 // Controller method to handle AJAX request to clear cart items from session
public function clearCartItems()
{
    $session = \Config\Services::session();
    $session->remove('cart_items');
    return $this->response->setJSON(['success' => true]);
}

// Controller method to handle AJAX request for placing the order
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
    $payment_id = $this->request->getPost('payment_id');
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
            'payment_id' => $payment_id
        ];
    }
    $inserted = $this->OrderDetailModel->insertBatch($orderData);

    if ($inserted) {
        return $this->response->setJSON(['success' => true, 'message' => 'Order placed successfully.']);
    } else {
        return $this->response->setJSON(['success' => false, 'message' => 'Failed to place order.']);
    }
}

    // public function createOrder()
    // {
    //     // Get the POST data sent from the AJAX request
    //     $addressId = $this->request->getPost('address_id');
    //     $productIds = $this->request->getPost('product_id');
    //     $quantities = $this->request->getPost('quantity');
    //     $qPrices = $this->request->getPost('Qprice');
    //     $totalPrice = $this->request->getPost('total_price');

    //     // Save the order details in the database
    //     $OrderDetailModel = new OrderDetailModel();
    //     $orderId = $OrderDetailModel->saveOrder($addressId, $productIds, $quantities, $qPrices, $totalPrice);

    //     // Initialize Razorpay API with your API Key and API Secret
    //     $api = new Api('rzp_test_VPRt7vsgU7Oaf2', 'x9R37MwwRSHEGtUI9XtzffhC');

    //     // Create an order in Razorpay
    //     $orderData = [
    //         'receipt' => $orderId,
    //         'amount' => $totalPrice * 100, // Amount must be in paise
    //         'currency' => 'INR',
    //         'payment_capture' => 1 // Auto capture the payment
    //     ];

    //     try {
    //         $order = $api->order->create($orderData);
    //     } catch (\Exception $e) {
    //         return $this->respond(['error' => $e->getMessage()], 500);
    //     }

    //     // Return the order ID to the AJAX request
    //     return $this->respond(['order_id' => $order->id]);
    // }


    public function getUserOrders()
    {
        $loggedInUserId = $this->session->get('admin')['id'];
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
}
