<?php

namespace App\Controllers;

class SalesController extends Controller
{
    public function index()
    {
        $sales = $this->db->read('sales');
        
        return $this->view('sales/index', [
            'sales' => $sales
        ]);
    }

    public function create()
    {
        $products = $this->db->read('products');

        return $this->view('sales/create', [
            'products' => $products
        ]);
    }

    public function store()
    {
        try {
            $data = [
                'total' => $_POST['total'] * 100,
                'total_tax' => $_POST['total_tax'] * 100,
                'created_at' => date('Y-m-d H:i:s')
            ];
    
            $sale = $this->db->create('sales', $data);

            unset($_POST['insertSaleProduct_idComponent']['X']);

            foreach ($_POST['insertSaleProduct_idComponent'] as $key => $value) {
                $product = [
                    'sale_id' => $sale,
                    'product_id' => $_POST['insertSaleProduct_product_id'][$key],
                    'amount' => $_POST['insertSaleProduct_amount'][$key],
                    'value_amount' => $_POST['insertSaleProduct_value_amount'][$key] * 100,
                    'value_amount_tax' => $_POST['insertSaleProduct_value_amount_tax'][$key] * 100
                ];

                $this->db->create('sale_products', $product);
            }

            header('Location: /sales');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function show($id)
    {
        $hash = password_hash('123', PASSWORD_DEFAULT);
        var_dump($hash);exit;
        
        $sale = $this->db->read('sales', ['id = ? '], [$id]);
        $products = $this->db->read('sale_products', ['sale_id = ?'], [$id]);

        return $this->view('sales/view', [
            'sale' => $sale[0],
            'products' => $products
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