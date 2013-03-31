-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2013 at 12:35 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tester`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc`
--

CREATE TABLE IF NOT EXISTS `acc` (
  `Id` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserName` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Password` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Type` int(1) DEFAULT NULL,
  `Tel` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`UserName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc`
--

INSERT INTO `acc` (`Id`, `UserName`, `Password`, `email`, `Type`, `Tel`) VALUES
('0', 'admin', '00000000', 'admin@abc.com', 0, '12345699'),
('2', 'imowner', '11111111', 'owner1@gmail.com', 1, '24567890'),
('3', 'imowner2', '22222222', 'owner2@gmail.com', 1, '24567891'),
('4', 'imowner3', '33333333', 'owner3@gmail.com', 1, '24567892'),
('5', 'imuser', '44444444', 'user1@gmail.com', 0, '24567893'),
('5', 'newton12', 'Ning0000', 'newton@123.com', 0, '94731665'),
('6', 'winnie', 'Ss1234', 'shuhs@dvhd.com', 0, '99966655'),
('7', 'winnierest', 'Ss1234', 'lkhei2011@gmail.com', 1, '99966655');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `restaurantid` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `foodid` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `food` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`restaurantid`,`foodid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`restaurantid`, `foodid`, `food`, `price`) VALUES
('00002', 'F0001', 'apple', '20'),
('00002', 'F0002', 'orange', '15'),
('00002', 'F0003', 'rice', '30'),
('00002', 'F0004', 'beef', '15'),
('00002', 'F0005', 'pork chop', '20'),
('00002', 'F0006', 'noodles', '16'),
('00002', 'F0007', 'congee', '25'),
('00001', 'F0002', 'fried rice', '23'),
('00001', 'F0003', 'fried noodles', '23'),
('00001', 'F0004', 'fried fish', '23'),
('00001', 'F0005', 'fried beef', '22'),
('00004', 'F0001', 'chicken wings', '5'),
('00003', 'F0001', 'chicken legs', '100'),
('00005', 'F0002', 'HOHOHO222', '51'),
('00005', 'F0001', 'HOHOHO', '51'),
('00005', 'D0002', 'LILILILI222', '10');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `orderid` int(10) NOT NULL,
  `userid` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `restid` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `foodid` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(3) NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `total` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  KEY `orderid` (`orderid`),
  KEY `orderid_2` (`orderid`),
  KEY `orderid_3` (`orderid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderid`, `userid`, `restid`, `foodid`, `quantity`, `address`, `total`, `date`, `status`) VALUES
(0, 'newton12', '00002', 'F0001', 10, 'what the fuck', '280', '03/01/13 16:57:31', ''),
(0, 'newton12', '00002', 'F0006', 5, 'what the fuck', '280', '03/01/13 16:57:31', ''),
(1, 'newton12', '00003', 'F0001', 10, 'kkk', '1000', '03/01/13 17:06:21', ''),
(2, 'winnie', '00003', 'F0001', 2, 'YMT', '200', '03/01/13 17:45:25', ''),
(3, 'winnierest', '00005', 'D0001', 20, 'LIHO', '200', '03/01/13 17:53:51', '');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE IF NOT EXISTS `restaurants` (
  `rid` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `raddr` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `area` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rtel` int(8) NOT NULL,
  `owner` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rdes` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rlogo` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `popular` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`rid`, `rname`, `raddr`, `area`, `district`, `rtel`, `owner`, `rdes`, `rlogo`, `popular`) VALUES
('00001', 'Good taste', 'Shop 2162, 2/F, Tuen Mun Town Plaza, 3 Tuen Lung S', 'New Territories', 'Tuen Mun', 24597880, 'imowner', 'you are good taste if u choose this', 'cafe_de_coral.jpg', 0),
('00002', 'Bad taste', '1 Lam Tei Main Street, Tuen Mun', 'New Territories', 'Tuen Mun', 24597881, 'imowner1', 'you are bad taste if u dont choose this', 'eg_restLogo01.png', 1),
('00003', '2G1C', 'Shop 2, Level 1, The Peak Tower, The Peak', 'Hong Kong Island', 'The Peak', 24597882, 'imowner2', 'GGG and CC   ', 'mcDonalds.jpg', 0),
('00004', '3B2G', 'Shop G9, G/F, Kwun Tong Plaza, 68 Hoi Yuen Road, K', 'Kowloon', 'Kwun Tong', 24597883, 'imowner3', 'BBB and GG', 'mosBurger.jpg', 0),
('00005', 'Winnierest12', 'Mong Kok', 'New Territories', 'Tuen Mun', 11111111, 'winnierest', 'LIHOHO AR\r\n			', 'Water lilies.jpg', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
