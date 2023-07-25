<?php

namespace App\Controllers;

use App\Models\CollectionModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\AddressModel; 

class HomeController extends BaseController
{
    protected $CategoryModel;
    protected $CollectionModel;
    protected $ProductModel;
    protected $addressModel; 
    protected $session;


    public function __construct()
    {
        $this->CategoryModel = new CategoryModel();
        $this->CollectionModel = new CollectionModel();
        $this->ProductModel = new ProductModel();
        $this->addressModel = new AddressModel();
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
            return view('checkout', $data); // Pass $data as the second parameter
        } else {
            return redirect()->to('userlogin');
        }
    } 

    public function fetchCartData()
    {
        $cartItems = $this->session->get('cartItems') ?? [];
        return $this->response->setJSON($cartItems);
    }
    public function removeFromSession()
    {
        if ($this->request->isAJAX()) {
            $key = $this->request->getVar('key');
            $cartItems = $this->session->get('cartItems') ?? [];
            if (isset($cartItems[$key])) {
                unset($cartItems[$key]);
                $this->session->set('cartItems', $cartItems);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Product removed from cart.']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid cart item key.']);
            }
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
            $this->addToCartSession($productData); 
            return $this->response->setJSON(['status' => 'success', 'message' => 'Product added to cart.']);
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
}
