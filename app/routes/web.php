<?php

session_start();

use App\Classes\Route;
use App\Middlewares\AuthMiddleware;

$router = new Route();

$router->get('/', 'HomeController@index');

$router->get('/login', 'AuthController@login');
$router->post('/authenticate', 'AuthController@authenticate');
$router->get('/logout', 'AuthController@logout');

$router->group(['middleware' => AuthMiddleware::class], function () use ($router) {
    $router->get('/type_products', 'TypeProductsController@index');
    $router->get('/type_products/create', 'TypeProductsController@create');
    $router->post('/type_products/store', 'TypeProductsController@store');
    $router->get('/type_products/edit/:id', 'TypeProductsController@edit');
    $router->post('/type_products/update/:id', 'TypeProductsController@update');
    $router->post('/type_products/delete', 'TypeProductsController@delete');

    $router->get('/products', 'ProductsController@index');
    $router->get('/products/create', 'ProductsController@create');
    $router->post('/products/store', 'ProductsController@store');
    $router->get('/products/edit/:id', 'ProductsController@edit');
    $router->post('/products/update/:id', 'ProductsController@update');
    $router->post('/products/delete', 'ProductsController@delete');

    $router->get('/sales', 'SalesController@index');
    $router->get('/sales/create', 'SalesController@create');
    $router->post('/sales/store', 'SalesController@store');
    $router->get('/sales/edit/:id', 'SalesController@edit');
    $router->post('/sales/update/:id', 'SalesController@update');
    $router->post('/sales/delete', 'SalesController@delete');
});

$router->run();
