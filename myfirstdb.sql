-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 11, 2021 at 10:01 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myfirstdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `s00001`
--

DROP TABLE IF EXISTS `s00001`;
CREATE TABLE IF NOT EXISTS `s00001` (
  `year` int(11) NOT NULL,
  `exam` varchar(25) NOT NULL,
  `Sinhala` decimal(4,2) DEFAULT NULL,
  `English` decimal(4,2) DEFAULT NULL,
  `Mathematics` decimal(4,2) DEFAULT NULL,
  `Science` decimal(4,2) DEFAULT NULL,
  `IT` decimal(4,2) DEFAULT NULL,
  `Commerce` decimal(4,2) DEFAULT NULL,
  `History` decimal(4,2) DEFAULT NULL,
  PRIMARY KEY (`year`,`exam`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `s00001`
--

INSERT INTO `s00001` (`year`, `exam`, `Sinhala`, `English`, `Mathematics`, `Science`, `IT`, `Commerce`, `History`) VALUES
(2021, 'First Term', '78.00', '82.00', '90.00', '75.00', '72.00', '63.00', '60.00');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `sid` varchar(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `tp` int(11) NOT NULL,
  `bd` date NOT NULL,
  `index_no` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`index_no`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`sid`, `fname`, `lname`, `address`, `tp`, `bd`, `index_no`) VALUES
('S00001', 'Ravinudu', 'Jayasekara', 'Colombo', 112548985, '2006-06-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

DROP TABLE IF EXISTS `tblusers`;
CREATE TABLE IF NOT EXISTS `tblusers` (
  `uid` varchar(10) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `index_no` int(11) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`uid`, `uname`, `password`, `type`, `index_no`) VALUES
('U001', 'Anushna Jayathunga', 'anushna', 'Admin', 1),
('U002', 'Akash Raj', 'akash', 'Admin', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
