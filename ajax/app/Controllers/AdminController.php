<?php

namespace App\Controllers;

// use App\Models\AdminModel;
// use App\Models\ProductModel;
// use App\Models\CategoryModel;
// use App\Models\OrderDetailModel;
// use App\Models\SliderModel;
// use CodeIgniter\Email\Email;

class AdminController extends BaseController
{
    // protected $adminModel;
    // protected $productModel;
    // protected $categoryModel;
    // protected $orderModel;
    // protected $sliderModel;
    // protected $session;
    // public function __construct()
    // {
    //     $this->adminModel = new AdminModel();
    //     $this->productModel = new ProductModel();
    //     $this->categoryModel = new CategoryModel();
    //     $this->orderModel = new OrderDetailModel();
    //     $this->sliderModel = new SliderModel();
    //     $this->session = \Config\Services::session();
    // }
    public function index($page = null)
    {
        if ($page === null) {
            return view('Admin/dashboard'); // Load the main view
        } else {
            return view($page); // Load content for the requested page
        }
    }
    public function list()
    {
        return view('Admin/dashboard');
    }

    public function page1()
    {
        return view('page1'); // Load content for page 1
    }

    public function page2()
    {
        return view('page2'); // Load content for page 2
    }
}
