<?php

namespace App\Controllers;

use App\Models\AdminModel;
<<<<<<< HEAD
=======
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\OrderDetailModel;
use App\Models\SliderModel;
use CodeIgniter\Email\Email;
>>>>>>> 29f8a3b4fa91203b78951bc36a687aad21b112b9

class AdminController extends BaseController
{
    protected $adminModel;
<<<<<<< HEAD
=======
    protected $productModel;
    protected $categoryModel;
    protected $orderModel;
    protected $sliderModel;
>>>>>>> 29f8a3b4fa91203b78951bc36a687aad21b112b9
    protected $session;
    public function __construct()
    {
        $this->adminModel = new AdminModel();
<<<<<<< HEAD
        $this->session = \Config\Services::session();
    }
    // public function index()
    // {
    //     echo view('Admin/signup');
    // }
=======
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->orderModel = new OrderDetailModel();
        $this->sliderModel = new SliderModel();
        $this->session = \Config\Services::session();
    }
>>>>>>> 29f8a3b4fa91203b78951bc36a687aad21b112b9
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
<<<<<<< HEAD
            return redirect()->to('/adminlist');
=======
            return redirect()->to('/dashboard');
>>>>>>> 29f8a3b4fa91203b78951bc36a687aad21b112b9
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
<<<<<<< HEAD
                        return redirect()->to('/');
=======
                        return redirect()->to('/dashboard');
>>>>>>> 29f8a3b4fa91203b78951bc36a687aad21b112b9
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
<<<<<<< HEAD
=======
        $email = \Config\Services::email(); // Load the email service

>>>>>>> 29f8a3b4fa91203b78951bc36a687aad21b112b9
        if ($this->request->getMethod() === 'post') {
            $emailAddress = $this->request->getPost('email');
            $otp = $this->request->getPost('otp');
            $password = $this->request->getPost('password');
            $admin = $this->adminModel->where('email', $emailAddress)->first();
<<<<<<< HEAD
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
=======

            if ($admin) {
                if (empty($otp)) {
                    $otp = random_int(100000, 999999);
                    $this->adminModel->updateOTP($admin['id'], $otp);

                    $message = "Your OTP is: " . $otp . "\n\n";
                    $message .= "Thank you.";
                    $email->setTo($emailAddress);
                    $email->setFrom('vishal.naik@darwinpgc.com', 'Password Reset Request');
>>>>>>> 29f8a3b4fa91203b78951bc36a687aad21b112b9
                    $email->setSubject('Password Reset Request');
                    $email->setMessage($message);
                    $email->send();
                    session()->setFlashdata('success', 'Email sent with OTP. Please check your email.');
<<<<<<< HEAD
                    // return redirect()->to('setnewpassword');
=======
>>>>>>> 29f8a3b4fa91203b78951bc36a687aad21b112b9
                    return view('Admin/set_new_password');
                } else {
                    if ($admin['otp'] == $otp) {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $this->adminModel->update($admin['id'], ['password' => $hashedPassword]);
                        $this->adminModel->updateOTP($admin['id'], null);
<<<<<<< HEAD
=======

>>>>>>> 29f8a3b4fa91203b78951bc36a687aad21b112b9
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
<<<<<<< HEAD
=======


>>>>>>> 29f8a3b4fa91203b78951bc36a687aad21b112b9
    public function list()
    {
        $data['admin'] = $this->adminModel->list();
        return view('Admin/dashboard', $data);
<<<<<<< HEAD
    } 
=======
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
                'username' => 'required|min_length[2]|max_length[50]|is_unique[admin.username,id,' . $this->request->getVar('adminId') . ']',
                'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[admin.email,id,' . $this->request->getVar('adminId') . ']'
            ];

            if ($this->validate($rules)) {
                $model = new AdminModel();
                $id = $this->request->getVar('adminId');
                $data = [
                    'username' => $this->request->getVar('username'),
                    'email'  => $this->request->getVar('email'),
                ];

                $update = $model->update($id, $data);

                if ($update != false) {
                    $updatedAdmin = $model->find($id);
                    echo json_encode(array("status" => true, 'data' => $updatedAdmin, 'message' => 'Admin record updated successfully'));
                } else {
                    echo json_encode(array("status" => false, 'message' => 'Failed to update admin record'));
                }
            } else {
                $data['validation'] = $this->validator;
                echo json_encode(array("status" => false, 'errors' => $this->validator->getErrors()));
            }
        }
    }
    public function changePassword()
    {
        if ($this->request->getMethod() === 'post') {
            $currentPassword = $this->request->getPost('current_password');
            $newPassword = $this->request->getPost('new_password');
            $confirmPassword = $this->request->getPost('confirm_password');
            $adminId = $this->request->getPost('adminId');
            $admin = $this->adminModel->find($adminId);

            if ($admin && password_verify($currentPassword, $admin['password'])) {
                if ($newPassword === $confirmPassword) {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $updateData = ['password' => $hashedPassword];

                    $updated = $this->adminModel->update($adminId, $updateData);

                    if ($updated) {
                        return $this->response->setJSON(['status' => true, 'message' => 'Password has been updated successfully.']);
                    } else {
                        return $this->response->setJSON(['status' => false, 'message' => 'Failed to update password.']);
                    }
                } else {
                    return $this->response->setJSON(['status' => false, 'message' => 'New password and confirm password do not match.']);
                }
            } else {
                return $this->response->setJSON(['status' => false, 'message' => 'Incorrect current password.']);
            }
        } else {
            return $this->response->setJSON(['status' => false, 'message' => 'Invalid request method.']);
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
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/adminsignin');
    }
    public function slider()
    {
        $data['slider'] = $this->sliderModel->list();
        return view('Admin/slider', $data);
    }
    public function sliderStore()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'main_heading' => 'required|min_length[2]|max_length[50]',
                'sub_heading' => 'required|min_length[2]',
                'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]'
            ];
            if ($this->validate($rules)) {
                $main_heading = $this->request->getPost('main_heading');
                $sub_heading = $this->request->getPost('sub_heading');
                $image = $this->request->getFile('image');
                $imageName = $image->getRandomName();
                $image->move('./banner/', $imageName);

                $slider = [
                    'main_heading' => $main_heading,
                    'sub_heading' => $sub_heading,
                    'image' => $imageName
                ];

                $this->sliderModel->insert($slider);
                $newlyInsertedId = $this->sliderModel->insertID();
                return $this->response->setJSON([
                    'status' => true,
                    'message' => 'Slider added successfully',
                    'data' => [
                        'id' => $newlyInsertedId,
                        'main_heading' => $main_heading,
                        'sub_heading' => $sub_heading,
                        'image' => $imageName
                    ]
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $this->validator->getErrors()
                ]);
            }
        }
    }

    public function sliderEdit($id = null)
    {
        $model = new SliderModel();
        $data = $model->where('id', $id)->first();
        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }

    public function sliderUpdate()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'id' => 'required',
                'main_heading' => 'required|min_length[2]|max_length[50]',
                'sub_heading' => 'required|min_length[2]|max_length[50]',
                'image' => 'max_size[image,1024]|is_image[image]'
            ];

            if ($this->validate($rules)) {
                $id = $this->request->getPost('id');
                $main_heading = $this->request->getPost('main_heading');
                $sub_heading = $this->request->getPost('sub_heading');
                $image = $this->request->getFile('image');

                if ($image->isValid() && !$image->hasMoved()) {
                    $imageName = $image->getRandomName();
                    $image->move('./banner', $imageName);
                } else {
                    $imageName = $this->sliderModel->getSliderImage($id); // Retrieve the existing image name if no new image is uploaded
                }

                $this->sliderModel->updateSlider($id, $main_heading, $sub_heading, $imageName);

                return $this->response->setJSON([
                    'status' => true,
                    'message' => 'Slider updated successfully'
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $this->validator->getErrors()
                ]);
            }
        }
    }
    public function sliderDelete($id = null)
    {
        $deleted = $this->sliderModel->delete($id);

        if ($deleted) {
            $response = ['status' => true, 'message' => 'Category record deleted successfully'];
        } else {
            $response = ['status' => false, 'message' => 'Failed to delete category record'];
        }
        return $this->response->setJSON($response);
    }
    public function initChart()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('order_details');

        $query = $builder->select("COUNT(DISTINCT order_id) as count, DAY(created_at) as day, MONTH(created_at) as month");
        $query = $builder->groupBy('DAY(created_at), MONTH(created_at)')->get();
        $record = $query->getResult();

        $orders = [];
        foreach ($record as $row) {
            $orders[] = [
                'day'   => intval($row->day),
                'month' => intval($row->month),
                'count' => intval($row->count)
            ];
        }

        $data['orders'] = $orders;

        return view('dashboard', $data);
    }



    public function dashboard()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('order_details');

        // Retrieve unique order count data
        $query = $builder->select("COUNT(DISTINCT order_id) as count, DAY(created_at) as day, MONTH(created_at) as month");
        $query = $builder->groupBy('DAY(created_at), MONTH(created_at)')->get();
        $record = $query->getResult();

        $orders = [];
        foreach ($record as $row) {
            $orders[] = [
                'day'   => intval($row->day),
                'month' => intval($row->month),
                'count' => intval($row->count)
            ];
        }

        $data['orders'] = $orders;

        $addedProductsCount = $this->productModel->getAddedProductsCountLast7Days();
        $totalProductsCount = $this->productModel->getTotalProductsCount();
        $productPercentage = ($addedProductsCount / $totalProductsCount) * 100;
        $productCount = $this->productModel->getTotalProductsCount();


        $addedAdminsCount = $this->adminModel->getAddedAdminsCountLast7Days();
        $totalAdminsCount = $this->adminModel->getTotalAdminsCount();
        $AdminsPercentage = ($addedAdminsCount / $totalAdminsCount) * 100;

        $adminCount = $this->adminModel->getTotalAdminsCount();
        $categoryCount = $this->categoryModel->getTotalCategoriesCount();
        $categoryPercentage = ($categoryCount / $totalProductsCount) * 100;

        $orderCount = $this->orderModel->getTotalOrderCount();
        $countUniqueShippedOrders = $this->orderModel->countUniqueShippedOrders();
        $countUniqueCanceledOrders = $this->orderModel->countUniqueCanceledOrders();
        $countUniqueDeliveredOrders = $this->orderModel->countUniqueDeliveredOrders();
        $countUniqueAcceptedOrders = $this->orderModel->countUniqueAcceptedOrders();

        // Pass all data to the view
        $data['productCount'] = $productCount;
        $data['productPercentage'] = $productPercentage;
        $data['totalAdminsCount'] = $totalAdminsCount;
        $data['AdminsPercentage'] = $AdminsPercentage;
        $data['categoryCount'] = $categoryCount;
        $data['categoryPercentage'] = $categoryPercentage;
        $data['orderCount'] = $orderCount;
        $data['countUniqueShippedOrders'] = $countUniqueShippedOrders;
        $data['countUniqueCanceledOrders'] = $countUniqueCanceledOrders;
        $data['countUniqueDeliveredOrders'] = $countUniqueDeliveredOrders;
        $data['countUniqueAcceptedOrders'] = $countUniqueAcceptedOrders;

        return view('dashboard', $data);
    }
>>>>>>> 29f8a3b4fa91203b78951bc36a687aad21b112b9
}
