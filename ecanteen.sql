-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2017 at 05:14 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshopnepall`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email_id`) VALUES
(1, 'Nishank', 'bajura12', 'khadkanishan@gma650il.com'),
(2, 'Krishna', 'karki12', 'krishnakarki750@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'HP'),
(2, 'Samsung'),
(3, 'Apple'),
(4, 'Sony'),
(5, 'LG');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(250) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_title` varchar(200) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `qty` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `total_amt` int(10) NOT NULL,
  `checkout_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Mobile'),
(2, 'Laptop'),
(3, 'Home Appliances'),
(4, 'Kitchen');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `id` int(11) NOT NULL,
  `product_id` int(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_phone` varchar(50) NOT NULL,
  `customer_district` varchar(50) NOT NULL,
  `customer_address` varchar(100) NOT NULL,
  `order_date` varchar(50) NOT NULL,
  `order_time` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `product_price` int(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivered`
--

CREATE TABLE `delivered` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `product_price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `messages` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `productcount`
--

CREATE TABLE `productcount` (
  `id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `count` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productcount`
--

INSERT INTO `productcount` (`id`, `product_id`, `count`) VALUES
(21, '3', 25),
(22, '39', 1),
(23, '8', 13),
(24, '45', 13),
(25, '6', 16),
(26, '37', 21);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` varchar(100) NOT NULL,
  `product_brand` varchar(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_quantity`) VALUES
(1, 'Mobile', 'Samsung', 'Samsung Dous 2', 5000, 'Samsung Dous 2 sgh ', 'samsung mobile.jpg', 20),
(2, 'Mobile', 'Apple', 'iPhone 5s', 25000, 'iphone 5s', 'iphone mobile.jpg', 20),
(3, 'Mobile', 'LG', 'iPad', 30000, 'ipad apple brand', 'ipad.jpg', 20),
(4, 'Mobile', 'Apple', 'iPhone 6s', 32000, 'Apple iPhone ', 'iphone.jpg', 5),
(5, 'Mobile', 'Sony', 'iPad 2', 10000, 'samsung ipad', 'ipad 2.jpg', 5),
(6, 'Laptop', 'Sony', 'Hp Laptop r series', 35000, 'Hp Red and Black combination Laptop', 'k2-_ed8b8f8d-e696-4a96-8ce9-d78246f10ed1.v1.jpg-bc204bdaebb10e709a997a8bb4518156dfa6e3ed-optim-450x450.jpg', 4),
(7, 'Laptop', 'Sony', 'Laptop Pavillion', 50000, 'Laptop Hp Pavillion', '12039452_525963140912391_6353341236808813360_n.png', 6),
(8, 'Mobile', 'Sony', 'Sony', 40000, 'Sony Mobile', 'sony mobile.jpg', 19),
(9, 'Mobile', 'Apple', 'iPhone New', 12000, 'iphone', 'white iphone.png', 20),
(33, 'Kitchen', 'LG', 'Refrigerator', 35000, 'Refrigerator', 'CT_WM_BTS-BTC-AppliancesHome_20150723.jpg', 20),
(34, '	\r\nHome Appliances', 'Samsung', 'Emergency Light', 1000, 'Emergency Light', 'emergency light.JPG', 20),
(35, 'Home Appliances', 'HP', 'Vaccum Cleaner', 6000, 'Vaccum Cleaner', '../product_images/36.jpg', 19),
(36, '	\r\nHome Appliances', 'Sony', 'Iron', 1500, 'gj', 'iron.JPG', 20),
(37, 'Home Appliances', 'HP', 'LED TV', 20000, 'LED TV', '../product_images/15.jpg', 20),
(38, 'Kitchen', 'HP', 'Microwave Oven', 3500, 'Microwave Oven', '../product_images/38.jpg', 20),
(39, 'Kitchen', 'Samsung', 'Mixer Grinder', 2500, 'Mixer Grinder', 'singer-mixer-grinder-mg-46-medium_4bfa018096c25dec7ba0af40662856ef.jpg', 20),
(45, 'Mobile', 'Samsung', 'Samsung Galaxy Note 3', 10000, '0', 'samsung_galaxy_note3_note3neo.JPG', 19),
(46, 'Mobile', 'Samsung', 'Samsung Galaxy Note 3', 10000, '', 'samsung_galaxy_note3_note3neo.JPG', 20);

-- --------------------------------------------------------

--
-- Table structure for table `recommendcount`
--

CREATE TABLE `recommendcount` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recommendcount`
--

INSERT INTO `recommendcount` (`user_id`, `product_id`, `count`) VALUES
(6, 36, 2),
(6, 46, 1),
(7, 3, 25),
(7, 6, 17),
(7, 7, 1),
(7, 8, 13),
(7, 37, 21),
(7, 39, 1),
(7, 45, 13);

-- --------------------------------------------------------

--
-- Table structure for table `sent_deliveries`
--

CREATE TABLE `sent_deliveries` (
  `id` int(11) NOT NULL,
  `user_id` int(50) NOT NULL,
  `order_date` varchar(50) NOT NULL,
  `order_time` varchar(50) NOT NULL,
  `sent_date` varchar(50) NOT NULL,
  `sent_time` varchar(50) NOT NULL,
  `product_price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_contacts`
--

CREATE TABLE `user_contacts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`) VALUES
(6, 'praful', 'basnet', 'praful@gmail.com', '1234567', '9876765434', 'bkt', 'bkt'),
(7, 'bikash', 'dhungana', 'bkas@gmail.com', '9843398105', '9843398105', 'bkt', 'bkt'),
(8, 'usav', 'koirala', 'utsav@gmail.com', '12345678', '9898989898', 'bkt', 'bkt');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivered`
--
ALTER TABLE `delivered`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productcount`
--
ALTER TABLE `productcount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `recommendcount`
--
ALTER TABLE `recommendcount`
  ADD PRIMARY KEY (`user_id`,`product_id`);

--
-- Indexes for table `sent_deliveries`
--
ALTER TABLE `sent_deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_contacts`
--
ALTER TABLE `user_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `delivered`
--
ALTER TABLE `delivered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `productcount`
--
ALTER TABLE `productcount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `sent_deliveries`
--
ALTER TABLE `sent_deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_contacts`
--
ALTER TABLE `user_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
