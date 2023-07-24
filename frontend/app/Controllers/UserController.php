<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use CodeIgniter\Email\Email;

class UserController extends BaseController
{
    protected $adminModel;
    protected $productModel;
    protected $categoryModel;
    protected $session;
    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
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
}
