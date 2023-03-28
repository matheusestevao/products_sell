<?php

namespace App\Controllers;

class ProductsController extends Controller
{
    public function index()
    {
        $products = $this->db->read('products');
        
        return $this->view('products/index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $typeProducts = $this->db->read('type_products');

        return $this->view('products/form', [
            'typeProducts' => $typeProducts
        ]);
    }

    public function store()
    {
        if(empty($_POST['name']) || empty($_POST['value']) || empty($_POST['type_product_id'])) {
            header('Location: /products/create');
        }

        try {
            $data = [
                'name' => $_POST['name'],
                'value' => $_POST['value'] * 100,
                'type_product_id' => $_POST['type_product_id']
            ];

            $this->db->create('products', $data);

            header('Location: /products');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function edit($id)
    {
        $product = $this->db->read('products', ['id = ? '], [$id]);
        $typeProducts = $this->db->read('type_products');
        
        return $this->view('products/form', [
            'product' => $product[0],
            'typeProducts' => $typeProducts
        ]);
    }

    public function update($id)
    {
        try {
            $data = [
                'name' => $_POST['name'],
                'tax' => $_POST['tax'] * 100
            ];

            $this->db->update('type_products', $data, $id);

            header('Location: /type_products');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
