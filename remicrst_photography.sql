-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 17, 2020 at 02:37 PM
-- Server version: 10.1.44-MariaDB-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `remicrst_photography`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_user`
--

CREATE TABLE `all_user` (
  `userId` varchar(30) NOT NULL,
  `userPassword` varchar(85) NOT NULL,
  `userType` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `all_user`
--

INSERT INTO `all_user` (`userId`, `userPassword`, `userType`) VALUES
('allo@gmail.com', '$2y$10$5dB2cw71c6U35f9FHyi/v.3wAKLpNGNY1PP723HJTMQr1N/0bRPEu', 'customer'),
('contact@remijonathan.com', '$2y$10$PTgpm.k9u7yUId7yZzl90OKxE0pmn6RQipkmU8mdQRLZjDn7UHNWy', 'model'),
('mdarn@hotmail.com', '$2y$10$ZWWB7Gs3Dhma9VTMcGzo3.9eugsffqXLlex.VZX8WpeQB96i8VLkC', 'administrator'),
('meganedarnaud@hotmail.com', '$2y$10$77Igrnm3GGbWm6gj6UDiz.ygAvvlW.T7427hVJ2jJLvPkr5TsCar.', 'customer'),
('model@gmail.com', '$2y$10$qknPLYzYCL1apAZ6yBQ6vukaq/qGb.dO4S3ayjhq86y2hrbjWjGOq', 'model');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcementId` int(11) NOT NULL,
  `announcementDetail` varchar(300) DEFAULT NULL,
  `announcementTitle` varchar(50) DEFAULT NULL,
  `announcementStartDate` date DEFAULT NULL,
  `announcementEndDate` date DEFAULT NULL,
  `announcementModel` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcementId`, `announcementDetail`, `announcementTitle`, `announcementStartDate`, `announcementEndDate`, `announcementModel`) VALUES
(2, 'I will be giving away pictures and shoot in Montreal', 'Christmas Meeting', '2019-12-19', '2019-12-21', 0),
(3, 'Subscribe to my instagram profile and comments 3 persons.', 'Giveway Christmas', '2019-12-26', '2019-12-30', 0),
(7, 'before date', 'before date', '2019-12-01', '2019-12-09', 0),
(8, 'test correct date, today', 'correct dates you sure my friends', '2019-12-17', '2019-12-25', 0),
(9, 'test dates', 'correct dates but  not today', '2019-12-15', '2019-12-31', 0),
(10, 'test test test', 'confirm test', '2019-12-16', '2019-12-26', 0),
(11, 'start date', 'novembre 2013', '2013-11-07', '2019-12-30', 0),
(12, 'start dare 35t38', 'octobre 2015', '2015-10-13', '2019-12-31', 0),
(13, 'test reports', 'octobre 2019', '2019-10-16', '2019-12-31', 0),
(14, 'to test the summary weekly report', 'this week end december', '2019-12-30', '2020-01-02', 0),
(16, 'So cool we are testing', 'Testing One', '2020-01-13', '2020-01-15', 0),
(18, 'Je test le model search', 'Model search', '2020-01-16', '2020-01-18', 1),
(19, 'I will photograph laurent everyday.', 'Laurent Birthday', '2020-01-17', '2020-01-19', 1),
(20, 'FDFWREAD', 'bouais', '2020-01-15', '2020-01-18', 1),
(21, 'FDFWREAD', 'feafeewf', '2020-01-15', '2020-01-18', 1),
(22, 'FDFWREAD', 'feafe', '2020-01-15', '2020-01-18', 1),
(23, 'FDFWREAD', 'jhgfghj', '2020-01-15', '2020-01-18', 1),
(24, 'FDFWREAD', 'fdafasf', '2020-01-15', '2020-01-18', 1),
(25, 'FDFWREAD', 'jhgfghj', '2020-01-15', '2020-01-18', 1),
(26, 'FDFWREAD', 'lksdjhfa', '2020-01-15', '2020-01-18', 1),
(27, 'FDFWREAD', 'fdsgarfgew', '2020-01-15', '2020-01-18', 1),
(28, 'I am so exited and going to have some disponibilities soon, Watch for them.', 'Going to Gaspesie', '2020-01-16', '2020-01-23', 1),
(30, 'feefaw', 'test link on home page', '2020-01-26', '2020-01-28', 1),
(32, 'test', 'test', '2020-02-15', '2020-02-17', 0),
(33, 'test2', 'test2', '2020-02-16', '2020-02-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `userId` varchar(30) NOT NULL,
  `customerFirstName` varchar(30) DEFAULT NULL,
  `customerLastName` varchar(30) DEFAULT NULL,
  `customerDob` date DEFAULT NULL,
  `customerCountry` varchar(35) DEFAULT NULL,
  `customerCity` varchar(35) DEFAULT NULL,
  `customerDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `userId`, `customerFirstName`, `customerLastName`, `customerDob`, `customerCountry`, `customerCity`, `customerDate`) VALUES
(3, 'allo@gmail.com', 'al', 'lo', '2020-01-29', 'BA', 'aewf', '2020-01-29'),
(4, 'mdarn@hotmail.com', 'm', 'd', '2020-01-29', 'BA', 'sgr', '2020-01-29'),
(5, 'meganedarnaud@hotmail.com', 'm', 'd', '2020-02-10', 'BD', 'here', '2020-02-10');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventId` varchar(50) NOT NULL,
  `eventTitle` varchar(50) NOT NULL,
  `eventStart` varchar(50) NOT NULL,
  `eventEnd` varchar(50) DEFAULT NULL,
  `eventUrl` varchar(80) DEFAULT NULL,
  `eventColor` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventId`, `eventTitle`, `eventStart`, `eventEnd`, `eventUrl`, `eventColor`) VALUES
('nB5HI4ua', 'htfthf - Location: sfsgsg', '2020-02-14T00:00:00', '2020-02-14T01:00:00', NULL, '#33cccc'),
('qolraLt7', 'testlong4 - Location: here', '2020-02-26T00:00:00', '2020-02-27T01:00:00', NULL, '#33cccc'),
('9IaUU8o0', 'test1 - Location: dfdg', '2020-02-24T00:00:00', '2020-02-24T01:00:00', 'requestShootForm.php', '#5f9ea0'),
('g8FHFCjW', 'Toilette - Location: Toilettes', '2020-02-18T00:00:00', '2020-02-19T01:00:00', 'requestShootForm.php', '#5f9ea0'),
('gD9sF91U', 'fewq - Location: Toilettes', '2020-02-19T00:00:00', '2020-02-19T01:00:00', 'requestShootForm.php', '#5f9ea0');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `galleryId` int(11) NOT NULL,
  `galleryTitle` varchar(100) DEFAULT NULL,
  `galleryCategory` varchar(25) NOT NULL,
  `galleryImage` varchar(200) NOT NULL,
  `gallerySubCategory` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`galleryId`, `galleryTitle`, `galleryCategory`, `galleryImage`, `gallerySubCategory`) VALUES
(150, '', 'Brands', 'uploads/IMG_7227.jpg', 'Magique Optique Lunnetterie'),
(149, '', 'Brands', 'uploads/IMG_7280.jpg', 'Hotel Quintessence'),
(148, '', 'Brands', 'uploads/IMG_7215.jpg', 'Hotel Quintessence'),
(147, '', 'Brands', 'uploads/IMG_7172-2.jpg', 'Hotel Quintessence'),
(146, '', 'Brands', 'uploads/IMG_7026.jpg', 'Hotel Quintessence'),
(145, '', 'Brands', 'uploads/IMG_6878.jpg', 'Hotel Quintessence'),
(144, '', 'Brands', 'uploads/IMG_6657.jpg', 'Hotel Quintessence'),
(143, '', 'Brands', 'uploads/IMG_6592.jpg', 'Hotel Quintessence'),
(142, '', 'Brands', 'uploads/IMG_6496.jpg', 'Hotel Cava Tagoo Greece'),
(141, '', 'Brands', 'uploads/IMG_6464.jpg', 'Hotel Cava Tagoo Greece'),
(140, '', 'Brands', 'uploads/IMG_6458.jpg', 'Hotel Cava Tagoo Greece'),
(139, '', 'Brands', 'uploads/IMG_6448.jpg', 'Hotel Cava Tagoo Greece'),
(138, '', 'Brands', 'uploads/IMG_6400.jpg', 'Hotel Cava Tagoo Greece'),
(137, '', 'Travel', 'uploads/IMG_9886.jpg', NULL),
(136, '', 'Travel', 'uploads/IMG_9867-2.jpg', NULL),
(135, '', 'Travel', 'uploads/IMG_9858.jpg', NULL),
(134, '', 'Travel', 'uploads/IMG_9854.jpg', NULL),
(133, '', 'Travel', 'uploads/IMG_9758.jpg', NULL),
(132, '', 'Travel', 'uploads/IMG_9698.jpg', NULL),
(131, '', 'Travel', 'uploads/IMG_9621-2.jpg', NULL),
(130, '', 'Travel', 'uploads/IMG_9472.jpg', NULL),
(129, '', 'Travel', 'uploads/IMG_9456.jpg', NULL),
(128, '', 'Travel', 'uploads/IMG_9353.jpeg', NULL),
(122, '', 'Travel', 'uploads/IMG_3281.jpeg', NULL),
(123, '', 'Travel', 'uploads/IMG_5316.jpeg', NULL),
(124, '', 'Travel', 'uploads/IMG_8929.jpg', NULL),
(125, '', 'Travel', 'uploads/IMG_9235.jpg', NULL),
(126, '', 'Travel', 'uploads/IMG_9247.jpg', NULL),
(127, '', 'Travel', 'uploads/IMG_9293.jpg', NULL),
(119, '', 'Travel', 'uploads/IMG_0023-2.jpg', NULL),
(120, '', 'Travel', 'uploads/IMG_1471.jpg', NULL),
(121, '', 'Travel', 'uploads/IMG_2734.jpg', NULL),
(151, '', 'Brands', 'uploads/IMG_7275.jpg', 'Magique Optique Lunnetterie'),
(152, '', 'Brands', 'uploads/IMG_7399.jpg', 'Magique Optique Lunnetterie'),
(153, '', 'Brands', 'uploads/IMG_7434.jpg', 'Magique Optique Lunnetterie'),
(154, '', 'Brands', 'uploads/IMG_7484.jpg', 'Magique Optique Lunnetterie'),
(155, '', 'Brands', 'uploads/IMG_7504.jpg', 'Magique Optique Lunnetterie'),
(156, '', 'Brands', 'uploads/IMG_6325.jpg', 'Tourisme Mont-Tremblant'),
(157, '', 'Brands', 'uploads/IMG_6407-3.jpg', 'Tourisme Mont-Tremblant'),
(158, '', 'Brands', 'uploads/IMG_6504.jpg', 'Tourisme Mont-Tremblant'),
(159, '', 'Brands', 'uploads/IMG_6531.jpg', 'Tourisme Mont-Tremblant'),
(160, '', 'Brands', 'uploads/IMG_6785.jpg', 'Tourisme Mont-Tremblant'),
(161, '', 'Brands', 'uploads/IMG_6871.jpg', 'Tourisme Mont-Tremblant'),
(162, '', 'Brands', 'uploads/IMG_6878 (1).jpg', 'Tourisme Mont-Tremblant'),
(163, '', 'Brands', 'uploads/IMG_6912.jpg', 'Tourisme Mont-Tremblant'),
(164, '', 'Events', 'uploads/IMG_1432.jpg', 'Mariages'),
(165, '', 'Events', 'uploads/IMG_1443.jpg', 'Mariages'),
(166, '', 'Events', 'uploads/IMG_1517.jpg', 'Mariages'),
(167, '', 'Events', 'uploads/IMG_1553.jpg', 'Mariages'),
(168, '', 'Events', 'uploads/IMG_1577.jpg', 'Mariages'),
(169, '', 'Events', 'uploads/IMG_1592.jpg', 'Mariages'),
(170, '', 'Events', 'uploads/IMG_1600.jpg', 'Mariages'),
(171, '', 'Events', 'uploads/IMG_1619.jpg', 'Mariages'),
(172, '', 'Events', 'uploads/IMG_1622.jpg', 'Mariages'),
(173, '', 'Events', 'uploads/IMG_1626.jpg', 'Mariages'),
(174, '', 'Events', 'uploads/IMG_1629.jpg', 'Mariages'),
(175, '', 'Events', 'uploads/IMG_1636.jpg', 'Mariages'),
(176, '', 'Events', 'uploads/IMG_1638.jpg', 'Mariages'),
(177, '', 'Events', 'uploads/IMG_1666.jpg', 'Mariages'),
(178, '', 'Events', 'uploads/IMG_1772.jpg', 'Mariages'),
(179, '', 'Events', 'uploads/IMG_1802.jpg', 'Mariages'),
(180, '', 'Events', 'uploads/IMG_1811.jpg', 'Mariages'),
(181, '', 'Events', 'uploads/IMG_2201.jpg', 'Mariages'),
(182, '', 'Events', 'uploads/IMG_2202.jpg', 'Mariages'),
(183, '', 'Events', 'uploads/IMG_2252.jpg', 'Mariages'),
(184, '', 'Events', 'uploads/IMG_2293.jpg', 'Mariages'),
(185, '', 'Portraits', 'uploads/_G9A4954.jpg', 'Couples'),
(186, '', 'Portraits', 'uploads/_G9A5031.jpg', 'Couples'),
(187, '', 'Portraits', 'uploads/_G9A5132.jpg', 'Couples'),
(194, '', 'Portraits', 'uploads/_G9A1570.jpg', 'Lifestyle'),
(189, '', 'Portraits', 'uploads/_G9A8923.jpg', 'Couples'),
(190, '', 'Portraits', 'uploads/NG9A9777.jpg', 'Couples'),
(191, '', 'Portraits', 'uploads/NG9A9797.jpg', 'Couples'),
(192, '', 'Portraits', 'uploads/NG9A9847.jpg', 'Couples'),
(193, '', 'Portraits', 'uploads/NG9A9885.jpg', 'Couples'),
(195, '', 'Portraits', 'uploads/_G9A1594.jpg', 'Lifestyle'),
(196, '', 'Portraits', 'uploads/_G9A2305.jpg', 'Lifestyle'),
(197, '', 'Portraits', 'uploads/_G9A2448.jpg', 'Lifestyle'),
(198, '', 'Portraits', 'uploads/_G9A4448.jpg', 'Lifestyle'),
(199, '', 'Portraits', 'uploads/_G9A4538.jpg', 'Lifestyle'),
(200, '', 'Portraits', 'uploads/_G9A5544.jpg', 'Lifestyle'),
(201, '', 'Portraits', 'uploads/_G9A5662.jpg', 'Lifestyle'),
(202, '', 'Portraits', 'uploads/_G9A5684.jpg', 'Lifestyle'),
(203, '', 'Portraits', 'uploads/_G9A6566.jpg', 'Lifestyle'),
(204, '', 'Portraits', 'uploads/_G9A6593.jpg', 'Lifestyle'),
(205, '', 'Portraits', 'uploads/_G9A6597.jpg', 'Lifestyle'),
(206, '', 'Portraits', 'uploads/_G9A6641.jpg', 'Lifestyle'),
(207, '', 'Portraits', 'uploads/_G9A6687.jpg', 'Lifestyle'),
(208, '', 'Portraits', 'uploads/_G9A6790.jpg', 'Lifestyle'),
(209, '', 'Portraits', 'uploads/_G9A6802.jpg', 'Lifestyle'),
(210, '', 'Portraits', 'uploads/_G9A8582.jpg', 'Lifestyle'),
(211, '', 'Portraits', 'uploads/_G9A8587.jpg', 'Lifestyle'),
(212, '', 'Portraits', 'uploads/_G9A8631.jpg', 'Lifestyle'),
(213, '', 'Portraits', 'uploads/_G9A8713.jpg', 'Lifestyle'),
(214, '', 'Portraits', 'uploads/_G9A8802.jpg', 'Lifestyle'),
(215, '', 'Portraits', 'uploads/_G9A8944.jpg', 'Lifestyle'),
(216, '', 'Portraits', 'uploads/_G9A9448.jpg', 'Lifestyle'),
(217, '', 'Portraits', 'uploads/_G9A9529.jpg', 'Lifestyle'),
(218, '', 'Portraits', 'uploads/_G9A2390.jpg', 'Professional'),
(219, '', 'Portraits', 'uploads/_G9A2412.jpg', 'Professional'),
(220, '', 'Portraits', 'uploads/_G9A5860.jpg', 'Professional'),
(221, '', 'Portraits', 'uploads/_G9A5898.jpg', 'Professional'),
(222, '', 'Portraits', 'uploads/NG9A6874.jpg', 'Professional'),
(223, '', 'Portraits', 'uploads/NG9A6900.jpg', 'Professional'),
(224, '', 'Portraits', 'uploads/NG9A6956.jpg', 'Professional'),
(225, '', 'Portraits', 'uploads/NG9A7517.jpg', 'Creative Shoots'),
(226, '', 'Portraits', 'uploads/NG9A7536.jpg', 'Creative Shoots'),
(227, '', 'Portraits', 'uploads/NG9A7799.jpg', 'Creative Shoots'),
(228, '', 'Portraits', 'uploads/NG9A7853.jpg', 'Creative Shoots'),
(229, '', 'Portraits', 'uploads/NG9A8028-2.jpg', 'Creative Shoots'),
(230, '', 'Portraits', 'uploads/NG9A8083.jpg', 'Creative Shoots'),
(231, '', 'Portraits', 'uploads/NG9A8111.jpg', 'Creative Shoots'),
(232, '', 'Portraits', 'uploads/_G9A0032.jpg', 'Creative Shoots'),
(233, '', 'Portraits', 'uploads/_G9A0360.jpg', 'Creative Shoots'),
(234, '', 'Portraits', 'uploads/_G9A9820.jpg', 'Creative Shoots'),
(235, '', 'Portraits', 'uploads/_G9A9824.jpg', 'Creative Shoots'),
(236, '', 'Portraits', 'uploads/_G9A9920.jpg', 'Creative Shoots'),
(237, '', 'Portraits', 'uploads/brunelle2.jpg', 'Creative Shoots'),
(238, '', 'Portraits', 'uploads/IMG_0834.jpg', 'Creative Shoots'),
(239, '', 'Portraits', 'uploads/IMG_0838-2.jpg', 'Creative Shoots'),
(240, '', 'Portraits', 'uploads/IMG_0911.jpg', 'Creative Shoots'),
(241, '', 'Portraits', 'uploads/_G9A0054.jpg', 'Creative Shoots'),
(242, '', 'Portraits', 'uploads/_G9A0495.jpg', 'Creative Shoots'),
(243, '', 'Portraits', 'uploads/_G9A9776.jpg', 'Creative Shoots'),
(244, '', 'Portraits', 'uploads/_G9A9777.jpg', 'Creative Shoots'),
(245, '', 'Portraits', 'uploads/_G9A9847.jpg', 'Creative Shoots'),
(246, '', 'Portraits', 'uploads/_G9A9886.jpg', 'Creative Shoots'),
(247, '', 'Portraits', 'uploads/IMG_9540-2.jpg', 'Creative Shoots'),
(248, '', 'Portraits', 'uploads/123.jpg', 'Creative Shoots'),
(249, '', 'Portraits', 'uploads/NG9A9230.jpg', 'Creative Shoots'),
(250, '', 'Portraits', 'uploads/NG9A9412.jpg', 'Creative Shoots'),
(251, '', 'Portraits', 'uploads/NG9A9428.jpg', 'Creative Shoots'),
(252, '', 'Portraits', 'uploads/NG9A9490.jpg', 'Creative Shoots'),
(253, '', 'Portraits', 'uploads/NG9A9518 1.jpg', 'Creative Shoots'),
(254, '', 'Portraits', 'uploads/NG9A9529+5-2.jpg', 'Creative Shoots'),
(255, '', 'Portraits', 'uploads/_G9A508 9-2.jpg', 'Creative Shoots'),
(256, '', 'Portraits', 'uploads/_G9A5116-5.jpg', 'Creative Shoots'),
(257, '', 'Portraits', 'uploads/_G9A5131.jpg', 'Creative Shoots'),
(258, '', 'Portraits', 'uploads/_G9A5171.jpg', 'Creative Shoots'),
(259, '', 'Portraits', 'uploads/_G9A2965.jpg', 'Creative Shoots'),
(260, '', 'Portraits', 'uploads/_G9A3021-3.jpg', 'Creative Shoots'),
(261, '', 'Portraits', 'uploads/_G9A1395.jpg', 'Creative Shoots'),
(262, '', 'Portraits', 'uploads/-G9A1879.JPG', 'Creative Shoots'),
(263, '', 'Portraits', 'uploads/-G9A2098.JPG', 'Creative Shoots'),
(264, '', 'Portraits', 'uploads/IMG-6193.JPG', 'Creative Shoots'),
(265, '', 'Portraits', 'uploads/IMG_5890.jpg', 'Creative Shoots'),
(266, '', 'Portraits', 'uploads/IMG_5921 (1).jpg', 'Creative Shoots'),
(267, '', 'Portraits', 'uploads/IMG_5959-2.jpg', 'Creative Shoots'),
(268, '', 'Portraits', 'uploads/IMG_9838.jpg', 'Creative Shoots'),
(269, '', 'Portraits', 'uploads/IMG_9877.jpg', 'Creative Shoots'),
(270, '', 'Portraits', 'uploads/IMG_1453.jpg', 'Creative Shoots'),
(271, '', 'Portraits', 'uploads/IMG_1509-2.jpg', 'Creative Shoots'),
(272, '', 'Portraits', 'uploads/_G9A7789-2.jpg', 'Creative Shoots'),
(273, '', 'Portraits', 'uploads/_G9A8112.jpg', 'Creative Shoots'),
(274, '', 'Portraits', 'uploads/IMG_4380.jpg', 'Creative Shoots'),
(275, '', 'Portraits', 'uploads/IMG_0157.jpg', 'Creative Shoots'),
(276, '', 'Portraits', 'uploads/IMG_8813.jpg', 'Creative Shoots'),
(277, '', 'Portraits', 'uploads/IMG_8856.jpg', 'Creative Shoots'),
(278, '', 'Portraits', 'uploads/IMG_8957.jpg', 'Creative Shoots'),
(279, '', 'Portraits', 'uploads/IMG_0501.jpg', 'Creative Shoots'),
(280, '', 'Portraits', 'uploads/IMG_0723.jpg', 'Creative Shoots'),
(281, '', 'Portraits', 'uploads/IMG_0816.jpg', 'Creative Shoots'),
(282, '', 'Portraits', 'uploads/_G9A3197.jpg', 'Creative Shoots'),
(283, '', 'Portraits', 'uploads/_G9A3255 1.jpg', 'Creative Shoots'),
(284, '', 'Portraits', 'uploads/_G9A3656.jpg', 'Creative Shoots'),
(285, '', 'Portraits', 'uploads/_G9A3670.jpg', 'Creative Shoots'),
(286, '', 'Portraits', 'uploads/_G9A3671.jpg', 'Creative Shoots'),
(287, '', 'Portraits', 'uploads/_G9A3965.jpg', 'Creative Shoots'),
(288, '', 'Portraits', 'uploads/_G9A4247.jpg', 'Creative Shoots'),
(289, '', 'Portraits', 'uploads/_G9A4303.jpg', 'Creative Shoots'),
(290, '', 'Portraits', 'uploads/_G9A0450.jpg', 'Creative Shoots'),
(291, '', 'Portraits', 'uploads/_G9A0621.jpg', 'Creative Shoots'),
(292, '', 'Portraits', 'uploads/IMG_0255.jpg', 'Creative Shoots'),
(293, 'hdhffgb', 'Portraits', 'uploads/24F137A4-F5C1-4103-8198-0804434CF4FA.JPG', '\\dfh');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `modelId` int(11) NOT NULL,
  `userId` varchar(30) NOT NULL,
  `modelFirstName` varchar(30) DEFAULT NULL,
  `modelLastName` varchar(30) DEFAULT NULL,
  `modelGender` char(1) DEFAULT NULL,
  `modelDob` date DEFAULT NULL,
  `modelCountry` varchar(35) DEFAULT NULL,
  `modelCity` varchar(35) DEFAULT NULL,
  `modelDate` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`modelId`, `userId`, `modelFirstName`, `modelLastName`, `modelGender`, `modelDob`, `modelCountry`, `modelCity`, `modelDate`) VALUES
(6, 'model@gmail.com', 'm', 'd', 'F', '2000-06-06', 'HK', 'sgsdf', '2020-02-15'),
(7, 'contact@remijonathan.com', 'RÃ©mi Jonathan', 'Choquette', 'M', '1998-08-01', 'CA', 'Montreal', '2020-02-17');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentId` int(11) NOT NULL,
  `userId` varchar(30) NOT NULL,
  `paymentDate` date NOT NULL,
  `paymentTotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentId`, `userId`, `paymentDate`, `paymentTotal`) VALUES
(2, 'allo@gmail.com', '2020-02-12', 50),
(3, 'mdarn@hotmail.com', '2020-02-11', 100),
(4, 'mdarn@hotmail.com', '2020-02-13', 50),
(5, 'mdarn@hotmail.com', '2020-02-13', 50),
(6, 'mdarn@hotmail.com', '2020-02-13', 200);

-- --------------------------------------------------------

--
-- Table structure for table `photographer`
--

CREATE TABLE `photographer` (
  `photographerId` int(11) NOT NULL,
  `userId` varchar(30) NOT NULL,
  `photographerFirstName` varchar(30) DEFAULT NULL,
  `photographerLastName` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shoot`
--

CREATE TABLE `shoot` (
  `shootId` int(11) NOT NULL,
  `shootTime` varchar(10) NOT NULL,
  `shootDate` date NOT NULL,
  `shootLocation` varchar(50) NOT NULL,
  `customerId` int(11) NOT NULL,
  `shootArtistType` varchar(25) DEFAULT NULL,
  `shootCustomerNotes` varchar(100) DEFAULT NULL,
  `shootPackage` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shoot`
--

INSERT INTO `shoot` (`shootId`, `shootTime`, `shootDate`, `shootLocation`, `customerId`, `shootArtistType`, `shootCustomerNotes`, `shootPackage`) VALUES
(1, '11', '2020-02-12', 'mtl', 3, 'hair', 'hi', '1'),
(2, '5:00', '2020-02-27', 'toronto', 3, 'makeup', 'hello', '1'),
(3, '', '2020-02-05', 'availability - Location: mtl', 3, '', '', ''),
(4, '', '2020-02-11', 'testEndEvent - Location: here', 3, ' makeup ', 'hi', 'package1'),
(5, '', '2020-02-10', 'testcolor3 - Location: here', 3, '', '', ''),
(6, '', '2020-02-10', 'testcolor3 - Location: here', 3, '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_user`
--
ALTER TABLE `all_user`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcementId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventId`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`galleryId`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`modelId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentId`),
  ADD KEY `fk_payment_userId` (`userId`);

--
-- Indexes for table `photographer`
--
ALTER TABLE `photographer`
  ADD PRIMARY KEY (`photographerId`),
  ADD KEY `idx_photographerName` (`photographerFirstName`,`photographerLastName`),
  ADD KEY `fk_photograhper_userId` (`userId`);

--
-- Indexes for table `shoot`
--
ALTER TABLE `shoot`
  ADD PRIMARY KEY (`shootId`),
  ADD KEY `idx_package` (`shootPackage`),
  ADD KEY `fk_shoot_customerId` (`customerId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcementId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `galleryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `modelId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `photographer`
--
ALTER TABLE `photographer`
  MODIFY `photographerId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shoot`
--
ALTER TABLE `shoot`
  MODIFY `shootId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_userId` FOREIGN KEY (`userId`) REFERENCES `all_user` (`userId`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_userId` FOREIGN KEY (`userId`) REFERENCES `all_user` (`userId`);

--
-- Constraints for table `photographer`
--
ALTER TABLE `photographer`
  ADD CONSTRAINT `fk_photograhper_userId` FOREIGN KEY (`userId`) REFERENCES `all_user` (`userId`);

--
-- Constraints for table `shoot`
--
ALTER TABLE `shoot`
  ADD CONSTRAINT `fk_shoot_customerId` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
