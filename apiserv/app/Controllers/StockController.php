<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestTrait;
use App\Models\ProductModels;
use CodeIgniter\RESTful\ResourceController;

class StockController extends ResourceController
{
    protected $format = 'json';
    use RequestTrait;

    public function __construct()
    {
        $this->product = new ProductModels;
    }

    public function read()
    {
        return $this->respond($this->product->findAll());
    }

    public function create()
    {
        $dataInsert = [
            'code_product' => $this->request->getPost('code'),
            'name_product' => $this->request->getPost('name'),
            'stock' => $this->request->getPost('stock'),
        ];

        $validation = \Config\Services::validation();

        $validation->setRules([
            'code_product' => 'required',
            'name_product' => 'required',
            'stock' => 'required',
        ]);

        if (!$validation->run($dataInsert)) {
            // handle validation errors
            return $this->respond($validation->getErrors());
        }

        $insert =  $this->product->insert($dataInsert);

        if ($insert) {
            return $this->respond([
                'status' => true,
                'message' => 'Successfully Inserted Product',
                'id_product' => $insert
            ]);
        } else {
            return $this->fail([
                'status' => false,
                'message' => 'Failed to Insert Product'
            ], 400);
        }
    }

    public function update($id_product = null)
    {
        $dataUpdate = $this->request->getRawInput();

        if(count($dataUpdate) == 0){
            return $this->failForbidden('Parameter update minimal 1');
        }

        $update = $this->product->update($id_product, $dataUpdate);

        if($update) {
            return $this->respond([
                'status' => true,
                'message' => 'Successfully Update Product',
            ]);
        }else{
            return $this->fail([
                'status' => false,
                'message' => 'Failed to Update Product'
            ], 400);
        }
    }

    public function delete($id_product = null)
    {
        if(!$this->product->find($id_product)){
            return $this->failForbidden('Incomplete parameters');
        }

        $delete = $this->product->delete(['id_product' => $id_product]);

        if($delete) {
            return $this->respond([
                'status' => true,
                'message' => 'Seccussfully Delete Product',
            ]);
        }else{
            return $this->fail([
                'status' => false,
                'message' => 'Failed to Delete Product'
            ], 400);
        }
    }


}