<?php

namespace App\Controllers;

use App\Models\CollectionModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\AddressModel;
use App\Models\OrderDetailModel;

class HomeController extends BaseController
{
    protected $CategoryModel;
    protected $CollectionModel;
    protected $ProductModel;
    protected $addressModel;
    protected $OrderDetailModel;
    protected $session;


    public function __construct()
    {
        $this->CategoryModel = new CategoryModel();
        $this->CollectionModel = new CollectionModel();
        $this->ProductModel = new ProductModel();
        $this->addressModel = new AddressModel();
        $this->OrderDetailModel = new OrderDetailModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $data['Category'] = $this->CategoryModel->list();
        $data['Collection'] = $this->CollectionModel->list();
        $data['Product'] = $this->ProductModel->list();
        return view('home', $data);
    }
    public function product()
    {
        $data['Product'] = $this->ProductModel->list();
        $data['Category'] = $this->CategoryModel->list();
        return view('product', $data);
    }

    public function checkout()
    {
        $isLoggedIn = $this->session->get('admin');
        if ($isLoggedIn) {
            $cartItems = $this->session->get('cartItems') ?? [];
            $userId = $this->session->get('admin')['id'];
            $addressData = $this->addressModel->where('user_id', $userId)->findAll();
            $data['address'] = $addressData;
            $data['cartItems'] = $cartItems;
            $data['id'] = $userId;
            return view('checkout', $data); 
        } else {
            return redirect()->to('userlogin');
        }
    }


    public function fetchCartData()
    {
        $cartItems = $this->session->get('cartItems') ?? [];
        return $this->response->setJSON($cartItems);
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

    public function QuickView()
    {
        $productId = $this->request->getVar('product_id');
        $productModel = new ProductModel();
        $product = $productModel->find($productId);
        return $this->response->setJSON($product);
    }
    public function addToSession()
    {
        $cartItems = $this->request->getPost('cartItems');
        $session = \Config\Services::session();
        $session->set('cartItems', $cartItems);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function addToCart()
    {
        if ($this->request->isAJAX()) {
            $productId = $this->request->getVar('product_id');
            $this->ProductModel = new ProductModel();
            $product = $this->ProductModel->find($productId);

            if (!$product) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Product not found.']);
            }

            $productData = [
                'id' => $product['id'],
                'name' => $product['product_name'],
                'prize' => $product['prize'],
                'image' => base_url('/uploads/FeatureProduct/' . $product['image']),
            ]; 
            $cartItems = session('cart_items') ?? [];
            $alreadyAdded = false;
            foreach ($cartItems as $item) {
                if ($item['id'] === $productData['id']) {
                    $alreadyAdded = true;
                    break;
                }
            }
            if (!$alreadyAdded) {
                $this->addToCartSession($productData);
            }
            return $this->response->setJSON(['status' => 'success', 'message' => 'Product added to cart.', 'alreadyAdded' => $alreadyAdded]);
        }
    } 
    protected function addToCartSession($product)
    {
        $cartItems = session('cart_items') ?? [];
        $cartItems[] = $product;
        session()->set('cart_items', $cartItems);
    }
    public function cartList()
    {
        $cartItems = session()->get('cart_items') ?? [];
        return view('cart_list', ['cartItems' => $cartItems]);
    }
    public function getProductsByCategory()
    {
        $category_id = $this->request->getVar('category_id');
        $productModel = new ProductModel();
        $products = $productModel->where('category_id', $category_id)->findAll();
        echo json_encode($products);
    }
    // public function storeSelectedAddress()
    // {
    //     if ($this->request->isAJAX()) {
    //         $addressId = $this->request->getPost('address_id');
    //         $address = $this->addressModel->find($addressId);
    //         if (!$address) {
    //             return $this->response->setJSON(['status' => 'error', 'message' => 'Address not found.']);
    //         }
    //         $session = \Config\Services::session();
    //         $session->set('selected_address', $address);

    //         return $this->response->setJSON(['status' => 'success', 'message' => 'Address stored in session.', 'address' => $address]);
    //     }
    // }

    // public function placeOrder()
    // {
    //     $loggedInUserId = $this->session->get('admin')['id'];
    //     $lastOrder = $this->OrderDetailModel->selectMax('order_id')->first();
    //     $lastOrderId = $lastOrder['order_id'];
    //     $newOrderId = $lastOrderId + 1;
    //     $addressId = $this->request->getPost('address_id');
    //     $product_ids = $this->request->getPost('product_id');
    //     $totalPrice = $this->request->getPost('total_price');
    //     $quantity = $this->request->getPost('quantity');
    //     $Qprice = $this->request->getPost('Qprice');

    //     // Sanitize Qprice values and keep only integers
    //     $sanitizedQprice = array_map(function ($qprice) {
    //         return filter_var($qprice, FILTER_SANITIZE_NUMBER_INT);
    //     }, $Qprice);

    //     $orderData = [];
    //     foreach ($product_ids as $index => $productId) {
    //         $orderData[] = [
    //             'order_id' => $newOrderId,
    //             'user_id' => $loggedInUserId,
    //             'address_id' => $addressId,
    //             'product_id' => $productId,
    //             'quantity' => $quantity[$index],
    //             'Qprice' => $sanitizedQprice[$index], // Use the sanitized Qprice value for each product
    //             'total_price' => $totalPrice
    //         ];
    //     }

    //     // Insert the order details into the database
    //     $inserted = $this->OrderDetailModel->insertBatch($orderData);

    //     if ($inserted) {
    //         // Return a JSON response to the client
    //         return $this->response->setJSON(['success' => true, 'message' => 'Order placed successfully.']);
    //     } else {
    //         return $this->response->setJSON(['success' => false, 'message' => 'Failed to place order.']);
    //     }
    // }
}
