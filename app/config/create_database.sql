CREATE DATABASE `products_sell` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE type_products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  tax INT NOT NULL
);

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  type_product_id INT NOT NULL,
  value INT NOT NULL,
  CONSTRAINT fk_type_product_id FOREIGN KEY (type_product_id) REFERENCES type_products(id)
);

CREATE TABLE sales (
  id INT AUTO_INCREMENT PRIMARY KEY,
  total INT NOT NULL,
  total_tax INT NOT NULL,
  created_at DATETIME NOT NULL
);

CREATE TABLE sale_products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sale_id INT NOT NULL,
  product_id INT NOT NULL,
  amount INT NOT NULL,
  value_amount INT NOT NULL,
  value_amount_tax INT NOT NULL,
  CONSTRAINT fk_product_id FOREIGN KEY (product_id) REFERENCES products(id),
  CONSTRAINT fk_sale FOREIGN KEY (sale_id) REFERENCES sales(id)
);
