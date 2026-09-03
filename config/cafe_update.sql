USE hotel_cafe;


INSERT INTO categories (category_id, category_name) VALUES
(4, 'Coffee'),
(5, 'Bakery');


INSERT INTO products (product_id, product_name, product_price, product_image, product_available, category_id) VALUES
(6, 'Blackberry Mojito', 45.00, '1000520896.jpg', true, 2),
(7, 'Affogato Al Caffe', 55.00, '1000520906.jpg', true, 4),
(8, 'Iced Blackberry Cooler', 50.00, '1000520898.jpg', true, 2),
(9, 'Caffe Latte Art', 40.00, '1000520900.jpg', true, 4),
(10, 'Caramel Macchiato', 60.00, '1000520914.jpg', true, 4),
(11, 'Spiced Cinnamon Coffee', 45.00, '1000520908.jpg', true, 4),
(12, 'Blueberry Mousse Cake', 65.00, '1000520910.jpg', true, 3),
(13, 'Butter Croissant', 30.00, '1000520918.jpg', true, 5),
(14, 'Red Velvet Cake', 70.00, '1000520920.jpg', true, 3),
(15, 'Caramel Orange Cheesecake', 75.00, '1000520912.jpg', true, 3),
(16, 'Garlic Herb Bread', 40.00, '1000520922.jpg', true, 5),
(17, 'Berry Pancakes', 55.00, '1000520924.jpg', true, 3),
(18, 'Lotus Cheesecake', 80.00, '1000520916.jpg', true, 3),
(19, 'Garlic Cheese Knots', 45.00, '1000520926.jpg', true, 5),
(20, 'Cheesy Garlic Breadsticks', 50.00, '1000520928.jpg', true, 5),
(21, 'Pistachio Cream Croissant', 65.00, '1000520930.jpg', true, 5);

-- **********************************************************************************************************

ALTER TABLE users ADD ext VARCHAR(20) NULL AFTER room_id;
ALTER TABLE orders DROP FOREIGN KEY orders_ibfk_1;
ALTER TABLE users MODIFY user_id INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE orders ADD CONSTRAINT orders_ibfk_1 FOREIGN KEY (user_id) REFERENCES users (user_id);

-- ***********************************************************************************************************
UPDATE products SET product_image = 'blackberry_mojito.jpg' WHERE product_id = 6;
UPDATE products SET product_image = 'affogato_al_caffe.jpg' WHERE product_id = 7;
UPDATE products SET product_image = 'iced_blackberry_cooler.jpg' WHERE product_id = 8;
UPDATE products SET product_image = 'caffe_latte_art.jpg' WHERE product_id = 9;
UPDATE products SET product_image = 'caramel_macchiato.jpg' WHERE product_id = 10;
UPDATE products SET product_image = 'spiced_cinnamon_coffee.jpg' WHERE product_id = 11;
UPDATE products SET product_image = 'blueberry_mousse_cake.jpg' WHERE product_id = 12;
UPDATE products SET product_image = 'butter_croissant.jpg' WHERE product_id = 13;
UPDATE products SET product_image = 'red_velvet_cake.jpg' WHERE product_id = 14;
UPDATE products SET product_image = 'caramel_orange_cheesecake.jpg' WHERE product_id = 15;
UPDATE products SET product_image = 'garlic_herb_bread.jpg' WHERE product_id = 16;
UPDATE products SET product_image = 'berry_pancakes.jpg' WHERE product_id = 17;
UPDATE products SET product_image = 'lotus_cheesecake.jpg' WHERE product_id = 18;
UPDATE products SET product_image = 'garlic_cheese_knots.jpg' WHERE product_id = 19;
UPDATE products SET product_image = 'cheesy_garlic_breadsticks.jpg' WHERE product_id = 20;
UPDATE products SET product_image = 'pistachio_cream_croissant.jpg' WHERE product_id = 21;