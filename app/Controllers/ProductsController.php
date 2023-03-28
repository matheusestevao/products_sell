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
                'value' => $_POST['value'] * 100
            ];

            $this->db->update('products', $data, $id);

            header('Location: /products');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function infoSale()
    {
        try {
            $product = $this->db->read('products', ['id = ?'], [$_POST['product']])[0];
            $typeProduct = $this->db->read('type_products', ['id = ? '], [$product['type_product_id']])[0];

            $valueTax = ($product['value'] * (1 + ($typeProduct['tax'] / 100) / 100));
            
            $valueTotal = $_POST['amount'] * $product['value'];
            $valueTotalTax = $_POST['amount'] * $valueTax;

            http_response_code(200);
            header('Content-Type: application/json');

            echo json_encode([
                'value_amount' => $product['value'] / 100,
                'value_tax' => $valueTax / 100,
                'value_total' => $valueTotal / 100,
                'value_total_tax' => $valueTotalTax / 100
            ]);
        } catch (\Throwable $th) {
            http_response_code(404);
            header('Content-Type: application/json');

            echo json_encode(['message' => $th->getMessage()]);
        }
    }
}
