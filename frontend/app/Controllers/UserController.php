<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\AddressModel;
use CodeIgniter\Email\Email;

class UserController extends BaseController
{
    protected $adminModel;
    protected $productModel;
    protected $categoryModel;
    protected $addressModel;
    protected $session;
    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->addressModel = new AddressModel();
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

        // Validate form data using the AddressModel's validation rules
        if (!$this->validate($this->addressModel->getValidationRules())) {
            $validationErrors = $this->validator->getErrors();
            return json_encode(['success' => false, 'errors' => $validationErrors]);
        }

        // Store the data in the database
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
    public function storeSelectedAddress()
{
    $addressId = $this->input->post('addressId'); 
    $this->session->set_userdata('selected_address_id', $addressId); 
    $response['success'] = true;
    $response['message'] = 'Address selected successfully.';
    echo json_encode($response);
}

}
