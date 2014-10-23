-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 11, 2014 at 12:25 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `movie_rating_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_tbl`
--

CREATE TABLE IF NOT EXISTS `login_tbl` (
  `user_id` int(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `user_previleges` enum('normal','admin') NOT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `login_tbl`
--

INSERT INTO `login_tbl` (`user_id`, `email`, `password`, `user_previleges`, `name`) VALUES
(1, 'mm@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', 'mahmud'),
(2, 'z@g.com', '81dc9bdb52d04dc20036dbd8313ed055', 'normal', 'zia'),
(7, 'a@a', '202cb962ac59075b964b07152d234b70', 'normal', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `movie_pic_tbl`
--

CREATE TABLE IF NOT EXISTS `movie_pic_tbl` (
  `movie_id` int(11) NOT NULL,
  `image_path_original` text NOT NULL,
  `picture_id` int(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`picture_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `movie_pic_tbl`
--


-- --------------------------------------------------------

--
-- Table structure for table `movie_rating_rel_tbl`
--

CREATE TABLE IF NOT EXISTS `movie_rating_rel_tbl` (
  `movie_id` int(20) NOT NULL,
  `rating` float NOT NULL,
  `rating_id` int(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`rating_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `movie_rating_rel_tbl`
--


-- --------------------------------------------------------

--
-- Table structure for table `movie_tbl`
--

CREATE TABLE IF NOT EXISTS `movie_tbl` (
  `movie_id` int(20) NOT NULL AUTO_INCREMENT,
  `movie_name` varchar(20) NOT NULL,
  `movie_description` text NOT NULL,
  `movie_category` varchar(20) NOT NULL,
  `image_path_thumble` text NOT NULL,
  PRIMARY KEY (`movie_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `movie_tbl`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
