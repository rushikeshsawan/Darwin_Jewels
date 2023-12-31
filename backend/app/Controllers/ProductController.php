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

    public function index()
    {
        $data['categories'] = $this->categoryModel->list();
        $data['products'] = $this->productModel->list();
        return view('Product/list', $data);
    }

    public function getProductList()
    {
        $data['products'] = $this->productModel->list();
        return $this->response->setJSON($data);
    }

    public function getProduct($id)
    {
        $product = $this->productModel->find($id);

        if ($product) {
            $data = [
                'success' => true,
                'product' => $product
            ];
        } else {
            $data = [
                'success' => false,
                'message' => 'Product not found'
            ];
        }

        return $this->response->setJSON($data);
    }

    public function saveProduct()
    {
        $productId = $this->request->getPost('productId');
        $productName = $this->request->getPost('product_name');
        $categoryId = $this->request->getPost('category_id');
        $rating = $this->request->getPost('rating');
        $prize = $this->request->getPost('prize');
        $image = $this->request->getFile('image');

        if (empty($productId)) {
            $imageName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads', $imageName);

            $data = [
                'product_name' => $productName,
                'category_id' => $categoryId,
                'rating' => $rating,
                'prize' => $prize,
                'image' => $imageName
            ];

            $this->productModel->insert($data);

            $response = [
                'success' => true,
                'message' => 'Product added successfully.'
            ];
        } else {
            $product = $this->productModel->find($productId);

            if ($product) {
                if (!empty($image->getName())) {
                    $imageName = $image->getRandomName();
                    $image->move(ROOTPATH . 'public/uploads', $imageName);

                    // Delete the old image
                    $oldImage = $product['image'];
                    if ($oldImage && file_exists(ROOTPATH . 'public/uploads/' . $oldImage)) {
                        unlink(ROOTPATH . 'public/uploads/' . $oldImage);
                    }

                    $data = [
                        'product_name' => $productName,
                        'category_id' => $categoryId,
                        'rating' => $rating,
                        'prize' => $prize,
                        'image' => $imageName
                    ];
                } else {
                    $data = [
                        'product_name' => $productName,
                        'category_id' => $categoryId,
                        'rating' => $rating,
                        'prize' => $prize
                    ];
                }

                $this->productModel->update($productId, $data);

                $response = [
                    'success' => true,
                    'message' => 'Product updated successfully.'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Product not found.'
                ];
            }
        }

        return $this->response->setJSON($response);
    }

    public function deleteProduct($id)
    {
        $product = $this->productModel->find($id);

        if ($product) {
            $image = $product['image'];
            if ($image && file_exists(ROOTPATH . 'public/uploads/' . $image)) {
                unlink(ROOTPATH . 'public/uploads/' . $image);
            }

            $this->productModel->delete($id);

            $response = [
                'success' => true,
                'message' => 'Product deleted successfully.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Product not found.'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function rateProduct($productId)
    {
        $rating = $this->request->getPost('rating');
        $product = $this->productModel->find($productId);

        if ($product) {
            $product['rating'] = $rating;
            $this->productModel->update($productId, $product);

            $response = [
                'success' => true,
                'message' => 'Rating stored successfully.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Product not found.'
            ];
        }

        return $this->response->setJSON($response);
    }
    public function saveRating($productId)
    {
        $model = new ProductModel();
        $rating = $this->request->getPost('rating');
        $model->saveRating($productId, $rating);
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Rating saved successfully.'
        ]);
    }
}
