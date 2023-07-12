<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\Controller;

class CategoryController extends Controller
{
    protected $CategoryModel;
    public function __construct()
    {
        $this->CategoryModel = new CategoryModel();
    }
    public function store()
    {
        $categoryModel = new CategoryModel();

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'categoryname' => 'required|min_length[2]|max_length[50]',
                'description' => 'required|min_length[2]|max_length[50]',
                'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]'
            ];

            if ($this->validate($rules)) {
                $categoryname = $this->request->getPost('categoryname');
                $description = $this->request->getPost('description');
                $image = $this->request->getFile('image');
                $imageName = $image->getRandomName();
                $image->move('./uploads', $imageName);

                $categoryModel->insert([
                    'categoryname' => $categoryname,
                    'description' => $description,
                    'image' => $imageName
                ]);

                session()->setFlashdata('success', 'Category added successfully');
                return redirect()->to('/categorylist');
            } else {
                $data['validation'] = $this->validator;
                echo view('category/add', $data);
            }
        } else {
            return view('category/add');
        }
    }

    public function index()
    {
        $data['Category'] = $this->CategoryModel->list();
        echo view('Category/list', $data);
    }


    public function edit($id = null)
    {
        $model = new CategoryModel();
        $data = $model->where('id', $id)->first();
        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }

    public function update($id = null)
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'categoryname' => 'required|min_length[2]|max_length[50]'
            ];

            if ($this->validate($rules)) {
                $id = $this->request->getPost('id');
                $categoryname = $this->request->getPost('categoryname');
                $image = $this->request->getFile('image');
                $description = $this->request->getFile('description');
                $star = $this->request->getFile('star');

                if ($image->isValid() && !$image->hasMoved()) {
                    $imageName = $image->getRandomName();
                    $image->move('./uploads', $imageName);
                    $this->CategoryModel->Uupdate($id, $categoryname, $imageName,$description,$star);
                    session()->setTempdata('success', 'Category update successfully', 1);
                    return redirect()->to('/categorylist');
                }
            } else {
                $data['validation'] = $this->validator;
                $data['Category'] = $this->CategoryModel->getUser($id);
                return view('Category/edit', $data);
            }
        } else {
            $data['Category'] = $this->CategoryModel->getUser($id);
            return view('Category/edit', $data);
        }
    }
    public function delete($id = null)
    {
        $deleted = $this->CategoryModel->delete($id);

        if ($deleted) {
            $response = ['status' => true, 'message' => 'Admin record deleted successfully'];
        } else {
            $response = ['status' => false, 'message' => 'Failed to delete admin record'];
        }
        return $this->response->setJSON($response);
    }
}
