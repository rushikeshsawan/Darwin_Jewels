<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class ProductController extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $session;
    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->session = \Config\Services::session();
    }
    public function store()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'product_name' => 'required|min_length[2]|max_length[50]',
                'category_id' => 'required',
                'description' => 'required|min_length[4]|max_length[50]'
            ];
            if ($this->validate($rules)) {
                $product_name = $_POST['product_name'];
                $category_id = $_POST['category_id'];
                $description = $_POST['description'];
                $this->productModel->store($product_name, $category_id, $description);
                session()->setTempdata('success', 'Admin added successfully', 1);
                return redirect()->to('/productlist');
            } else {
                $data['validation'] = $this->validator;
                return redirect()->to('/productlist');
            }
        } else {
            return redirect()->to('/productlist');
        }
    }
    public function list()
    {
        $data['categories'] = $this->categoryModel->list();
        $data['product'] = $this->productModel->list();
        return view('Product/list', $data);
    }
    public function edit($id = null)
    {
        $model = new ProductModel();
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
                'product_name' => 'required|min_length[2]|max_length[50]',
                'category_id' => 'required',
                'description' => 'required|min_length[4]|max_length[50]'
            ];
    
            if ($this->validate($rules)) {
                $model = new ProductModel();
                $id = $this->request->getVar('id');
                $data = [
                    'product_name' => $this->request->getVar('product_name'),
                    'category_id'  => $this->request->getVar('category_id'),
                    'description'  => $this->request->getVar('description'),
                ];
    
                $update = $model->update($id, $data);
    
                if ($update) {
                    $product = $model->find($id);
                    echo json_encode(array("status" => true, 'data' => $product, 'message' => 'Product record updated successfully'));
                } else {
                    echo json_encode(array("status" => false, 'message' => 'Failed to update product record'));
                }
            } else {
                echo json_encode(array("status" => false, 'errors' => $this->validator->getErrors()));
            }
        }
    }
    
    
    

  




    public function delete($id = null)
    {
        $deleted = $this->productModel->delete($id);

        if ($deleted) {
            $response = ['status' => true, 'message' => 'Product deleted successfully'];
        } else {
            $response = ['status' => false, 'message' => 'Failed to delete product record'];
        }
        return $this->response->setJSON($response);
    }
}
