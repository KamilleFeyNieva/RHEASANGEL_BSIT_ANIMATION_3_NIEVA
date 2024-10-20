-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2024 at 03:13 PM
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
-- Database: `gofarm`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `Address_ID` int(11) NOT NULL,
  `Region` varchar(255) NOT NULL,
  `Province` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Street` varchar(255) NOT NULL,
  `Postal_Code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`Address_ID`, `Region`, `Province`, `City`, `Street`, `Postal_Code`) VALUES
(1, 'Bicol', 'Albay', 'Legazpi City', 'Bitano', 4500),
(2, 'Bicol', 'Albay', 'Daraga', 'Binitayan', 4501),
(3, 'Bicol', 'Albay', 'Camalig', 'Upper Gapo', 4502),
(4, 'Bicol', 'Albay', 'Guinobatan', 'Inamnan Grande', 4503),
(5, 'Bicol', 'Albay', 'Polangui', 'Minto Street', 4506);

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE `customer_info` (
  `cus_info_id` int(11) NOT NULL,
  `FirstName` varchar(55) NOT NULL,
  `LastName` varchar(55) NOT NULL,
  `Address_ID` int(11) NOT NULL,
  `Contact_No` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_info`
--

INSERT INTO `customer_info` (`cus_info_id`, `FirstName`, `LastName`, `Address_ID`, `Contact_No`) VALUES
(1, 'Bill', 'Gates', 1, 1234567890),
(2, 'Lapu', 'Lapu', 2, 317521),
(3, 'Isaac', 'Newton', 3, 25131642),
(4, 'Albert', 'Einstein', 4, 5050100),
(5, 'Hideo', 'Kojima', 5, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `SKU` varchar(55) NOT NULL,
  `stock` int(11) NOT NULL,
  `product_image` int(11) NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `product_category_id`, `name`, `description`, `SKU`, `stock`, `product_image`, `price`) VALUES
(1, 1, 'Bitter Gourd', 'Freshly picked Bitter Gourds from chosen high-quality farms. Free from insecticides and purely organic. Only for culinary purposes please.\r\n(Items are sold per kilo)', 'BTR-GRD-GRN', 50, 0, 25.00),
(2, 3, 'Egg', 'Laid by organic and native chickens. Bred with high-quality eggs in mind. Eggs are safe for consumption, better than what Japan has to offer. (Eggs are sold by trays with around 30 eggs per tray)', 'NTV-EGG-DZN', 500, 0, 400.00),
(3, 2, 'Carabao Mango', 'Freshly picked from the best Mango trees from high-quality orchards.\r\n(Items are sold per kilo)', 'CRB-MGO', 700, 0, 70.00),
(4, 2, 'Indian Mango', 'Freshly picked from the best Mango trees from high-quality orchards.\r\n(Items are sold per kilo)', 'IND-MGO', 700, 0, 70.00),
(5, 4, 'Pasteurized Cow Milk', 'Pasteurized milk is a dairy milk that is heated and cooled using a simple heating process that makes milk safe to drink before it is packaged and shipped to grocery stores. Pasteurization is a process by which milk is heated to a specific temperature for ', 'PTZ-COW-MLK', 100, 0, 90.00),
(6, 5, 'Glazed Pili Nuts in a Jar', 'Pili nuts caramelized with sugary sweetness. For your snacking and cooking needs.', 'GLZ-PLI-NUT', 200, 0, 400.00),
(7, 1, 'Potato', 'Freshly dug from the ground. Cherished with love and organic fertilizer courtesy of our cows and chickens.\r\n(Items are sold per kilo)', 'FRH-ORG-PTO', 150, 0, 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_line`
--

CREATE TABLE `order_line` (
  `ordered_item_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_line`
--

INSERT INTO `order_line` (`ordered_item_id`, `item_id`, `order_id`, `qty`, `price`) VALUES
(1, 1, 1, 4, 500.00),
(2, 3, 5, 50, 200.00),
(3, 7, 5, 59, 150.00),
(4, 5, 6, 40, 300.00),
(5, 2, 5, 200, 1000.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `order_status_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `status`) VALUES
(1, 'Shipping'),
(2, 'Pending'),
(3, 'Failed');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `payment_method_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `acc_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`payment_method_id`, `user_id`, `payment_type_id`, `provider`, `acc_number`) VALUES
(1, 3, 5, 'GCash', 12345),
(2, 4, 1, 'Cash', 12346),
(3, 1, 4, 'VISA', 1233),
(4, 2, 3, 'Landbank of the Philippines', 2001),
(5, 5, 2, 'Bank of Commerce', 1998);

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `payment_type_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`payment_type_id`, `type`) VALUES
(1, 'On-Cash Delivery'),
(2, 'Debit Card'),
(3, 'Credit Card'),
(4, 'VISA'),
(5, 'eWallet');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_category_id`, `category_name`) VALUES
(1, 'Vegetable'),
(2, 'Fruits'),
(3, 'Poultry'),
(4, 'Dairy'),
(5, 'Souvenirs');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_method`
--

CREATE TABLE `shipping_method` (
  `shipping_method_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping_method`
--

INSERT INTO `shipping_method` (`shipping_method_id`, `name`, `price`) VALUES
(1, 'International Shipping', 200.00),
(2, 'Local Delivery', 150.00),
(3, 'Priority Shipping', 300.00),
(4, 'Overnight Shipping', 250.00);

-- --------------------------------------------------------

--
-- Table structure for table `shop_orders`
--

CREATE TABLE `shop_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `payment_method_id` int(11) NOT NULL,
  `Address_ID` int(11) NOT NULL,
  `shipping_method_id` int(11) NOT NULL,
  `order_total` int(11) NOT NULL,
  `order_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop_orders`
--

INSERT INTO `shop_orders` (`order_id`, `user_id`, `order_date`, `payment_method_id`, `Address_ID`, `shipping_method_id`, `order_total`, `order_status`) VALUES
(1, 3, '2024-10-20', 5, 5, 4, 2, 1),
(2, 1, '2024-10-20', 4, 1, 1, 2, 2),
(3, 2, '2024-10-20', 5, 2, 4, 5, 1),
(4, 3, '2024-10-20', 3, 4, 1, 100, 3),
(5, 4, '2024-10-20', 2, 4, 2, 10, 1),
(6, 5, '2024-10-20', 1, 5, 3, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `item_id`, `name`, `status`) VALUES
(1, 6, 'Pili Kats', 'Active'),
(2, 1, 'Go!Farm Manila Branch', 'Active'),
(3, 3, 'Go!Farm Polangui Branch', 'Active'),
(4, 4, 'Go!Farm Indian Branch', 'Active'),
(5, 2, 'Go!Farm Poultry ', 'Pending'),
(6, 5, 'Go!Farm Dairy', 'Active'),
(7, 7, 'Go!Farm Main Branch', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp(),
  `cus_info_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `date_added`, `cus_info_id`) VALUES
(1, 'EmceeSquared', 'emc2', '2024-10-20', 4),
(2, 'Windows_XP', 'WindowsExpee', '2024-10-20', 1),
(3, 'aPPle', 'gravity9point8', '2024-10-20', 3),
(4, 'Da_2', 'Pilipins', '2024-10-20', 2),
(5, 'Solid_Snek', 'MetalGearSolid', '2024-10-20', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`Address_ID`);

--
-- Indexes for table `customer_info`
--
ALTER TABLE `customer_info`
  ADD PRIMARY KEY (`cus_info_id`),
  ADD KEY `Address_ID` (`Address_ID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `product_category_id` (`product_category_id`);

--
-- Indexes for table `order_line`
--
ALTER TABLE `order_line`
  ADD PRIMARY KEY (`ordered_item_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`payment_method_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_type_id` (`payment_type_id`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`payment_type_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_category_id`);

--
-- Indexes for table `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD PRIMARY KEY (`shipping_method_id`);

--
-- Indexes for table `shop_orders`
--
ALTER TABLE `shop_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_method_id` (`payment_method_id`),
  ADD KEY `Address_ID` (`Address_ID`),
  ADD KEY `shipping_method_id` (`shipping_method_id`),
  ADD KEY `order_status` (`order_status`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `cus_info_id` (`cus_info_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `Address_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_info`
--
ALTER TABLE `customer_info`
  MODIFY `cus_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_line`
--
ALTER TABLE `order_line`
  MODIFY `ordered_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `order_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `payment_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `shipping_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shop_orders`
--
ALTER TABLE `shop_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_info`
--
ALTER TABLE `customer_info`
  ADD CONSTRAINT `customer_info_ibfk_1` FOREIGN KEY (`Address_ID`) REFERENCES `addresses` (`Address_ID`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`product_category_id`);

--
-- Constraints for table `order_line`
--
ALTER TABLE `order_line`
  ADD CONSTRAINT `order_line_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`),
  ADD CONSTRAINT `order_line_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `shop_orders` (`order_id`);

--
-- Constraints for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD CONSTRAINT `payment_method_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `payment_method_ibfk_2` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_type` (`payment_type_id`);

--
-- Constraints for table `shop_orders`
--
ALTER TABLE `shop_orders`
  ADD CONSTRAINT `shop_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `shop_orders_ibfk_2` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_method` (`payment_method_id`),
  ADD CONSTRAINT `shop_orders_ibfk_3` FOREIGN KEY (`Address_ID`) REFERENCES `addresses` (`Address_ID`),
  ADD CONSTRAINT `shop_orders_ibfk_4` FOREIGN KEY (`shipping_method_id`) REFERENCES `shipping_method` (`shipping_method_id`),
  ADD CONSTRAINT `shop_orders_ibfk_5` FOREIGN KEY (`order_status`) REFERENCES `order_status` (`order_status_id`);

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`cus_info_id`) REFERENCES `customer_info` (`cus_info_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
