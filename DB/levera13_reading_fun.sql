-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 17, 2017 at 11:27 PM
-- Server version: 5.6.37-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `levera13_reading_fun`
--

-- --------------------------------------------------------

--
-- Table structure for table `api`
--

CREATE TABLE `api` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `url` varchar(128) NOT NULL,
  `key` varchar(64) NOT NULL,
  `isDefault` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`id`, `name`, `url`, `key`, `isDefault`, `active`) VALUES
(5, 'google', 'https://www.googleapis.com/books/v1/volumes', 'AIzaSyB9hggeAJWYRXv9FhmsedHot_AC8MiWbg8', 1, 1),
(6, 'amazon', 'https://www.amazon.com/dp/', 'readi01c-20', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

CREATE TABLE `badges` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `title` varchar(32) NOT NULL,
  `points` int(32) NOT NULL,
  `badge_img` varchar(128) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `badges`
--

INSERT INTO `badges` (`id`, `name`, `title`, `points`, `badge_img`, `active`) VALUES
(4, 'badge_1', 'Badge 1', 100, 'badge_1.png', 1),
(5, 'badge_2', 'Badge 2', 200, 'badge_2.png', 1),
(6, 'badge_3', 'Badge 3', 220, 'badge_3.png', 1),
(7, 'badge_4', 'Badge 4', 700, 'badge_4.png', 1),
(8, 'badge_5', 'Badge 5', 1000, 'badge_5.png', 1),
(9, 'badge_6', 'Badge 6', 1300, 'badge_6.png', 1),
(10, 'badge_7', 'Badge 7', 1500, 'badge_7.png', 1),
(11, 'badge_8', 'Badge 8', 1800, 'badge_8.png', 1),
(12, 'badge_9', 'Badge 9', 2000, 'badge_9.png', 1),
(13, 'badge_10', 'Badge 10', 2002, 'badge_10.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `author` varchar(128) NOT NULL,
  `isbn` varchar(32) NOT NULL,
  `library_id` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `isbn`, `library_id`, `active`) VALUES
(1, 'Mighty, Mighty Construction Site', 'Sherri Duskey Rinker', '9781452152165', 0, 1),
(2, 'If You Give a Mouse a Brownie', 'Laura Numeroff', '9780060275716', 0, 1),
(3, 'Happy Birthday, Cupcake!', 'Terry Border', '9780399171604', 0, 1),
(4, 'Please, Mr. Panda', 'Steve Antony', '9780545788922', 0, 1),
(5, 'The 1989 World Book year book', 'Robert O. Zeleny', '9780716604891', 0, 1),
(15, 'The Kingdom Beyond the Waves', 'Stephen Hunt', '9780007232208', 0, 1),
(16, 'Escapement', 'Jay Lake', '9780765317094', 0, 1),
(17, 'A Transatlantic Tunnel, Hurrah!', 'Harry Harrison', '9780575071346', 0, 1),
(18, 'The State of Jones', 'Sally Jenkins', '9780441779246', 0, 1),
(19, 'Animals Make Us Human', 'Temple Grandin', '9780151014897', 0, 1),
(20, 'House of Penance', 'Peter J. Tomasi', '9781506700335', 0, 1),
(21, 'Diary of a Wimpy Kid # 4 - Dog Days', 'Jeff Kinney', '9780810983915', 0, 1),
(22, 'The Captain Underpants Super Collection', 'Dav Pilkey', '9780439376105', 0, 1),
(23, 'Stink and the World\'s Worst Super-stinky Sneakers', 'Megan McDonald', '9780763628345', 0, 1),
(24, 'Dreams of Joy', 'Lisa See', '1408826119', 0, 1),
(25, 'The Curious Incident of the Dog in the Night-Time', 'Mark Haddon', '0307371565', 0, 1),
(26, 'The Drifter', 'Christine Lennon', '9780062457578', 0, 1),
(27, 'The Help', 'Kathryn Stockett', '0399155341', 0, 1),
(28, 'On Gold Mountain', 'Lisa See', '1101910089', 0, 1),
(29, 'The Giving Tree', 'Shel Silverstein', '0061965103', 0, 1),
(30, 'Notes from the Underground', 'Fyodor Dostoyevsky', '3736802579', 0, 1),
(31, 'Falling Up', 'Shel Silverstein', '0001857177', 0, 1),
(32, 'Did I Ever Tell You How Lucky You Are?', 'Seuss', '0385379331', 0, 1),
(34, 'The Autobiography of Malcolm X', 'Malcolm X', '1101967803', 0, 1),
(35, 'The Eleventh Commandment', 'Jeffrey Archer', '1447203003', 0, 1),
(36, 'The Adventures of Tom Sawyer', 'Mark Twain', 'UVA:X000311246', 0, 1),
(37, 'Data Mining: Concepts and Techniques', 'Jiawei Han', '9780123814807', 0, 1),
(38, 'The Help', 'Kathryn Stockett', '0399585400', 0, 1),
(39, 'A Man and His Watch', 'Matt Hranek', '1579658199', 0, 1),
(40, 'The Google Story', 'David A. Vise', '0553383663', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'readers', 'Readers'),
(3, 'library-admin', 'admin for individual library');

-- --------------------------------------------------------

--
-- Table structure for table `libraries`
--

CREATE TABLE `libraries` (
  `library_id` int(11) NOT NULL,
  `library_name` text NOT NULL,
  `library_slug` text NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `zip` varchar(255) NOT NULL,
  `type` enum('self','subdomain') NOT NULL DEFAULT 'self',
  `settings` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `libraries`
--

INSERT INTO `libraries` (`library_id`, `library_name`, `library_slug`, `email`, `address`, `city`, `state`, `zip`, `type`, `settings`, `created_by`, `created_on`, `status`) VALUES
(1, 'sdasda', 'ddddddddd', 'suwwwrakshsssssa@flavoursclub.in', 'undefined', 'Lucknow', 'UP', '58655555', 'subdomain', '', 30, '2017-11-26 11:21:28', '1'),
(2, 'Test', '12ss', 'surakshawww@flavoursclub.in', '2235 Massachusetts Avenue', 'Cambridge', 'MA', '02140', 'subdomain', '', 31, '2017-11-27 08:12:08', '1'),
(3, 'Test', 'test', 'debasishpaul007@gmail.com', '1235 Princes Highway', 'Heathmere', 'VIC', '3305', 'subdomain', '', 34, '2017-11-30 06:22:08', '1'),
(4, 'Test 2', 'test2', 'test@flavoursclub.in', '1235 Princes Highway', 'Heathmere', 'VIC', '3305', 'subdomain', '', 36, '2017-12-03 04:44:31', '1'),
(5, 'Pewaukee Public Library', 'pwkpl', 'johndoe@gml.com', '210 Main Street', 'Pewaukee', 'WI', '53072', 'subdomain', '', 38, '2017-12-08 09:54:29', '1'),
(6, 'Test 2 ', 'abcd', 'abcd@flavoursclub.in', '1235 Princes Highway', 'Heathmere', 'VIC', '3305', 'subdomain', '', 39, '2017-12-10 08:19:05', '1'),
(7, 'HELLO', 'hello', 'hello@hello.com', '1 University Circle', 'Macomb', 'IL', '61455', 'subdomain', '', 41, '2017-12-12 08:14:25', '1'),
(8, 'Tony', '', 'joejoe@gmail.com', '1241 East Rand Road', 'Prospect Heights', 'IL', '60070', 'self', '', 42, '2017-12-12 08:26:23', '1'),
(9, 'mylab', '', 'mylab@flavoursclub.in', '1230 U.S. Highway 1', 'Warwick', 'RI', '02888', 'self', '', 47, '2017-12-13 03:24:26', '1');

-- --------------------------------------------------------

--
-- Table structure for table `library_settings`
--

CREATE TABLE `library_settings` (
  `library_settings_id` int(11) NOT NULL,
  `library_id` int(11) NOT NULL,
  `general_settings` text,
  `point_settings` text,
  `badges_settings` text,
  `style_settings` text,
  `current_logo` text,
  `current_video` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `library_settings`
--

INSERT INTO `library_settings` (`library_settings_id`, `library_id`, `general_settings`, `point_settings`, `badges_settings`, `style_settings`, `current_logo`, `current_video`) VALUES
(1, 2, '[{\"id\":\"1\",\"name\":\"show_readers\",\"is_active\":\"1\"},{\"id\":\"2\",\"name\":\"show_video\",\"is_active\":\"1\"},{\"id\":\"3\",\"name\":\"show_school\",\"is_active\":\"1\"},{\"id\":\"4\",\"name\":\"show_book\",\"is_active\":\"1\"},{\"id\":\"5\",\"name\":\"no_of_readers\",\"is_active\":\"12\"},{\"id\":\"6\",\"name\":\"no_of_books\",\"is_active\":\"12\"},{\"id\":\"7\",\"name\":\"no_of_latest_books\",\"is_active\":\"12\"},{\"id\":\"8\",\"name\":\"no_of_schools\",\"is_active\":\"12\"},{\"id\":\"9\",\"name\":\"show_latest_book\",\"is_active\":\"1\"}]', '[{\"id\":\"2\",\"is_active\":1,\"point\":\"120\"},{\"id\":\"3\",\"is_active\":1,\"point\":\"4\"}]', '[{\"id\":\"4\",\"is_active\":1,\"point\":\"100\"},{\"id\":\"5\",\"is_active\":1,\"point\":\"200\"},{\"id\":\"6\",\"is_active\":1,\"point\":\"220\"},{\"id\":\"7\",\"is_active\":1,\"point\":\"700\"},{\"id\":\"8\",\"is_active\":1,\"point\":\"1000\"},{\"id\":\"9\",\"is_active\":1,\"point\":\"1300\"},{\"id\":\"10\",\"is_active\":1,\"point\":\"1500\"},{\"id\":\"11\",\"is_active\":1,\"point\":\"1800\"},{\"id\":\"12\",\"is_active\":1,\"point\":\"2000\"},{\"id\":\"13\",\"is_active\":1,\"point\":\"2002\"}]', '{\"menu_color\":\"#a188e1\",\"menu_color_hover\":\"#20ba17\",\"body_font_size\":\"14\",\"title_font_size\":\"20\",\"body_link_color\":\"#e30808\"}', 'assets/new/images/library_icon/2/logo_be3d8348d9cae905e8982ba7f4775604.png', 'assets/new/video/library_video/2/nursery.mp4'),
(2, 3, '[{\"id\":\"1\",\"name\":\"show_readers\",\"is_active\":\"1\"},{\"id\":\"2\",\"name\":\"show_video\",\"is_active\":\"1\"},{\"id\":\"3\",\"name\":\"show_school\",\"is_active\":\"1\"},{\"id\":\"4\",\"name\":\"show_book\",\"is_active\":\"1\"},{\"id\":\"5\",\"name\":\"no_of_readers\",\"is_active\":\"12\"},{\"id\":\"6\",\"name\":\"no_of_books\",\"is_active\":\"12\"},{\"id\":\"7\",\"name\":\"no_of_latest_books\",\"is_active\":\"12\"},{\"id\":\"8\",\"name\":\"no_of_schools\",\"is_active\":\"2\"},{\"id\":\"9\",\"name\":\"show_latest_book\",\"is_active\":\"1\"}]', '[{\"id\":\"2\",\"is_active\":1,\"point\":\"120\"},{\"id\":\"3\",\"is_active\":1,\"point\":\"1\"}]', '[{\"id\":\"4\",\"is_active\":1,\"point\":\"222\"},{\"id\":\"5\",\"is_active\":1,\"point\":\"234\"},{\"id\":\"6\",\"is_active\":1,\"point\":\"211\"},{\"id\":\"7\",\"is_active\":0,\"point\":\"\"},{\"id\":\"8\",\"is_active\":0,\"point\":\"\"},{\"id\":\"9\",\"is_active\":0,\"point\":\"\"},{\"id\":\"10\",\"is_active\":0,\"point\":\"\"},{\"id\":\"11\",\"is_active\":0,\"point\":\"\"},{\"id\":\"12\",\"is_active\":0,\"point\":\"\"},{\"id\":\"13\",\"is_active\":0,\"point\":\"\"}]', NULL, NULL, NULL),
(3, 4, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 5, '[{\"id\":\"1\",\"name\":\"show_readers\",\"is_active\":\"1\"},{\"id\":\"2\",\"name\":\"show_video\",\"is_active\":\"0\"},{\"id\":\"3\",\"name\":\"show_school\",\"is_active\":\"1\"},{\"id\":\"4\",\"name\":\"show_book\",\"is_active\":\"1\"},{\"id\":\"5\",\"name\":\"no_of_readers\",\"is_active\":\"12\"},{\"id\":\"6\",\"name\":\"no_of_books\",\"is_active\":\"12\"},{\"id\":\"7\",\"name\":\"no_of_latest_books\",\"is_active\":\"12\"},{\"id\":\"8\",\"name\":\"no_of_schools\",\"is_active\":\"12\"},{\"id\":\"9\",\"name\":\"show_latest_book\",\"is_active\":\"1\"}]', NULL, '[{\"id\":\"4\",\"is_active\":1,\"point\":\"1\"},{\"id\":\"5\",\"is_active\":1,\"point\":\"50\"},{\"id\":\"6\",\"is_active\":1,\"point\":\"100\"},{\"id\":\"7\",\"is_active\":1,\"point\":\"150\"},{\"id\":\"8\",\"is_active\":0,\"point\":\"\"},{\"id\":\"9\",\"is_active\":0,\"point\":\"\"},{\"id\":\"10\",\"is_active\":0,\"point\":\"\"},{\"id\":\"11\",\"is_active\":0,\"point\":\"\"},{\"id\":\"12\",\"is_active\":0,\"point\":\"\"},{\"id\":\"13\",\"is_active\":0,\"point\":\"\"}]', NULL, NULL, NULL),
(5, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 8, '[{\"id\":\"1\",\"name\":\"show_readers\",\"is_active\":\"1\"},{\"id\":\"2\",\"name\":\"show_video\",\"is_active\":\"1\"},{\"id\":\"3\",\"name\":\"show_school\",\"is_active\":\"0\"},{\"id\":\"4\",\"name\":\"show_book\",\"is_active\":\"1\"},{\"id\":\"5\",\"name\":\"no_of_readers\",\"is_active\":\"0\"},{\"id\":\"6\",\"name\":\"no_of_books\",\"is_active\":\"0\"},{\"id\":\"7\",\"name\":\"no_of_latest_books\",\"is_active\":\"0\"},{\"id\":\"8\",\"name\":\"no_of_schools\",\"is_active\":\"0\"},{\"id\":\"9\",\"name\":\"show_latest_book\",\"is_active\":\"1\"}]', NULL, NULL, '{\"menu_color\":\"#000000\",\"menu_color_hover\":\"#69fa03\",\"body_font_size\":\"12\",\"title_font_size\":\"16\",\"body_link_color\":\"#23527c\"}', NULL, NULL),
(8, 9, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `title` varchar(32) NOT NULL,
  `points` int(2) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`id`, `name`, `title`, `points`, `active`) VALUES
(2, 'signup', 'Signup', 120, 0),
(3, 'read', 'Per Minute Reading', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `readers_books`
--

CREATE TABLE `readers_books` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `duration` int(2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `readers_books`
--

INSERT INTO `readers_books` (`id`, `user_id`, `book_id`, `duration`, `date`) VALUES
(13, 7, 16, 32, '0000-00-00'),
(14, 7, 17, 34, '0000-00-00'),
(15, 7, 18, 44, '0000-00-00'),
(17, 9, 5, 43, '0000-00-00'),
(18, 7, 19, 21, '0000-00-00'),
(19, 9, 20, 21, '0000-00-00'),
(20, 9, 21, 34, '0000-00-00'),
(21, 9, 22, 12, '0000-00-00'),
(22, 7, 23, 12, '0000-00-00'),
(23, 7, 24, 23, '0000-00-00'),
(24, 7, 25, 30, '0000-00-00'),
(25, 15, 24, 30, '0000-00-00'),
(26, 15, 26, 12, '0000-00-00'),
(27, 7, 27, 23, '2017-03-03'),
(29, 7, 15, 10, '2017-03-13'),
(30, 7, 15, 30, '2017-03-13'),
(31, 7, 15, 9, '2017-03-13'),
(32, 7, 15, 20, '2017-03-13'),
(33, 7, 5, 20, '2017-03-13'),
(34, 7, 28, 30, '2017-03-15'),
(35, 15, 29, 23, '2017-03-18'),
(36, 17, 30, 120, '2017-03-18'),
(37, 18, 31, 32, '2017-03-18'),
(38, 18, 32, 23, '2017-03-18'),
(40, 15, 34, 150, '2017-03-20'),
(41, 15, 35, 30, '2017-03-22'),
(42, 15, 29, 60, '2017-03-22'),
(43, 7, 36, 90, '2017-03-24'),
(44, 7, 34, 32, '2017-03-24'),
(45, 7, 37, 43, '2017-04-01'),
(46, 7, 38, 45, '2017-04-25'),
(47, 7, 38, 20, '2017-05-27'),
(48, 7, 23, 30, '2017-10-13'),
(49, 40, 39, 30, '2017-12-11'),
(50, 40, 40, 40, '2017-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `readers_points`
--

CREATE TABLE `readers_points` (
  `id` int(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  `point_id` int(11) NOT NULL,
  `points` int(3) NOT NULL DEFAULT '0',
  `readers_book_id` int(11) DEFAULT NULL,
  `added_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `readers_points`
--

INSERT INTO `readers_points` (`id`, `user_id`, `point_id`, `points`, `readers_book_id`, `added_on`) VALUES
(6, 7, 3, 0, 12, '0000-00-00'),
(7, 7, 3, 0, 13, '0000-00-00'),
(8, 7, 3, 0, 14, '0000-00-00'),
(9, 7, 3, 32, 15, '0000-00-00'),
(11, 9, 3, 0, 17, '0000-00-00'),
(12, 7, 3, 0, 18, '0000-00-00'),
(13, 9, 3, 0, 19, '0000-00-00'),
(14, 9, 3, 0, 20, '0000-00-00'),
(15, 9, 3, 0, 21, '0000-00-00'),
(16, 7, 3, 0, 22, '0000-00-00'),
(17, 5, 0, 40, NULL, '0000-00-00'),
(18, 5, 0, 50, NULL, '0000-00-00'),
(19, 7, 3, 0, 23, '0000-00-00'),
(20, 7, 3, 0, 24, '0000-00-00'),
(21, 15, 3, 0, 25, '0000-00-00'),
(22, 15, 3, 0, 26, '0000-00-00'),
(23, 7, 3, 0, 27, '2017-10-03'),
(24, 7, 3, 0, 28, '1969-12-31'),
(25, 7, 3, 0, 29, '2017-03-13'),
(26, 7, 3, 0, 30, '2017-03-13'),
(27, 7, 3, 0, 31, '2017-03-13'),
(28, 7, 3, 0, 32, '2017-03-13'),
(30, 7, 3, 0, 34, '2017-03-15'),
(31, 5, 0, 10, NULL, '0000-00-00'),
(32, 15, 3, 0, 35, '2017-03-18'),
(33, 17, 3, 0, 36, '2017-03-18'),
(34, 18, 3, 0, 37, '2017-03-18'),
(35, 18, 3, 0, 38, '2017-03-18'),
(36, 19, 3, 0, 39, '2017-03-16'),
(37, 15, 3, 0, 40, '2017-03-20'),
(38, 15, 3, 0, 41, '2017-03-22'),
(39, 15, 3, 0, 42, '2017-03-22'),
(40, 9, 0, 50, NULL, '0000-00-00'),
(41, 15, 0, 700, NULL, '0000-00-00'),
(42, 7, 0, 50, NULL, '0000-00-00'),
(43, 7, 3, 0, 43, '2017-03-24'),
(44, 7, 3, 0, 44, '2017-03-24'),
(45, 7, 3, 0, 45, '2017-04-01'),
(46, 7, 3, 0, 46, '2017-04-25'),
(47, 7, 3, 0, 47, '2017-05-27'),
(48, 7, 3, 0, 48, '2017-10-13'),
(49, 32, 0, 44, NULL, '0000-00-00'),
(50, 33, 0, 500, NULL, '0000-00-00'),
(51, 40, 3, 0, 49, '2017-12-11'),
(52, 40, 3, 0, 50, '2017-12-12'),
(53, 40, 0, 100, NULL, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `street` varchar(64) NOT NULL,
  `city` varchar(32) NOT NULL,
  `state` varchar(4) NOT NULL,
  `zip` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `street`, `city`, `state`, `zip`) VALUES
(1, 'Western Illinois University', '1 University Circle', 'Macomb', 'IL', 61455),
(2, 'The Dalton School', '108 East 89th Street', 'New York', 'NY', 10128),
(4, 'California Elementary School', '3232 California Street', 'Costa Mesa', 'CA', 92626),
(5, 'Michigan State University', '220 Trowbridge Rd', 'East Lansing', 'MI', 48824),
(6, 'The University of Chicago', '5801 South Ellis Avenue', 'Chicago', 'IL', 60637),
(7, 'Macomb High School', 'Macomb', 'Macomb', 'IL', 61455),
(8, 'Edison Elementary School', '521 South Pearl Street', 'Macomb', 'IL', 61455),
(9, 'Macomb Junior High School', '1525 South Johnson Street', 'Macomb', 'IL', 61455),
(10, 'St Paul Catholic School', '322 West Washington Street', 'Macomb', 'IL', 61455),
(12, 'Test School', '3233 Burnt Mill Drive', 'Wilmington', 'NC', 28403),
(13, 'Test new school', '1235 Princes Highway', 'Heathmere', 'VIC', 3305),
(14, 'Pewaukee High School', '510 Lake Street', 'Pewaukee', 'WI', 53072),
(15, 'Hello', '1 University Circle', 'Macomb', 'IL', 61455),
(16, 'Macomb Public School', 'undefined Charles Street', 'Matteson', 'IL', 60443);

-- --------------------------------------------------------

--
-- Table structure for table `school_library_relation`
--

CREATE TABLE `school_library_relation` (
  `relation_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `library_id` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_library_relation`
--

INSERT INTO `school_library_relation` (`relation_id`, `school_id`, `library_id`, `status`) VALUES
(1, 12, 2, '1'),
(2, 13, 3, '1'),
(3, 14, 5, '1'),
(4, 15, 7, '1'),
(5, 16, 5, '1');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(8) NOT NULL,
  `name` varchar(32) NOT NULL,
  `value` int(2) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `active`) VALUES
(1, 'show_readers', 1, 1),
(2, 'show_video', 0, 1),
(3, 'show_school', 0, 1),
(4, 'show_book', 1, 1),
(5, 'no_of_readers', 12, 1),
(6, 'no_of_books', 12, 1),
(7, 'no_of_latest_books', 12, 1),
(8, 'no_of_schools', 12, 1),
(9, 'show_latest_book', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` date NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `avatar` varchar(64) DEFAULT NULL,
  `gender` varchar(8) DEFAULT NULL,
  `address_id` varchar(128) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `apt` varchar(8) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `school_id` int(8) DEFAULT '-1',
  `library_id` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `in_city` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `avatar`, `gender`, `address_id`, `address`, `apt`, `city`, `state`, `zip`, `birthdate`, `school_id`, `library_id`, `phone`, `in_city`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$.aU8a5pgwOdzGRNMawXi6.qykid6fsXPdiL4KfHcsrGVXPmW4qnlW', '', 'admin@admin.com', '', NULL, NULL, NULL, '2017-02-26', 1513572494, 1, 'Admin', 'istrator', 'boy-9.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12345', '0', 1),
(5, '::1', 'fimaruf@outlook.com', '$2y$08$UNJz2bP6.cCuR5e9wU446uMXeiTrc5/7f0dtzL.0KgQZKnzAPda1m', NULL, 'fimaruf@outlook.com', NULL, NULL, NULL, NULL, '0000-00-00', NULL, 1, 'Fakhrul', 'Maruf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1),
(7, '::1', 'fimaruf@gmail.com', '$2y$08$zeGW9NYJCtLSUgBabPfTq.owRZxBrnkOsBp8wL3gZDDzkcQKR4Eka', NULL, 'fimaruf@gmail.com', NULL, '7eVipVG6PR961v4c-9bwKu73434b7b7f8d6ae9bc', 1489871434, NULL, '2017-02-26', 1508169253, 1, 'Md Fakhrul', 'Islam', 'boy-4.png', 'male', 'Eic5MTEgTiBDaGFybGVzIFN0LCBNYWNvbWIsIElMIDYxNDU1LCBVU0E', '911 North Charles Street', '17', 'Macomb', 'IL', 61455, '1982-03-11', 1, '54321', '(309) 569-1974', 1),
(9, '::1', 'netexbd@gmail.com', '$2y$08$P31MydWyo1eOaJX6ZMwxb.r63narw5eiRBVQrJg.P52BLhj.gwP0G', NULL, 'netexbd@gmail.com', NULL, NULL, NULL, NULL, '2017-02-26', 1488151969, 1, 'Fakhrul', 'Maruf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '654321', NULL, 1),
(15, '::1', 'rumana@gmail.com', '$2y$08$NLkEbj9BiJLrQs5FEAtPNOFSR9669k9LgL2iUuGkr2qLY15WD3k8a', NULL, 'rumana@gmail.com', NULL, '7eVipVG6PR961v4c-9bwKu73434b7b7f8d6ae9bc', 1489871434, NULL, '2017-03-05', 1490422485, 1, 'Rumana', 'Afroz', 'girl-10.png', 'female', 'ChIJpXRA1q_w4IcRr-Z7yjr5rFw', '923 West Carroll Street', '1', 'Macomb', 'IL', 61455, '1990-03-18', 5, '', '(309) 569-7867', 1),
(16, '::1', 'bil@gmai.com', '$2y$08$/p9Ab/om.P0X5R/hZ6VnLu/GXCoabchiP6cNcwMnPUwnc0ZDtZCue', NULL, 'bil@gmai.com', NULL, NULL, NULL, NULL, '2017-03-16', NULL, 1, 'Bill', 'Gates', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1),
(17, '104.173.76.22', 'wforbes87@gmail.com', '$2y$08$6XbMRH.14T/.sj6Bf6RzqeIkbZR11sD49/QTBSj89BJDvKc8/MpKu', NULL, 'wforbes87@gmail.com', NULL, NULL, NULL, NULL, '2017-03-18', 1489867734, 1, 'Will', 'Forbes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, 1),
(18, '173.240.202.205', 'leverage.infotech@gmail.com', '$2y$08$MD9tBrw.e7Ik1IX7MhTjvuwpC5Z9My8QMvcnmeM3l5IQ/wLZ39T/W', NULL, 'leverage.infotech@gmail.com', NULL, NULL, NULL, NULL, '2017-03-18', 1489872709, 1, 'Leverage', 'Infotech', 'boy-3.png', 'male', 'ChIJE4pPFl0zDogRnZ86Pn2X18k', '5681 West Madison Street', '', 'Chicago', 'IL', 60644, '1995-03-18', 4, '', '', 1),
(19, '143.43.165.139', 'mk-clemmens@wiu.edu', '$2y$08$XwY6/IYi1hc1hpGnEasrS.RltbzAt7eBoO5K2mViMuMKKIakfzSwy', NULL, 'mk-clemmens@wiu.edu', NULL, NULL, NULL, NULL, '2017-03-20', 1490222430, 1, 'Matt', 'Clemmens', 'boy-8.png', 'male', 'ChIJ9wE-t0734IcRD9WsfWrjVy8', '335 South Lafayette Street', '', 'Macomb', 'IL', 61455, '1993-09-04', 7, '43235235234', '(309) 093-4444', 1),
(20, '127.0.0.1', 'debasishpaul2014@gmail.com', '$2y$08$.aU8a5pgwOdzGRNMawXi6.qykid6fsXPdiL4KfHcsrGVXPmW4qnlW', NULL, 'suraksha@flavoursclub.in', NULL, NULL, NULL, NULL, '2017-11-24', 1513108710, 1, 'Debasish', 'Paul', NULL, 'male', 'ChIJLfJxWc_KvJURMY-zlimHfCw', '1123 Avenida Corrientes', '1', 'Kolkata', 'CA', 0, '0000-00-00', 13, '', '(827) 297-6554', 1),
(23, '127.0.0.1', NULL, '$2y$08$dYoKse8N7PDQxuqeRUFPB.RHVy3G0F/uUZhY0o4cAUGD1RzOXUC1m', NULL, 'debasishpausssl2014@gmail.com', NULL, NULL, NULL, NULL, '2017-11-25', NULL, 1, 'ss', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(24, '127.0.0.1', NULL, '$2y$08$YQ/PJG4LFTrX486B6sVsLO5GllW8VKLZNYHvnSgzX2hwBVrEnGmzq', NULL, 'debasishpaulssssss2014@gmail.com', NULL, NULL, NULL, NULL, '2017-11-25', NULL, 1, 'Debasish', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(30, '::1', 'suwwwrakshsssssa@flavoursclub.in', '$2y$08$o05ucDHECEdV.xtKDBIyJe9omVvO0MuNw34BBFIKTG7GXFfU.Gjeu', NULL, 'suwwwrakshsssssa@flavoursclub.in', NULL, NULL, NULL, NULL, '2017-11-26', NULL, 1, 'asdasd', 'Paul', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, NULL, 1),
(31, '127.0.0.1', 'surakshawww@flavoursclub.in', '$2y$08$Bi0ciqZi3eTUgcO8xppNWurhDGu4LqIZ69exARxn/aBN6W8OU0ikO', NULL, 'surakshawww@flavoursclub.in', NULL, NULL, NULL, NULL, '2017-11-27', 1512408508, 1, 'Debasish', 'Paul', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, NULL, 1),
(32, '127.0.0.1', 'debasishpaul@gmail.com', '$2y$08$Oynu4om0pY2Gc50xUf7KUu.7VlafgUP2kYjb.Oy/KTqzE8UqVnr/a', NULL, 'debasishpaul@gmail.com', NULL, NULL, NULL, NULL, '2015-11-29', 1511938847, 1, 'Debasish', 'Paul', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, 1),
(33, '127.0.0.1', 'ani@gmail.com', '$2y$08$ej9d7EjklcvzITspP2rTJel18yCnMkflNW.lMmhnWR8ubB9VpNmUu', NULL, 'aninditadas1220@gmail.com', NULL, NULL, NULL, NULL, '2017-11-29', NULL, 1, 'Ani', 'Paul', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, 1),
(34, '127.0.0.1', 'debasishpaul007@gmail.com', '$2y$08$vc1FPI9OrT5Dk88QtiCDsOWhUVCJA5mZbf17xyrA3vsom5zbYyNoy', NULL, 'debasishpaul007@gmail.com', NULL, NULL, NULL, NULL, '2017-11-30', 1512113402, 1, 'Debasish', 'Paul', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, NULL, 1),
(35, '127.0.0.1', '123456@flavoursclub.in', '$2y$08$WMVb81Jj5Q3WKL3WzYhYruDXRc5iYCqf20Lr9/5roARc8Kw7u9xUO', NULL, '123456@flavoursclub.in', NULL, NULL, NULL, NULL, '2017-12-01', 1512376324, 1, 'Debasish', 'Paul', NULL, 'male', 'ChIJ9QbzkuWMnaoRLBpEFd4qDWM', '1235 Princes Highway', '', 'Heathmere', 'VI', 3305, '2017-12-03', 12, '22-CHER', '(827) 297-6554', 1),
(36, '127.0.0.1', 'test@flavoursclub.in', '$2y$08$B40PiISLHTiXh/Wl/UID3OtKIfG703e6Poyn5w/MEvxitZnQYDR3G', NULL, 'test@flavoursclub.in', NULL, NULL, NULL, NULL, '2017-12-03', 1512315892, 1, 'Debasish', 'Paul', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, NULL, 1),
(37, '127.0.0.1', '111@gmail.com', '$2y$08$Hn3Ryie3fz.HP9p1/NhVxu3DhiGb2yi0dPxxlMVCtArIynRF.3YQ6', NULL, '111@gmail.com', NULL, NULL, NULL, NULL, '2017-12-03', NULL, 1, 'Debasish', 'Paul', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, NULL, 1),
(38, '65.30.0.203', 'johndoe@gml.com', '$2y$08$P68jQYEWpzTRGJSOzfmJ7OqJCXX9b2TXDgOc/t0Jvx0wsZ3925iba', NULL, 'johndoe@gml.com', NULL, NULL, NULL, NULL, '2017-12-08', 1513142662, 1, 'John', 'Dow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, NULL, 1),
(39, '103.215.225.50', 'abcd@flavoursclub.in', '$2y$08$yPZjYj9Y1dexw8KAVA6b0eQi7HCInHX.A4ny0bh6Sea.4GCGN1ma6', NULL, 'abcd@flavoursclub.in', NULL, NULL, NULL, NULL, '2017-12-10', NULL, 1, 'Debasish', 'Paul', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, NULL, 1),
(40, '173.240.202.153', 'fakhrul.islam@gmail.com', '$2y$08$zWshk/RKTIsdpROnsIf5H.BJUMbgFolS.bnc/Cp9fi2tnVJveb9Oy', NULL, 'fakhrul.islam@gmail.com', NULL, NULL, NULL, NULL, '2017-12-11', 1513100949, 1, 'Md Fakhrul', 'Islam', 'boy-4.png', 'male', '', 'N16 W26593 Tall Reeds Ln', 'Unit D', 'Pewaukee', 'Wi', 53072, '1982-12-11', 14, '', '3095691974', 1),
(41, '143.43.152.188', 'hello@hello.com', '$2y$08$XsWrEDk2sYsgFSwoWao2.O9tuhQglTT4LRB9fCUAuoPrsdOAyz3iC', NULL, 'hello@hello.com', NULL, NULL, NULL, NULL, '2017-12-12', 1513095687, 1, 'Hello', 'Hello', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, NULL, 1),
(42, '143.43.144.138', 'joejoe@gmail.com', '$2y$08$tMuvVg9ddiINAVayrkPPL.YEAZPrx2160YEfBFvI5wd6cguDZHyn6', NULL, 'joejoe@gmail.com', NULL, NULL, NULL, NULL, '2017-12-12', 1513095995, 1, 'Joe', 'Joe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, NULL, 1),
(43, '103.101.213.82', 'u@flavoursclub.in', '$2y$08$3LCLqW8jRvsW2ZIc3GkMnePHdrWMwj3.j4EJ4aYqA4JCSJY9e74a.', NULL, 'u@flavoursclub.in', NULL, NULL, NULL, NULL, '2017-12-12', NULL, 1, 'Debasish', 'Paul', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16, NULL, NULL, 1),
(44, '103.101.213.82', 'f@flavoursclub.in', '$2y$08$e0b7MY9FJDOfAfUwWNuCNOnhlhaFEi8J33azRDOwZG.JJcVwc5gf2', NULL, 'f@flavoursclub.in', NULL, NULL, NULL, NULL, '2017-12-12', NULL, 1, 'Debasish Test', 'Paul', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16, NULL, NULL, 1),
(45, '103.101.213.82', 'test123@flavoursclub.in', '$2y$08$JhdQ.Q8G8.WmT2gPd8OgLuggbmsJ71dyP1TCHdeV7DRqdNTMC3qoe', NULL, 'test123@flavoursclub.in', NULL, NULL, NULL, NULL, '2017-12-12', NULL, 1, 'Test', 'school', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16, NULL, NULL, 1),
(46, '103.101.213.82', 'test111@flavoursclub.in', '$2y$08$zxn1xcGPkjxparvS.mfXWeZWtq0d1eU2XX/PCHAbkS3F0miQbsPcS', NULL, 'test111@flavoursclub.in', NULL, NULL, NULL, NULL, '2017-12-12', 1513108094, 1, 'Test', 'school', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, '5', NULL, 1),
(47, '110.225.11.136', 'mylab@flavoursclub.in', '$2y$08$aw5U9byvJCaj154cfmaAnuZ5Df35.PLNBkFZqZcQ8mUYvbfGkFpOO', NULL, 'mylab@flavoursclub.in', NULL, NULL, NULL, NULL, '2017-12-13', 1513164275, 1, 'Debasish', 'Paul', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(6, 5, 2),
(8, 7, 2),
(13, 9, 2),
(17, 15, 2),
(18, 16, 2),
(19, 17, 2),
(20, 18, 2),
(21, 19, 2),
(22, 20, 2),
(25, 23, 2),
(26, 24, 2),
(32, 30, 2),
(33, 31, 3),
(34, 32, 2),
(35, 33, 2),
(36, 34, 3),
(37, 35, 2),
(38, 36, 3),
(39, 37, 2),
(40, 38, 3),
(41, 39, 3),
(42, 40, 2),
(43, 41, 3),
(44, 42, 3),
(45, 43, 2),
(46, 44, 2),
(47, 45, 2),
(48, 46, 2),
(49, 47, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `libraries`
--
ALTER TABLE `libraries`
  ADD PRIMARY KEY (`library_id`);

--
-- Indexes for table `library_settings`
--
ALTER TABLE `library_settings`
  ADD PRIMARY KEY (`library_settings_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `readers_books`
--
ALTER TABLE `readers_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `readers_points`
--
ALTER TABLE `readers_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `points_id` (`point_id`),
  ADD KEY `readers_book_id` (`readers_book_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_library_relation`
--
ALTER TABLE `school_library_relation`
  ADD PRIMARY KEY (`relation_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `badges`
--
ALTER TABLE `badges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `libraries`
--
ALTER TABLE `libraries`
  MODIFY `library_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `library_settings`
--
ALTER TABLE `library_settings`
  MODIFY `library_settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `readers_books`
--
ALTER TABLE `readers_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `readers_points`
--
ALTER TABLE `readers_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `school_library_relation`
--
ALTER TABLE `school_library_relation`
  MODIFY `relation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
