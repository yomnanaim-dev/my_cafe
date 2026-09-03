create database hotel_cafe;
use hotel_cafe;
create table room(
room_id int primary key,
room_number int );
-- ************************************************************************
create table users(
user_id int primary key ,
user_name varchar (50) ,
user_email varchar(255) unique,
user_password varchar(255),
user_role enum ('admin','user') default 'user',
user_image varchar(255),
room_id int,
foreign key (room_id) references room (room_id));
-- ***********************************************************************
create table orders(
order_id int primary key,
order_total float,
order_note text,
order_status ENUM('pending', 'confirmed', 'completed', 'cancelled')
DEFAULT 'pending' ,
order_created_at DATETIME DEFAULT CURRENT_TIMESTAMP ,
user_id int,
room_id int,
foreign key (user_id) references users (user_id),
foreign key (room_id) references room (room_id));

-- *********************************************************************
create table categories(
category_id int primary key,
category_name varchar(100) not null);
-- ***************************************************************************
create table products(
product_id int primary key,
product_name varchar (100) not null,
product_price decimal(10,2),
product_image varchar(255),
product_available boolean default true,
category_id int,
foreign key (category_id) references categories( category_id));
-- *****************************************************************
create table order_item(
item_id int primary key,
item_QTY int not null default 0,
price_at_order decimal(10,2),
product_id int,
order_id int,
foreign key(product_id)references products(product_id),
foreign key(order_id)references orders(order_id));
-- *****************************************************************************
insert into room
(room_id,room_number)
values
(1,207),
(2,208);
-- ***************************************************************************************
insert into users
(user_id, user_name, user_email, user_password, user_role, user_image, room_id)
values
(1, 'Omar', 'omar@gmail.com', '123456', 'admin', 'omar.jpg', 1),
(2, 'Ahmed', 'ahmed@gmail.com', '123456', 'user', 'ahmed.jpg', 2),
(3, 'Mohamed', 'mohamed@gmail.com', '123456', 'user', 'mohamed.jpg', 1);
-- **********************************************************************************
insert into orders
(order_id, order_total, order_note, user_id, room_id)
values
(1, 95.00, 'No sugar', 1, 1),
(2, 70.00, 'Extra sauce', 2, 2),
(3, 120.00, 'Deliver quickly', 3, 1);
-- *********************************************************************************************
insert into categories
(category_id, category_name)
values
(1, 'Food'),
(2, 'Drinks'),
(3, 'Dessert');
-- ************************************************************************
insert into products
(product_id, product_name, product_price, product_image, product_available, category_id)
values
(1, 'burger', 75.00, 'burger.jpg', true, 1),
(2, 'pizza', 120.00, 'pizza.jpg', true, 1),
(3, 'cola', 20.00, 'cola.jpg', true, 2),
(4, 'juice', 30.00, 'juice.jpg', true, 2),
(5, 'ice cream', 25.00, 'icecream.jpg', true, 3);
-- ********************************************************************************
insert into order_item
(item_id, item_qty, price_at_order, product_id, order_id)
values
(1, 2, 75.00, 1, 1),
(2, 1, 20.00, 3, 1),
(3, 1, 120.00, 2, 2),
(4, 2, 25.00, 5, 3);
