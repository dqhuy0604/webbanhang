CREATE TABLE `Role` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(20) NOT NULL
);

CREATE TABLE `User` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `fullname` varchar(50),
  `email` varchar(150),
  `phone_number` varchar(20),
  `address` varchar(200),
  `password` varchar(32),
  `role_id` int,
  `created_at` datetime,
  `updated_at` datetime,
  `deleted` int
);

CREATE TABLE `Category` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(100) NOT NULL
);

CREATE TABLE `Product` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `category_id` int,
  `title` varchar(250),
  `price` int,
  `discount` int,
  `thumbnail` varchar(500),
  `thumbnail_2` varchar(500),
  `description` longtext,
  `created_at` datetime,
  `updated_at` datetime,
  `delete` int
);

CREATE TABLE `Galery` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `product_id` int,
  `thumbnail` varchar(500) NOT NULL
  `thumbnail_2` varchar(500),
);

CREATE TABLE `FeedBack` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `fristname` varchar(30),
  `lastname` varchar(30),
  `email` varchar(150),
  `phone_number` varchar(20),
  `subject_name` varchar(200),
  `note` varchar(500)
);

CREATE TABLE `Orders` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `fullname` varchar(50),
  `email` varchar(150),
  `phone_number` varchar(20),
  `address` varchar(200),
  `note` varchar(1000),
  `order_date` datetime,
  `status` int,
  `total_money` int
);

CREATE TABLE `Order_Details` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `order_id` int,
  `product_id` int,
  `price` int,
  `num` int,
  `total_money` int
);

CREATE TABLE tokens (
  user_id int REFERENCES User(id),
  token varchar(32) not NULL,
  created_at datetime,
  PRIMARY KEY (user_id,token)
);

ALTER TABLE `User` ADD FOREIGN KEY (`role_id`) REFERENCES `Role` (`id`);

ALTER TABLE `Product` ADD FOREIGN KEY (`category_id`) REFERENCES `Category` (`id`);

ALTER TABLE `Order_Details` ADD FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`);

ALTER TABLE `Galery` ADD FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`);

ALTER TABLE `Order_Details` ADD FOREIGN KEY (`order_id`) REFERENCES `Orders` (`id`);

ALTER TABLE `Orders` ADD FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);
