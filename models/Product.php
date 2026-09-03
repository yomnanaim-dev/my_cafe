<?php

require_once __DIR__ . '/Category.php';

if (!class_exists('Product')) {
    class Product
    {
        private static $defaultProducts = [
            [
                'id' => 1,
                'name' => 'Botanical Matcha Latte',
                'category' => 'Beverage',
                'price' => 8.50,
                'active' => true,
                'size' => 'Regular',
                'image' => 'https://images.unsplash.com/photo-1536256263959-770b48d82b0a?w=400&h=300&fit=crop',
                'description' => 'Ceremonial grade Uji matcha with steamed oat milk and vanilla botanical syrup.'
            ],
            [
                'id' => 2,
                'name' => 'Rosewater Velvet Cake',
                'category' => 'Pastry',
                'price' => 12.00,
                'active' => true,
                'size' => 'Slice',
                'image' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400&h=300&fit=crop',
                'description' => 'Delicate layers with infused Persian rosewater and velvety mascarpone cream.'
            ],
            [
                'id' => 3,
                'name' => 'Truffle Infused Croissant',
                'category' => 'Savory',
                'price' => 9.50,
                'active' => false,
                'size' => 'Regular',
                'image' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=400&h=300&fit=crop',
                'description' => 'Flaky French butter pastry layered with black summer truffle butter.'
            ],
            [
                'id' => 4,
                'name' => 'Avocado Toast',
                'category' => 'Breakfast',
                'price' => 12.50,
                'active' => true,
                'size' => 'Full',
                'image' => 'https://images.unsplash.com/photo-1541519227354-08fa5d50c44d?w=400&h=300&fit=crop',
                'description' => 'Artisanal sourdough topped with crushed Hass avocado, radish ribbons, and chili oil.'
            ],
            [
                'id' => 5,
                'name' => 'Cold Brew',
                'category' => 'Beverage',
                'price' => 5.00,
                'active' => true,
                'size' => 'Regular',
                'image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=400&h=300&fit=crop',
                'description' => 'Slow-steeped for 20 hours using single-origin Ethiopian beans with chocolate notes.'
            ],
            [
                'id' => 6,
                'name' => 'Quinoa Bowl',
                'category' => 'Lunch',
                'price' => 14.00,
                'active' => false,
                'size' => 'Full',
                'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=400&h=300&fit=crop',
                'description' => 'Organic tri-color quinoa, roasted heirloom roots, baby kale, and green goddess dressing.'
            ],
            [
                'id' => 7,
                'name' => 'Smoked Salmon Tartine',
                'category' => 'Breakfast',
                'price' => 24.00,
                'active' => true,
                'size' => 'Full',
                'image' => 'https://images.unsplash.com/photo-1541014741259-de529411b96a?w=400&h=300&fit=crop',
                'description' => 'House-cured wild salmon on seeded rye with dill cream cheese and caper berries.'
            ],
            [
                'id' => 8,
                'name' => 'Lavender Earl Grey',
                'category' => 'Beverage',
                'price' => 7.00,
                'active' => true,
                'size' => 'Regular',
                'image' => 'https://images.unsplash.com/photo-1594631252845-29fc4cc8cde9?w=400&h=300&fit=crop',
                'description' => 'Fragrant bergamot black tea infused with French culinary lavender blossoms.'
            ],
        ];

        private static function initSession()
        {
            if (session_status() === PHP_SESSION_NONE) {
                @session_start();
            }
            if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
                $_SESSION['products'] = self::$defaultProducts;
            }
        }

        public static function all()
        {
            self::initSession();
            return $_SESSION['products'];
        }

        public static function active()
        {
            return array_filter(self::all(), function ($item) {
                return !empty($item['active']);
            });
        }

        public static function find($id)
        {
            $products = self::all();
            foreach ($products as $product) {
                if ($product['id'] == $id) {
                    return $product;
                }
            }
            return null;
        }

        public static function byCategory($category)
        {
            return array_filter(self::all(), function ($item) use ($category) {
                return strcasecmp($item['category'], $category) === 0;
            });
        }

        public static function create($data)
        {
            self::initSession();
            $products = $_SESSION['products'];
            $maxId = 0;
            foreach ($products as $p) {
                if ($p['id'] > $maxId) {
                    $maxId = $p['id'];
                }
            }
            $newProduct = [
                'id' => $maxId + 1,
                'name' => htmlspecialchars($data['name'] ?? 'New Item'),
                'category' => htmlspecialchars($data['category'] ?? 'Beverage'),
                'price' => floatval($data['price'] ?? 0),
                'active' => isset($data['active']) ? (bool)$data['active'] : true,
                'size' => htmlspecialchars($data['size'] ?? 'Regular'),
                'image' => $data['image'] ?? 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=400&h=300&fit=crop',
                'description' => htmlspecialchars($data['description'] ?? '')
            ];
            $products[] = $newProduct;
            $_SESSION['products'] = $products;
            return $newProduct;
        }

        public static function update($id, $data)
        {
            self::initSession();
            $products = $_SESSION['products'];
            foreach ($products as &$product) {
                if ($product['id'] == $id) {
                    if (isset($data['name'])) $product['name'] = htmlspecialchars($data['name']);
                    if (isset($data['category'])) $product['category'] = htmlspecialchars($data['category']);
                    if (isset($data['price'])) $product['price'] = floatval($data['price']);
                    if (isset($data['active'])) $product['active'] = (bool)$data['active'];
                    if (isset($data['size'])) $product['size'] = htmlspecialchars($data['size']);
                    if (isset($data['image']) && !empty($data['image'])) $product['image'] = $data['image'];
                    if (isset($data['description'])) $product['description'] = htmlspecialchars($data['description']);
                    $_SESSION['products'] = $products;
                    return $product;
                }
            }
            return null;
        }

        public static function delete($id)
        {
            self::initSession();
            $products = $_SESSION['products'];
            $filtered = array_values(array_filter($products, function ($p) use ($id) {
                return $p['id'] != $id;
            }));
            $_SESSION['products'] = $filtered;
            return true;
        }

        public static function toJson()
        {
            return json_encode(array_values(self::all()));
        }
    }
}

