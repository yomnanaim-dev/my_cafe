<?php

require_once base_path('models/Product.php');
require_once base_path('models/Category.php');

$featuredProducts = array_slice(Product::all(), 0, 4);

view('home/index', [
    'featuredProducts' => $featuredProducts,
    'pageTitle' => 'Verdant Café & Lounge'
]);

