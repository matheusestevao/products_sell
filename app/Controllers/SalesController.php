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
        return $this->view('sales/create');
    }

    public function store()
    {
        try {
            $data = [
                'name' => $_POST['name'],
                'tax' => $_POST['tax'] * 100
            ];

            $this->db->create('type_products', $data);

            header('Location: /type_products');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function edit($id)
    {
        $typeProduct = $this->db->read('type_products', ['id = ? '], [$id]);
        
        return $this->view('type_products/form', [
            'typeProduct' => $typeProduct[0]
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