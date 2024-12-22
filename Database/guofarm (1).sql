-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2024 at 11:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guofarm`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(3, 'Vegetables'),
(4, 'Fruits'),
(5, 'Poultry'),
(6, 'Dairy'),
(7, 'Snacks');

-- --------------------------------------------------------

--
-- Table structure for table `order_pending`
--

CREATE TABLE `order_pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_pending`
--

INSERT INTO `order_pending` (`order_id`, `user_id`, `invoice_number`, `product_id`, `quantity`, `order_status`) VALUES
(1, 4, 2077103889, 3, 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_keywords` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_keywords`, `category_id`, `product_image1`, `product_image2`, `product_image3`, `product_price`, `date`, `status`) VALUES
(3, 'Potato', 'Freshly dug from the ground. Cherished with love and organic fertilizer courtesy of our cows and chickens. (Items are sold per kilo)', 'potato, vegetable', 3, 'potato.jpg', 'potato.jpg', 'potato.jpg', '200', '2024-12-19 09:01:03', 'true'),
(4, 'Milk', 'Pasteurized milk is a dairy milk that is heated and cooled using a simple heating process that makes milk safe to drink before it is packaged and shipped to grocery stores.', 'milk, dairy', 6, 'milk.jpg', 'milk.jpg', 'milk.jpg', '90', '2024-12-19 09:02:06', 'true'),
(5, 'Indian Mango', 'Freshly picked from the best Mango trees from high-quality orchards. (Items are sold per kilo)', 'fruit, mango', 4, 'mango.jpg', 'mango.jpg', 'mango.jpg', '70', '2024-12-20 17:02:48', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_id`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `order_status`) VALUES
(1, 4, 200, 2077103889, 1, '2024-12-21 18:45:19', 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `user_payments`
--

CREATE TABLE `user_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_payments`
--

INSERT INTO `user_payments` (`payment_id`, `order_id`, `invoice_number`, `amount`, `payment_mode`, `date`) VALUES
(1, 1, 2077103889, 200, '', '2024-12-21 18:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_mobile` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `username`, `user_email`, `user_password`, `user_ip`, `user_address`, `user_mobile`, `user_image`) VALUES
(4, 'Michel', 'test@email', '$2y$10$Q432LezT2O9YORurcxdoNer3NkJAB8pDYCY71MQWv7BQqUuzQ4X9W', '::1', 'Daraga', '111111', ''),
(11, 'shinx', 'pokemon@gen4', '$2y$10$lHGYh.zhAYFc290nJ8M.HuJ6Q9o8zy2LrxdfV6zNLhs53oI.GGig.', '::1', 'sinnoh', '1111111', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `order_pending`
--
ALTER TABLE `order_pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_pending`
--
ALTER TABLE `order_pending`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
