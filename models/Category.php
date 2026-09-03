<?php

if (!class_exists('Category')) {
    class Category
    {
        public static function all()
        {
            return [
                'Beverage' => [
                    'name' => 'Beverage',
                    'badge' => 'badge-beverage',
                    'description' => 'Artisanal coffees, rare single-origin teas, and botanical infusions.'
                ],
                'Pastry' => [
                    'name' => 'Pastry',
                    'badge' => 'badge-pastry',
                    'description' => 'Freshly baked viennoiserie and delicate confectionery.'
                ],
                'Savory' => [
                    'name' => 'Savory',
                    'badge' => 'badge-savory',
                    'description' => 'Gourmet sandwiches, truffle delicacies, and light afternoon fare.'
                ],
                'Breakfast' => [
                    'name' => 'Breakfast',
                    'badge' => 'badge-breakfast',
                    'description' => 'Refined morning staples crafted with farm-fresh ingredients.'
                ],
                'Lunch' => [
                    'name' => 'Lunch',
                    'badge' => 'badge-lunch',
                    'description' => 'Nutritious bowls, tartines, and curated lunch offerings.'
                ]
            ];
        }

        public static function names()
        {
            return array_keys(self::all());
        }

        public static function getBadgeClass($category)
        {
            $categories = self::all();
            return isset($categories[$category]) ? $categories[$category]['badge'] : 'badge-beverage';
        }
    }
}

