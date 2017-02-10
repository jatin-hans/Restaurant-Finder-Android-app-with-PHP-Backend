-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2016 at 12:49 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `right` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `Username`, `Password`, `right`) VALUES
(2, 'admin@gmail.com', 'empreus', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(11) NOT NULL,
  `food_type` varchar(50) NOT NULL,
  `food_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `food_type`, `food_id`) VALUES
(11, 'Cocktails', 6),
(12, 'Aaloo Puri', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_foodcategories`
--

CREATE TABLE `tbl_foodcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_foodtype`
--

CREATE TABLE `tbl_foodtype` (
  `id` int(11) NOT NULL,
  `foodtype` varchar(11) NOT NULL,
  `price` int(11) NOT NULL,
  `img` text NOT NULL,
  `ft_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_images`
--

CREATE TABLE `tbl_images` (
  `id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `img_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mobileuser`
--

CREATE TABLE `tbl_mobileuser` (
  `id` int(11) NOT NULL,
  `UName` varchar(255) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Mobile` bigint(255) DEFAULT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mobileuser`
--

INSERT INTO `tbl_mobileuser` (`id`, `UName`, `Email`, `Mobile`, `Password`) VALUES
(1, 'abc', 'abc123@gmail.com', 9560666985, '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offers`
--

CREATE TABLE `tbl_offers` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_restourant`
--

CREATE TABLE `tbl_restourant` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `ratting` int(11) NOT NULL,
  `zipcode` int(10) NOT NULL,
  `Vegtype` varchar(50) NOT NULL,
  `phone_no` bigint(20) NOT NULL,
  `time` text NOT NULL,
  `totime` varchar(50) NOT NULL,
  `video` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `thumimage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userfeedback`
--

CREATE TABLE `tbl_userfeedback` (
  `id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `ratting` text NOT NULL,
  `comment` text NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `notification` tinyint(1) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `webservice`
--

CREATE TABLE `webservice` (
  `id` int(11) NOT NULL,
  `desc` text NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webservice`
--

INSERT INTO `webservice` (`id`, `desc`, `url`) VALUES
(1, 'Display Restaurant List', 'http://restaurant.admin.redixbit.com/restaurantdetail.php'),
(2, 'Display Only One Restaurant Detail', 'http://restaurant.admin.redixbit.com/restaurantdetail.php?value=""'),
(3, 'Search Restaurant Detail', 'http://restaurant.admin.redixbit.com/restaurantdetail.php?search=""'),
(4, 'Display Food type All Restaurant ', 'http://restaurant.admin.redixbit.com//foodtype.php'),
(5, 'Display Food type only One Restaurant ', 'http://restaurant.admin.redixbit.com//foodtype.php?value=""'),
(6, 'Display Food Category', 'http://restaurant.admin.redixbit.com/foodcategory.php'),
(7, 'Display all Restaurant Offers', 'http://restaurant.admin.redixbit.com/offersdetail.php'),
(8, 'Display only one Restaurant Offers', 'http://restaurant.admin.redixbit.com/offersdetail.php?value=""'),
(9, 'Create Mobile User', 'http://restaurant.admin.redixbit.com/adduser.php?username=""&&email=""'),
(10, 'Update Mobile User', 'http://restaurant.admin.redixbit.com/updateuser.php?username=""&&email=""'),
(11, 'Add User Feedback', 'http://restaurant.admin.redixbit.com/userfeedback.php?res_id=""&&user_id=""&&ratting=""&&comment=""'),
(12, 'View Only One Restaurant User Feedback', 'http://restaurant.admin.redixbit.com/userfeedback.php?value=19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_foodcategories`
--
ALTER TABLE `tbl_foodcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_foodtype`
--
ALTER TABLE `tbl_foodtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_images`
--
ALTER TABLE `tbl_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_mobileuser`
--
ALTER TABLE `tbl_mobileuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_offers`
--
ALTER TABLE `tbl_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_restourant`
--
ALTER TABLE `tbl_restourant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_userfeedback`
--
ALTER TABLE `tbl_userfeedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webservice`
--
ALTER TABLE `webservice`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_foodcategories`
--
ALTER TABLE `tbl_foodcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_foodtype`
--
ALTER TABLE `tbl_foodtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_images`
--
ALTER TABLE `tbl_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_mobileuser`
--
ALTER TABLE `tbl_mobileuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_offers`
--
ALTER TABLE `tbl_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_restourant`
--
ALTER TABLE `tbl_restourant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_userfeedback`
--
ALTER TABLE `tbl_userfeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `webservice`
--
ALTER TABLE `webservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
