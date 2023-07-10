<?php

namespace App\Controllers;

use App\Models\AdminModel;

class AdminController extends BaseController
{
    protected $adminModel;
    protected $session;
    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->session = \Config\Services::session();
    }
    // public function index()
    // {
    //     echo view('Admin/signup');
    // }
    public function index()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => 'required|min_length[2]|max_length[50]|is_unique[admin.username]',
                'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[admin.email]',
                'password' => 'required|min_length[4]|max_length[50]'
            ];
            if ($this->validate($rules)) {
                $email = $_POST['email'];
                $username = $_POST['username'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $this->adminModel->store($username, $email, $password);
                session()->setTempdata('success', 'Admin added successfully', 1);
                return redirect()->to('/adminsignin');
            } else {
                $data['validation'] = $this->validator;
                return view('Admin/signup', $data);
            }
        } else {
            return view('Admin/signup');
        }
    }
    public function login()
    {
        $isLoggedIn = $this->session->get('admin');
        if ($isLoggedIn) {
            return redirect()->to('/adminlist');
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
                        return redirect()->to('/');
                    } else {
                        $data['validation'] = 'Please contact the admin for further assistance.';
                        return view('Admin/signin', $data);
                    }
                } else {
                    $data['validation'] = 'Invalid Credentials';
                    return view('Admin/signin', $data);
                }
            } else {
                $data['validation'] = $this->validator;
                return view('Admin/signin', $data);
            }
        } else {
            return view('Admin/signin');
        }
    }
    public function forgotPassword()
    {
        if ($this->request->getMethod() === 'post') {
            $emailAddress = $this->request->getPost('email');
            $otp = $this->request->getPost('otp');
            $password = $this->request->getPost('password');
            $admin = $this->adminModel->where('email', $emailAddress)->first();
            if ($admin) {
                if (empty($otp)) {
                    // Generate OTP and send email
                    $otp = random_int(100000, 999999);
                    $this->adminModel->updateOTP($admin['id'], $otp);
                    $message = "Your OTP is: " . $otp . "\n\n";
                    $message .= "Please use this OTP to reset your password.\n";
                    $message .= "If you did not initiate this request, please disregard this email.\n\n";
                    $message .= "Thank you.\n";
                    $email = \Config\Services::email();
                    $email->setTo($emailAddress);
                    $email->setSubject('Password Reset Request');
                    $email->setMessage($message);
                    $email->send();
                    session()->setFlashdata('success', 'Email sent with OTP. Please check your email.');
                    return view('Admin/set_new_password');
                } else {
                    if ($admin['otp'] == $otp) {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $this->adminModel->update($admin['id'], ['password' => $hashedPassword]);
                        $this->adminModel->updateOTP($admin['id'], null);
                        session()->setFlashdata('success', 'Password has been updated successfully.');
                        return redirect()->to('/adminsignin');
                    } else {
                        session()->setFlashdata('error', 'Invalid OTP. Please try again.');
                        return redirect()->back();
                    }
                }
            } else {
                session()->setFlashdata('error', 'Email not found. Please try again.');
                return redirect()->back();
            }
        } else {
            return view('Admin/forgot_password');
        }
    }
    public function list()
    {
        $data['admin'] = $this->adminModel->list();
        return view('Admin/dashboard', $data);
    }
    public function edit($id = null)
    {
        $model = new AdminModel();
        $data = $model->where('id', $id)->first();
        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }

    public function update()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'username' => 'required|min_length[2]|max_length[50]|is_unique[admin.username]',
                'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[admin.email]',
                'password' => 'required|min_length[4]|max_length[50]'
            ];
            if ($this->validate($rules)) {
                $model = new AdminModel();
                $id = $this->request->getVar('adminId');
                $data = [
                    'username' => $this->request->getVar('username'),
                    'email'  => $this->request->getVar('email'),
                    'password'  => $this->request->getVar('password'),
                ];
                $update = $model->update($id, $data);
                if ($update != false) {
                    $data = $model->where('id', $id)->first();
                    echo json_encode(array("status" => true, 'data' => $data, 'message' => 'Admin record updated successfully'));
                } else {
                    echo json_encode(array("status" => false, 'data' => $data, 'message' => 'Failed to update admin record'));
                }
            } else {
                $data['validation'] = $this->validator;
                echo json_encode(array("status" => false, 'errors' => $this->validator->getErrors()));
            }
        }
    }

    public function delete($id = null)
    {
        $deleted = $this->adminModel->delete($id);

        if ($deleted) {
            $response = ['status' => true, 'message' => 'Admin record deleted successfully'];
        } else {
            $response = ['status' => false, 'message' => 'Failed to delete admin record'];
        }
        return $this->response->setJSON($response);
    }
}
