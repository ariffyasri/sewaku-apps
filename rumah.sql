-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2016 at 09:44 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rumah`
--

-- --------------------------------------------------------

--
-- Table structure for table `rumah_expense`
--

CREATE TABLE `rumah_expense` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `type` varchar(50) NOT NULL,
  `image` text NOT NULL,
  `cost` double(4,2) NOT NULL,
  `post_from` varchar(100) NOT NULL,
  `charge_to` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_paid` datetime NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rumah_expense`
--

INSERT INTO `rumah_expense` (`id`, `title`, `type`, `image`, `cost`, `post_from`, `charge_to`, `date_added`, `date_paid`, `status`) VALUES
(12, 'DASAS', 'Bill', '', 0.00, 'ariff', 'zarulizham', '2016-04-29 11:30:00', '0000-00-00 00:00:00', 'Unpaid'),
(11, 'dasdas', 'Bill', '', 6.00, 'zarulizham', 'ariff', '2016-04-29 11:15:00', '2016-04-29 11:11:15', 'Paid'),
(13, 'dasdas', 'Makanan', '', 6.00, 'ariff', 'zarulizham', '2016-04-29 15:15:00', '0000-00-00 00:00:00', 'Unpaid'),
(14, 'dasdas', 'Makanan', '', 6.00, 'ariff', 'zarulizham', '2016-04-29 15:15:00', '0000-00-00 00:00:00', 'Unpaid'),
(15, 'dasdas', 'Makanan', '', 6.00, 'ariff', 'zarulizham', '2016-04-29 15:15:00', '0000-00-00 00:00:00', 'Unpaid'),
(16, 'dasdas', 'Makanan', '', 6.00, 'ariff', 'zarulizham', '2016-04-29 15:15:00', '0000-00-00 00:00:00', 'Unpaid'),
(17, 'dasdas', 'Makanan', '17.jpg', 6.00, 'ariff', 'zarulizham', '2016-04-29 15:15:00', '0000-00-00 00:00:00', 'Unpaid'),
(18, 'dasdas', 'Bill', '18.jpg', 6.00, 'ariff', 'zarulizham', '2016-04-29 15:30:00', '0000-00-00 00:00:00', 'Unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `rumah_user`
--

CREATE TABLE `rumah_user` (
  `uname` varchar(50) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `date_registered` datetime NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rumah_user`
--

INSERT INTO `rumah_user` (`uname`, `pwd`, `name`, `email`, `phone`, `date_registered`, `status`) VALUES
('zarulizham', '$2y$10$C2ZLb4kB06yFBAP2LsdOzeI8QrHSWrjwuKGM9/9F9nkLYLYPN3Mqq', 'Adsaddas', 'zarulizham@gmail.com', '60146296947', '2016-04-29 11:08:36', 'ACTIVE'),
('ariff', '$2y$10$3ryWdQZlv/F.V5/UnR4UROctctRkG5xrfCHy5IjkBhu2R5NUXlt22', 'Muhammad Ariff Bin Yasri', 'ariffacm@gmail.com', '60146296947', '2016-04-29 09:41:27', 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rumah_expense`
--
ALTER TABLE `rumah_expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rumah_user`
--
ALTER TABLE `rumah_user`
  ADD PRIMARY KEY (`uname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rumah_expense`
--
ALTER TABLE `rumah_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
