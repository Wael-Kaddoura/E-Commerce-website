-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2021 at 03:18 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommercedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `item_id`) VALUES
(24, 3, 2),
(25, 3, 1),
(26, 3, 1),
(31, 6, 1),
(32, 6, 2),
(33, 6, 5),
(34, 6, 2),
(35, 6, 1),
(36, 6, 1),
(37, 6, 1),
(73, 1, 6),
(87, 1, 2),
(88, 1, 2),
(100, 1, 3),
(101, 1, 2),
(102, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `store_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `category`, `price`, `qty`, `item_image`, `store_id`) VALUES
(1, 'iPhone 12 Case', 'IPhone 12 Case High Quality', 'Cases', 2.18, 80, 'images/items/iphone-12-case.jpg', '1'),
(2, 'Lighting To USB Cable', 'Lighting To USB Cable Original', 'Chargers', 1.15, 150, 'images/items/Lighting To USB Cable.jpg', '1'),
(3, 'Samsung Galaxy S21 Black + 5G 8GB&128GB Triple Rear Camera', 'A: Standard: Mobile phone + All accessories\r\nB: Add AC Charger: Standard+AC Charger(UK/EU/AU/US plugs optional)\r\nC: Add Wireless Charger: Standard+ Wireless Charger\r\nD: Add Earphone: Standard+ Earphone', 'Phones', 1050, 49, 'images/items/s21 ultra black.jpg', '2'),
(4, 'PunnkFunnk Metal Wired Earphone', 'Model: PF-Matt21\r\nDynamic speaker:10mm\r\nHeadset in: 3.5mm\r\nImpedance: 16 Ω\r\nSensitivity : 100±3dB\r\nNet Weight:11g\r\nWired Length:120±5mm\r\nMic:Volume control', 'Earphones', 3.99, 120, 'images/items/earphones.jpg', '2'),
(5, 'HP 15.6 inch Laptop 8G RAM ', 'The 15.6-inch FHD screen brings you a wider view and is still clearly visible even in strong outdoor light. Besides, the night mode and color setting will help reduce the onset of eye strain.', 'Laptops', 305, 41, 'images/items/hp laptop.jpg', '2'),
(6, ' IPhone  11 Full Cover Tempered Glass ', 'Protect your iPhone 12 with the best protective screen protector                            ', 'Other', 3.5, 200, 'images/items/iphone 12 screen protector.jpg', '3'),
(10, 'iPhone 12 red Case', 'IPhone 12 Red Case', 'Cases', 2.5, 98, 'images/items/iphone12redcase.jpg', '3');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `revenue` float NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `store_name`, `email`, `password`, `revenue`, `type`) VALUES
(1, 'Zero3', 'zero3.store@gmail.com', 'bb8dae526407fa72f908c50631a141ac011f650012a2cd5317bfb36666b8a0fb', 4.36, 'store'),
(2, 'Star Cell', 'star.cell@gmail.com', '7a0252b21d595779ef7f308db5d8b6933941ffa6229e63412e5a017957bccb0e', 2270, 'store'),
(3, 'Wael Cell', 'waelcell@gmail.com', '1832633776f3716459705ab30ec06da0f7da07806e7d28d98a0f65582482d716', 5, 'store');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `gender`, `type`) VALUES
(1, 'Wael', 'Kaddoura', 'wael.kad01@gmail.com', '1832633776f3716459705ab30ec06da0f7da07806e7d28d98a0f65582482d716', '0', 'user'),
(2, 'Mohammad', 'Kaddoura', 'mohammadkaddoura797@gmail.com', 'ed5660db36e30606a37a65d4c297ee0a23448550115495e739bea94f5f59db29', '0', 'user'),
(3, 'Ali', 'Kaddoura', 'ali.k@gmail.com', '311339a6c86e58717f1f145db47d191d426fb0844f0400180741196c1e8f4e18', '0', 'user'),
(5, 'Imad', 'Mostafa', 'imadmostafa09@gmail.com', '17b0503165205cb676f166d7efb79b50e6dcc9363745c509e772eb35372a33ef', '0', 'user'),
(6, 'Wael', 'Kaddoura', 'wael.kaddora@gmail.com', '1832633776f3716459705ab30ec06da0f7da07806e7d28d98a0f65582482d716', '0', 'user'),
(7, 'Fadi', 'Ahmad', 'fadi01@gmail.com', 'd9326c7f2f517cd7cf99bfc69aa4a6c069dc1cc14d0d25aba4f240bfd0d01a46', '0', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
