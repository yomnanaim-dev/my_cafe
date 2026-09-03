<?php

require_once base_path('models/Product.php');
require_once base_path('models/Category.php');

class ProductController
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
            'pageTitle' => 'Menu Items Management - Verdant Cafe and Lounge'
        ]);
    }

    public function details($id)
    {
        $product = Product::find($id);
        if (!$product) {
            abort(404);
        }

        view('products/details', [
            'product' => $product,
            'pageTitle' => $product['name'] . ' - Verdant Cafe and Lounge'
        ]);
    }
}

$controller = new ProductController();
$controller->index();

