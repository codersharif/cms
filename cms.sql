-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2018 at 06:30 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `art_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `image` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`art_id`, `cat_id`, `title`, `image`, `content`, `status`) VALUES
(6, 10, 'add', 'img/2018-02-25-19-00-19-543.jpg', '<p>add</p>\r\n', 1),
(7, 13, 'bongubundu satelite', 'img/bangabandhu_satellite.jpg', '<p>The Bangabandhu-1 satellite is expected to be located at the 119.1&deg; East longitude geostationary slot. It is named after the father of the nation,&nbsp;<a href=\"https://en.wikipedia.org/wiki/Bangabandhu_Sheikh_Mujibur_Rahman\" title=\"Bangabandhu Sheikh Mujibur Rahman\">Bangabandhu Sheikh Mujibur Rahman</a>. It is designed and manufactured by&nbsp;<a href=\"https://en.wikipedia.org/wiki/Thales_Alenia_Space\" title=\"Thales Alenia Space\">Thales Alenia Space</a>&nbsp;and its launch provider is&nbsp;<a href=\"https://en.wikipedia.org/wiki/SpaceX\" title=\"SpaceX\">SpaceX</a>. The total cost of the satellite was projected to be 248 million US dollars in 2015 (Tk 19.51&nbsp;billion), financed via a $188.7 million loan from&nbsp;<a href=\"https://en.wikipedia.org/wiki/HSBC\" title=\"HSBC\">HSBC Holdings plc</a><sup><a href=\"https://en.wikipedia.org/wiki/Bangabandhu-1#cite_note-4\">[4]</a></sup>.. Bangabandhu Satellite-1 carries a total of 40&nbsp;<a href=\"https://en.wikipedia.org/wiki/Ku_band\" title=\"Ku band\">Ku-band</a>&nbsp;and&nbsp;<a href=\"https://en.wikipedia.org/wiki/C_band_(IEEE)\" title=\"C band (IEEE)\">C-band</a>transponders with a capacity of 1600 megahertz and a predicted life span to exceed 15 years.<sup><a href=\"https://en.wikipedia.org/wiki/Bangabandhu-1#cite_note-5\">[5]</a></sup><sup><a href=\"https://en.wikipedia.org/wiki/Bangabandhu-1#cite_note-6\">[6]</a></sup><sup><a href=\"https://en.wikipedia.org/wiki/Bangabandhu-1#cite_note-7\">[7]</a></sup><sup><a href=\"https://en.wikipedia.org/wiki/Bangabandhu-1#cite_note-8\">[8]</a></sup>&nbsp;The satellite will expand Ku-band coverage over all of Bangladesh and its nearby waters including the Bay of Bengal, India, Nepal, Bhutan, Sri Lanka, the Philippines, and Indonesia. This is coupled with C-band coverage for all aforementioned areas.</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `cat_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `name`, `cat_status`) VALUES
(9, 'acteress', 1),
(10, 'Bangladesh', 1),
(13, 'satelite', 1);

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `logo_id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`logo_id`, `image`) VALUES
(19, 'img/slogo.png');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menu_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `name`, `content`, `status`) VALUES
(4, 'About Us', '<p><img alt=\"parsonal\" src=\"img/sharif.jpg\" style=\"border-style:solid; border-width:1px; height:200px; margin:2px; width:200px\" />Aliquam massa urna, imperdiet sit amet mi non, bibendum euismod est. Curabitur mi justo, tincidunt vel eros ullamcorper, porta cursus justo. Cras vel neque eros. Vestibulum diam quam, mollis at magna consectetur non, malesuada quis augue. Morbi tincidunt pretium interdum est. Curabitur mi justo, tincidunt vel eros ullamcorper, porta cursus justo. Cras vel neque eros. Vestibulum diam.</p>\r\n', 1),
(5, 'Contact Us', '<p>Sed tristique purus vitae volutpat commodo suscipit amet sed nibh. Proin a ullamcorper sed blandit. Sed tristique purus vitae volutpat commodo suscipit ullamcorper commodo suscipit amet sed nibh. Proin a ullamcorper sed blandit..</p>\r\n', 1),
(9, 'service', '<p>Sed tristique purus vitae volutpat commodo suscipit amet sed nibh. Proin a ullamcorper sed blandit. Sed tristique purus vitae volutpat commodo suscipit ullamcorper commodo suscipit amet sed nibh. Proin a ullamcorper sed blandit..</p>\r\n', 1),
(27, 'service 1', '<p>javascript ,php</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `role` enum('subscriber','Admin','moderator','editor','author','contributor') NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `profile_pic`, `email`, `password`, `role`, `status`) VALUES
(8, 'shariful islam khan', 'img/IMG_20180225_181115.jpg', 'sharif@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Admin', 1),
(33, 'masud alam', 'img/masud_sir.jpg', 'masud@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`art_id`) USING BTREE,
  ADD KEY `cat_id` (`cat_id`) USING BTREE;

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`logo_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `logo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
