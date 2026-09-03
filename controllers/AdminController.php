<?php

require_once base_path('models/Product.php');
require_once base_path('models/Category.php');

class AdminController
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $initialProductsJson = Product::toJson();

        view('products/index', [
            'products' => $products,
            'categories' => $categories,
            'initialProductsJson' => $initialProductsJson,
            'pageTitle' => 'Verdant Cafe and Lounge Admin'
        ]);
    }
}

$controller = new AdminController();
$controller->index();

