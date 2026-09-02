<?php

class ProductController
{
    public function index()
    {
        global $conn;

        $productModel = new Product($conn);

        $products = $productModel->getAllProducts();

        require __DIR__ . '/../views/products/index.php';
    }

    public function details()
    {
        global $conn;

        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "Product not found";
            return;
        }

        $productModel = new Product($conn);

        $product = $productModel->getProductById($id);

        require __DIR__ . '/../views/products/details.php';
    }
}