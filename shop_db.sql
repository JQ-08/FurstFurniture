-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 10:54 AM
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
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(20) NOT NULL,
  `userId` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `qty` varchar(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `userId`, `product_id`, `price`, `qty`) VALUES
(32, 'Z0003', '771', '999', '1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(20) NOT NULL,
  `userId` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `method` varchar(50) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `qty` varchar(2) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'in progress'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `name`, `number`, `email`, `address`, `method`, `product_id`, `price`, `qty`, `date`, `status`) VALUES
(98913, 'Z0002', 'User', '1345', 'user@gmail.com', '83, 8, 8, 8 - 8', 'cash on delivery', '755', '1000', '1', '2024-09-20', 'completed'),
(98914, 'Z0002', '88', '88', '88@gmail.com', '88, 88, 88, 88 - 88', 'cash on delivery', '759', '99', '4', '2024-09-17', 'canceled'),
(98915, 'Z0002', 'w', '2', '2@gmail.com', '1, 1, 1, 1 - 1', 'cash on delivery', '761', '699', '1', '2024-10-02', 'canceled'),
(98916, 'Z0002', 'd', '123', '1@gmail.com', '23, 123, 123, 2133 - 123', 'credit card', '759', '159', '1', '2024-10-06', 'in progress'),
(98917, 'Z0002', 'd', '123', '1@gmail.com', '23, 123, 123, 2133 - 123', 'credit card', '760', '369', '1', '2024-10-06', 'in progress'),
(98918, 'Z0002', '21', '213', '123@gmail.com', '32, 123, 123, 123 - 123', 'cash on delivery', '753', '888', '1', '2024-10-08', 'in progress'),
(98919, 'Z0002', '21', '213', '123@gmail.com', '32, 123, 123, 123 - 123', 'cash on delivery', '753', '888', '1', '2024-10-09', 'in progress'),
(98920, 'Z0002', 'IRONMAN', '312', 'Ironman26@gmail.com', '26,Chemical 8,Ironman, 55.845, jghjhjj, Chemical - 231312', 'credit card', '754', '1750', '1', '2024-10-10', 'canceled'),
(98921, 'Z0002', 'IRONMAN', '312', 'Ironman26@gmail.com', '26,Chemical 8,Ironman, 55.845, jghjhjj, Chemical - 231312', 'credit card', '755', '99', '1', '2024-10-10', 'completed'),
(98942, 'Z0002', '213', '123', 'good@gmail.com', '312, 312, 12, 123 - 312', 'cash on delivery', '754', '1750', '1', '2024-10-14', 'in progress'),
(98943, 'Z0002', 'IRONMAN', '321', 'Ironman26@gmail.com', '312312, 21312, 312, 312 - 123', 'cash on delivery', '755', '99', '1', '2024-10-04', 'in progress'),
(98944, 'Z0002', 'user', '312', 'good@gmail.com', '123, 312, Chemical, 12 - 12', 'cash on delivery', '754', '1750', '1', '2024-10-14', 'in progress'),
(98945, 'Z0002', 'user', '312', 'good@gmail.com', '123, 312, Chemical, 12 - 12', 'cash on delivery', '755', '99', '1', '2024-10-14', 'in progress'),
(98946, 'Z0008', 'Feng', '0108300530', 'Feng30@gmail.com', '30,Will, Be, Fine, Soon - 053000', 'credit card', '754', '1750', '1', '2024-10-14', 'in progress'),
(98947, 'Z0008', 'Feng', '0108300530', 'Feng30@gmail.com', '30,Will, Be, Fine, Soon - 053000', 'credit card', '759', '159', '1', '2024-10-14', 'in progress'),
(98948, 'Z0011', 'Chun Wei', '012343587', 'weidrum@gmail.com', '12,Green, Blue, Red, Colour - 123456', 'cash on delivery', '772', '1999', '1', '2024-10-14', 'in progress'),
(98949, 'Z0011', 'Chun Wei', '012343587', 'weidrum@gmail.com', '12,Green, Blue, Red, Colour - 123456', 'cash on delivery', '771', '999', '1', '2024-10-14', 'in progress');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(10) NOT NULL,
  `type` varchar(50) NOT NULL,
  `image1` varchar(50) NOT NULL,
  `image2` varchar(50) NOT NULL,
  `image3` varchar(50) NOT NULL,
  `image4` varchar(50) NOT NULL,
  `depth` varchar(10) NOT NULL,
  `width` varchar(10) NOT NULL,
  `height` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `type`, `image1`, `image2`, `image3`, `image4`, `depth`, `width`, `height`) VALUES
(753, 'BRIMNES', 'The mirror door can be placed on the left side, right side or in the middle.', '888', 'wardrobe', '234Z8.png', '23Z89.png', '1243Z.png', '2341Z.png', '50 cm', '190 cm', '117 cm'),
(754, 'HASVIK', 'The sliding doors do not require knobs or handles. This creates a timeless expression that is easy to combine with different styles.', '1750', 'wardrobe', '768Z9.png', '3453Z.png', '018Z8.png', 'Z1234.png', '44 cm', '150 cm', '201 cm'),
(755, 'VUKU', 'Inspired by the ingenuity of tents, we worked with tent suppliers to develop this wardrobe. ', '99', 'wardrobe', '1238Z.png', '233Z8.png', '2323Z.png', '324Z9.png', '51 cm', '74 cm', '149 cm'),
(756, 'TROTTEN', 'Small desk that fits in every space – at your office or at home.', '299', 'table', 'Z5708.png', '5Z630.png', '6530Z.png', 'Z7773.png', '70 cm', '120 cm', '75 cm'),
(757, 'UTESPELARE', 'Raise the large, sturdy UTESPELARE gaming desk to a height that optimally suits you.', '599', 'table', '78Z42.png', '9032Z.png', '854Z6.png', 'Z6Z32.png', '80 cm', '78 cm', '68 cm'),
(758, 'BRUSALI', 'You can fit a computer in the cabinet, since the shelves are adjustable.', '259', 'table', '789Z0.png', 'ZZ882.png', '796Z3.png', '57Z64.png', '52 cm', '73 cm', '90 cm'),
(759, 'LOBERGET', 'You sit comfortably since the chair is adjustable in height.', '159', 'chair', '89Z63.png', '7Z325.png', '65Z23.png', '9287Z.png', '67 cm', '90 cm', '67 cm'),
(760, 'VASMAN', 'VASMAN gaming chair gives your body a nice support with a synchronised seat and back tilt.', '369', 'chair', '234Z2.png', '21Z12.png', '98Z38.png', '234Z0.png', '64 cm', '70 cm', '128 cm'),
(761, 'STRANDMON', 'Bringing new life to an old favourite. We first introduced this chair in the 1950’s.', '699', 'chair', '897Z2.png', '239Z9.png', '345Z9.png', '9843Z.png', '96 cm', '82 cm', '101 cm'),
(771, 'GRUPPSPEL', 'A sleek, modern chair with ergonomic support, durable materials, and a minimalist design, perfect for stylish comfort in any home or office.', '999', 'chair', '65986.png', '4633Z.webp', '67331.png', '06Z13.png', '64 cm', '69 cm', '116 cm'),
(772, 'MITTZON', 'A sleek, modern table with premium materials, ideal for dining, work, or enhancing any space with style and functionality.', '1999', 'table', '8Z837.png', '54041.avif', '75015.avif', '26695.avif', '80 cm', '160 cm', '124 cm');

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersPwd` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `usersName`, `usersEmail`, `usersPwd`) VALUES
('Z0001', 'admin', 'admin@gmail.com', '12345'),
('Z0002', 'user', 'user@gmail.com', '123'),
('Z0003', 'Syahir', 'syahir@gmail.com', '135790'),
('Z0004', 'Chris', 'Chris93@gmail.com', '93102030'),
('Z0005', 'Claire', 'claire416@gmail.com', '82041600'),
('Z0006', 'Ethan', 'ethan00@gmail.com', '42354657'),
('Z0007', 'Nagathan', 'drbyclb@gmail.com', '13243546'),
('Z0008', 'Feng', 'Feng30@gmail.com', '82083000'),
('Z0009', 'Choom Imm', 'immam@gmail.com', '3141592654'),
('Z0010', 'Nur Fatihah', 'bmbest@gmail.com', '111222333'),
('Z0011', 'Wei', 'weidrum@gmail.com', '790826555');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UID_FK_KEY` (`userId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99454;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98950;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=773;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `UID_FK_KEY` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
