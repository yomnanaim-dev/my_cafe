CREATE DATABASE IF NOT EXISTS verdant_cafe;

USE verdant_cafe;

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  category VARCHAR(50) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  size VARCHAR(50) NOT NULL DEFAULT 'Regular',
  active TINYINT(1) NOT NULL DEFAULT 1,
  image VARCHAR(255) NOT NULL DEFAULT '',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (name, category, price, size, active, image) VALUES
('Botanical Matcha Latte', 'Beverage', 8.50, 'Regular', 1, ''),
('Rosewater Velvet Cake', 'Pastry', 12.00, 'Slice', 1, ''),
('Truffle Infused Croissant', 'Savory', 9.50, 'Regular', 0, '');