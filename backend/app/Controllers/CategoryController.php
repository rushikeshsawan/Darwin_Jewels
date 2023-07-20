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
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'categoryname' => 'required|min_length[2]|max_length[50]',
                'description' => 'required|min_length[2]',
                'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]'
            ];

            if ($this->validate($rules)) {
                $categoryname = $this->request->getPost('categoryname');
                $description = $this->request->getPost('description');
                $image = $this->request->getFile('image');
                $imageName = $image->getRandomName();
                $image->move('./uploads', $imageName);

                $category = [
                    'categoryname' => $categoryname,
                    'description' => $description,
                    'image' => $imageName
                ];

                $this->CategoryModel->insert($category);

                return $this->response->setJSON([
                    'status' => true,
                    'message' => 'Category added successfully',
                    'data' => $category
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

    public function update()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'id' => 'required',
                'categoryname' => 'required|min_length[2]|max_length[50]',
                'description' => 'required|min_length[2]|max_length[50]',
                'image' => 'max_size[image,1024]|is_image[image]'
            ];

            if ($this->validate($rules)) {
                $id = $this->request->getPost('id');
                $categoryname = $this->request->getPost('categoryname');
                $description = $this->request->getPost('description');
                $image = $this->request->getFile('image');

                if ($image->isValid() && !$image->hasMoved()) {
                    $imageName = $image->getRandomName();
                    $image->move('./uploads', $imageName);
                } else {
                    $imageName = $this->CategoryModel->getCategoryImage($id); // Retrieve the existing image name if no new image is uploaded
                }

                $this->CategoryModel->updateCategory($id, $categoryname, $description, $imageName);

                // Return a JSON response indicating success
                return $this->response->setJSON([
                    'status' => true,
                    'message' => 'Category updated successfully'
                ]);
            } else {
                // Return a JSON response indicating validation failure and provide error messages
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $this->validator->getErrors()
                ]);
            }
        }
    }
    public function delete($id = null)
    {
        $deleted = $this->CategoryModel->delete($id);

        if ($deleted) {
            $response = ['status' => true, 'message' => 'Category record deleted successfully'];
        } else {
            $response = ['status' => false, 'message' => 'Failed to delete category record'];
        }
        return $this->response->setJSON($response);
    }
    public function updateRating()
    {
        $category_id = $this->request->getPost('category_id');
        $rating = $this->request->getPost('rating'); 
        $model = new CategoryModel();
        $model->updateRating($category_id, $rating);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Rating updated successfully'
        ]);
    }
}
