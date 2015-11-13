-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2015 at 04:55 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `engineering_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `webtech_project_equipment`
--

CREATE TABLE IF NOT EXISTS `webtech_project_equipment` (
  `equipment_id` int(11) NOT NULL AUTO_INCREMENT,
  `serial_number` varchar(20) NOT NULL,
  `inventory_number` varchar(20) NOT NULL,
  `equipment_name` varchar(100) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `date_purchased` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`equipment_id`),
  KEY `fk_equipsupplier` (`supplier_id`),
  KEY `lab_id` (`lab_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `webtech_project_equipment`
--

INSERT INTO `webtech_project_equipment` (`equipment_id`, `serial_number`, `inventory_number`, `equipment_name`, `lab_id`, `date_purchased`, `supplier_id`, `description`) VALUES
(1, '', '', 'telescope', 1, '2015-03-01', 1, ''),
(2, '', '', 'meter rule', 1, '2015-03-05', 2, ''),
(3, '', '', 'venier callipers', 1, '2015-03-10', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `webtech_project_labs`
--

CREATE TABLE IF NOT EXISTS `webtech_project_labs` (
  `lab_id` int(11) NOT NULL AUTO_INCREMENT,
  `lab_name` varchar(300) NOT NULL,
  `department_head` varchar(200) NOT NULL,
  `location` varchar(100) NOT NULL,
  PRIMARY KEY (`lab_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `webtech_project_labs`
--

INSERT INTO `webtech_project_labs` (`lab_id`, `lab_name`, `department_head`, `location`) VALUES
(1, 'Chemistry', 'Richard Lincoln', '220'),
(2, 'Biology', 'Rita Rhona', '222');

-- --------------------------------------------------------

--
-- Table structure for table `webtech_project_supplier`
--

CREATE TABLE IF NOT EXISTS `webtech_project_supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(300) NOT NULL,
  `address` text NOT NULL,
  `phone_number` int(11) NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `webtech_project_supplier`
--

INSERT INTO `webtech_project_supplier` (`supplier_id`, `supplier_name`, `address`, `phone_number`) VALUES
(1, 'TOMMY shops', '1st street mile drive', 24562018),
(2, 'Lloyds limited ', '54th orange lane', 563345776);

-- --------------------------------------------------------

--
-- Table structure for table `webtech_project_transactions`
--

CREATE TABLE IF NOT EXISTS `webtech_project_transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `purpose` text NOT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `fk_transuser` (`user_id`),
  KEY `fk_transequip` (`equipment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `webtech_project_transactions`
--

INSERT INTO `webtech_project_transactions` (`transaction_id`, `user_id`, `transaction_date`, `equipment_id`, `purpose`) VALUES
(1, 2, '2015-03-18', 1, 'borrowing '),
(2, 3, '2015-03-11', 2, 'er');

-- --------------------------------------------------------

--
-- Table structure for table `webtech_project_users`
--

CREATE TABLE IF NOT EXISTS `webtech_project_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(300) NOT NULL,
  `user_status` varchar(100) NOT NULL,
  `user_contact` int(14) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `webtech_project_users`
--

INSERT INTO `webtech_project_users` (`user_id`, `user_name`, `user_status`, `user_contact`) VALUES
(1, 'tommy', 'the dean', 4536691),
(2, 'tommy', 'the dean', 4536691),
(3, 'tom', 'agent', 123),
(4, '', '', 0),
(5, '', '', 0),
(6, '', '', 0),
(7, 'w`', 'q', 1),
(8, 'w`', 'q', 1),
(9, 'test don', 'tester', 24611);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `webtech_project_equipment`
--
ALTER TABLE `webtech_project_equipment`
  ADD CONSTRAINT `fk_equipment` FOREIGN KEY (`lab_id`) REFERENCES `webtech_project_labs` (`lab_id`),
  ADD CONSTRAINT `fk_equipsupplier` FOREIGN KEY (`supplier_id`) REFERENCES `webtech_project_supplier` (`supplier_id`),
  ADD CONSTRAINT `webtech_project_equipment_ibfk_1` FOREIGN KEY (`lab_id`) REFERENCES `webtech_project_labs` (`lab_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `webtech_project_transactions`
--
ALTER TABLE `webtech_project_transactions`
  ADD CONSTRAINT `fk_transuser` FOREIGN KEY (`user_id`) REFERENCES `webtech_project_users` (`user_id`),
  ADD CONSTRAINT `webtech_project_transactions_ibfk_1` FOREIGN KEY (`equipment_id`) REFERENCES `webtech_project_equipment` (`equipment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
