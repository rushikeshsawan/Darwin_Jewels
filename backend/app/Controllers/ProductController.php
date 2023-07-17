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
    // public function store()
    // {
    //     if ($this->request->getMethod() == 'post') {
    //         $rules = [
    //             'product_name' => 'required|min_length[2]|max_length[50]',
    //             'category_id' => 'required',
    //             'description' => 'required|min_length[4]|max_length[50]',
    //             'prize' => 'required|min_length[1]|max_length[50]',
    //             'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]'
    //         ];

    //         if ($this->validate($rules)) {
    //             $product_name = $this->request->getPost('product_name');
    //             $category_id = $this->request->getPost('category_id');
    //             $description = $this->request->getPost('description');
    //             $prize = $this->request->getPost('prize');
    //             $image = $this->request->getFile('image');
    //             $productModel = new ProductModel();
    //             $inserted = $productModel->store($product_name, $category_id, $description, $prize, $image);
    //             if ($inserted) {
    //                 $product = $productModel->find($inserted);
    //                 $response = [
    //                     'status' => true,
    //                     'message' => 'Product added successfully',
    //                     'data' => $product
    //                 ];
    //             } else {
    //                 $response = [
    //                     'status' => false,
    //                     'message' => 'Failed to add product'
    //                 ];
    //             }
    //         } else {
    //             $response = [
    //                 'status' => false,
    //                 'message' => 'Validation failed',
    //                 'errors' => $this->validator->getErrors()
    //             ];
    //         }
    //     } else {
    //         $response = [
    //             'status' => false,
    //             'message' => 'Invalid request method'
    //         ];
    //     }

    //     return $this->response->setJSON($response);
    // } 

    // public function store()
    // {
    //     if ($this->request->getMethod() === 'post') {
    //         $rules = [
    //             'product_name' => 'required|min_length[2]|max_length[50]',
    //             'category_id' => 'required',
    //             'description' => 'required|min_length[4]|max_length[50]',
    //             'prize' => 'required|min_length[1]|max_length[50]',
    //             'image' => 'uploaded[image]|max_size[image,2048]|is_image[image]'
    //         ];

    //         if ($this->validate($rules)) {
    //             $product_name = $this->request->getPost('product_name');
    //             $category_id = $this->request->getPost('category_id');
    //             $description = $this->request->getPost('description');
    //             $prize = $this->request->getPost('prize');
    //             $image = $this->request->getFile('image');
    //             $imageName = $image->getRandomName();
    //             $image->move('./uploads', $imageName);

    //             $productModel = new ProductModel();

    //             $data = [
    //                 'product_name' => $product_name,
    //                 'category_id' => $category_id,
    //                 'description' => $description,
    //                 'prize' => $prize,
    //                 'image' => $imageName
    //             ];

    //             $productModel->insert($data);

    //             return $this->response->setJSON([
    //                 'status' => true,
    //                 'message' => 'Product added successfully',
    //                 'data' => $data
    //             ]);
    //         } else {
    //             return $this->response->setJSON([
    //                 'status' => false,
    //                 'message' => 'Validation failed',
    //                 'errors' => $this->validator->getErrors()
    //             ]);
    //         }
    //     }
    // }



    // public function list()
    // {
    //     $data['categories'] = $this->categoryModel->list();
    //     $data['product'] = $this->productModel->list();
    //     return view('Product/list', $data);
    // }
    // public function edit($id = null)
    // {
    //     $model = new ProductModel();
    //     $data = $model->where('id', $id)->first();
    //     if ($data) {
    //         echo json_encode(array("status" => true, 'data' => $data));
    //     } else {
    //         echo json_encode(array("status" => false));
    //     }
    // }
    // // public function update()
    // // {
    // //     if ($this->request->getMethod() === 'post') {
    // //         $rules = [
    // //             'product_name' => 'required|min_length[2]|max_length[50]',
    // //             'category_id' => 'required',
    // //             'description' => 'required|min_length[4]|max_length[50]',
    // //             'prize' => 'required|min_length[1]|max_length[50]',
    // //             'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]'
    // //         ]; 
    // //         if ($this->validate($rules)) {
    // //             $model = new ProductModel();
    // //             $id = $this->request->getVar('id');
    // //             $image = $this->request->getFile('image'); 
    // //             // Check if a new image was uploaded
    // //             if ($image->isValid() && !$image->hasMoved()) {
    // //                 $newImageName = $image->getRandomName();
    // //                 $image->move('./uploads', $newImageName);

    // //                 // Update the image field in the data array
    // //                 $data = [
    // //                     'product_name' => $this->request->getVar('product_name'),
    // //                     'category_id' => $this->request->getVar('category_id'),
    // //                     'description' => $this->request->getVar('description'),
    // //                     'prize' => $this->request->getVar('prize'),
    // //                     'image' => $newImageName
    // //                 ];
    // //             } else {
    // //                 // No new image uploaded, update other fields only
    // //                 $data = [
    // //                     'product_name' => $this->request->getVar('product_name'),
    // //                     'category_id' => $this->request->getVar('category_id'),
    // //                     'description' => $this->request->getVar('description'),
    // //                     'prize' => $this->request->getVar('prize')
    // //                 ];
    // //             }

    // //             $update = $model->update($id, $data);

    // //             if ($update) {
    // //                 $product = $model->find($id);
    // //                 echo json_encode(array("status" => true, 'data' => $product, 'redirect' => site_url('productlist'), 'message' => 'Product record updated successfully'));
    // //             } else {
    // //                 echo json_encode(array("status" => false, 'message' => 'Failed to update product record'));
    // //             }
    // //         } else {
    // //             echo json_encode(array("status" => false, 'errors' => $this->validator->getErrors()));
    // //         }
    // //     }
    // // }

    // public function update()
    // {
    //     $productModel = new ProductModel();
    //     if ($this->request->getMethod() === 'post') {
    //         $rules = [
    //             'product_name' => 'required|min_length[2]|max_length[50]',
    //             'category_id' => 'required',
    //             'description' => 'required|min_length[4]|max_length[50]',
    //             'prize' => 'required|min_length[1]|max_length[50]'
    //         ];

    //         // Validate the form data
    //         if ($this->validate($rules)) {
    //             $id = $this->request->getPost('id');
    //             $product_name = $this->request->getPost('product_name');
    //             $category_id = $this->request->getPost('category_id');
    //             $description = $this->request->getPost('description');
    //             $prize = $this->request->getPost('prize');
    //             $image = $this->request->getFile('image');

    //             // If a new image is uploaded, move it to the uploads directory
    //             if ($image->isValid() && !$image->hasMoved()) {
    //                 $imageName = $image->getRandomName();
    //                 $image->move('./uploads', $imageName);
    //             } else {
    //                 $imageName = $productModel->getCategoryImage($id); // Retrieve the existing image name if no new image is uploaded
    //             }

    //             // Update the product record
    //             $productModel->update($id, [
    //                 'product_name' => $product_name,
    //                 'category_id' => $category_id,
    //                 'description' => $description,
    //                 'prize' => $prize,
    //                 'image' => $imageName
    //             ]);

    //             // Return a JSON response indicating success
    //             return $this->response->setJSON([
    //                 'status' => true,
    //                 'message' => 'Product updated successfully',
    //                 'data' => [
    //                     'id' => $id,
    //                     'product_name' => $product_name,
    //                     'category_id' => $category_id,
    //                     'description' => $description,
    //                     'prize' => $prize,
    //                     'image' => $imageName
    //                 ]
    //             ]);
    //         } else {
    //             // Return a JSON response indicating validation failure and the error messages
    //             return $this->response->setJSON([
    //                 'status' => false,
    //                 'message' => 'Validation failed',
    //                 'errors' => $this->validator->getErrors()
    //             ]);
    //         }
    //     }
    // }




    // public function delete($id = null)
    // {
    //     $deleted = $this->productModel->delete($id);

    //     if ($deleted) {
    //         $response = ['status' => true, 'message' => 'Product deleted successfully'];
    //     } else {
    //         $response = ['status' => false, 'message' => 'Failed to delete product record'];
    //     }

    //     return $this->response->setJSON($response);
    // }
    // public function storeRating()
    // {
    //     $productId = $this->request->getPost('product_id');
    //     $rating = $this->request->getPost('rating');

    //     $productModel = new ProductModel();
    //     $product = $productModel->find($productId);

    //     if ($product) {
    //         $product->rating = $rating;
    //         $productModel->save($product);

    //         return $this->response->setJSON([
    //             'status' => true,
    //             'message' => 'Rating stored successfully'
    //         ]);
    //     } else {
    //         return $this->response->setJSON([
    //             'status' => false,
    //             'message' => 'Product not found'
    //         ]);
    //     }
    // }


    // {
    //     return view('product/list');
    // }
    public function index()
    {
        $data['categories'] = $this->categoryModel->list();
        $data['product'] = $this->productModel->list();
        return view('Product/list', $data);
        // return view('Product/list');
    }
    public function getProductList()
    {
        $data['products'] = $this->productModel->list();   
        return $this->response->setJSON($data);
    }

    public function getProduct($id)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);

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
        $productModel = new ProductModel();
    
        // Define validation rules
        $validationRules = [
            'product_name' => 'required',
            'category_id' => 'required',
            'star' => 'required|numeric',
            'prize' => 'required|numeric',
            'image' => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,2048]'
        ];
    
        // Apply validation rules
        if (!$this->validate($validationRules)) {
            $response = [
                'success' => false,
                'message' => $this->validator->getErrors()
            ];
            return $this->response->setJSON($response);
        }
    
        // Retrieve form data
        $productId = $this->request->getPost('productId');
        $productName = $this->request->getPost('product_name');
        $categoryId = $this->request->getPost('category_id');
        $star = $this->request->getPost('star');
        $prize = $this->request->getPost('prize');
        $image = $this->request->getFile('image');
    
        // Check if it's a new product or an existing product
        if (empty($productId)) {
            // New product
            $imageName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads', $imageName);
    
            $data = [
                'product_name' => $productName,
                'category_id' => $categoryId,
                'star' => $star,
                'prize' => $prize,
                'image' => $imageName
            ];
    
            $productModel->insert($data);
    
            $response = [
                'success' => true,
                'message' => 'Product added successfully.'
            ];
        } else {
            // Existing product
            $product = $productModel->find($productId);
    
            if ($product) {
                // Check if a new image is uploaded
                if (!empty($image->getName())) {
                    $imageName = $image->getRandomName();
                    $image->move(ROOTPATH . 'public/uploads', $imageName);
    
                    // Delete the old image
                    unlink(ROOTPATH . 'public/uploads/' . $product['image']);
    
                    $data = [
                        'product_name' => $productName,
                        'category_id' => $categoryId,
                        'star' => $star,
                        'prize' => $prize,
                        'image' => $imageName
                    ];
                } else {
                    // Keep the existing image
                    $data = [
                        'product_name' => $productName,
                        'category_id' => $categoryId,
                        'star' => $star,
                        'prize' => $prize
                    ];
                }
    
                $productModel->update($productId, $data);
    
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
        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if ($product) {
            // Delete the image file
            $imagePath = ROOTPATH . 'public/uploads/' . $product['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $productModel->delete($id);

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
}
