-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2016 at 11:09 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ep`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `fetch_resource_tree_list`(`value` INT) RETURNS int(11)
    READS SQL DATA
BEGIN
        DECLARE _id INT;
        DECLARE _parent INT;
        DECLARE _next INT;
        DECLARE CONTINUE HANDLER FOR NOT FOUND SET @id = NULL;

        SET _parent = @id;
        SET _id = -1;

        IF @id IS NULL THEN
                RETURN NULL;
        END IF;

        LOOP
                SELECT  MIN(id)
                INTO    @id
                FROM    resources
                WHERE   parent = _parent
                        AND id > _id;
                IF @id IS NOT NULL OR _parent = @start_with THEN
                        SET @level = @level + 1;
                        RETURN @id;
                END IF;
                SET @level := @level - 1;
                SELECT  id, parent_id
                INTO    _id, _parent
                FROM    resources
                WHERE   id = _parent;
        END LOOP;       
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `allergies`
--

CREATE TABLE IF NOT EXISTS `allergies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `allergies_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_unit_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `time_slot_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `payment_status` enum('Pending','Advance','Fully Paid') COLLATE utf8_unicode_ci DEFAULT NULL,
  `expected_fee` decimal(8,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `paid_fee` decimal(8,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `reason_type` enum('Medical Check up','Follow Up Visit') COLLATE utf8_unicode_ci NOT NULL,
  `checkup_detail` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `business_unit_id`, `doctor_id`, `patient_id`, `time_slot_id`, `code`, `date`, `time`, `payment_status`, `expected_fee`, `discount_amount`, `paid_fee`, `status`, `reason_type`, `checkup_detail`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 2, '20161020-0001', '2016-10-03', '06:20:00', 'Advance', 1000.00, 0.00, 1000.00, 1, 'Medical Check up', 'Yes', '2016-10-20 15:26:00', '2016-10-20 15:26:00', NULL),
(2, 1, 1, 1, 3, '20161024-0002', '2016-10-03', '06:40:00', NULL, 1000.00, 0.00, 1000.00, 1, 'Medical Check up', '', '2016-10-24 15:53:44', '2016-10-24 15:53:44', NULL),
(3, 1, 1, 2, 4, '20161025-0003', '2016-10-03', '07:00:00', NULL, 1000.00, 0.00, 1000.00, 1, 'Medical Check up', 'head injury', '2016-10-25 08:55:40', '2016-10-25 08:55:40', NULL),
(4, 1, 1, 3, 6, '20161026-0004', '2016-10-03', '07:40:00', NULL, 1000.00, 0.00, 1000.00, 1, 'Medical Check up', 'Head Injury', '2016-10-26 12:03:26', '2016-10-26 12:03:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `business_units`
--

CREATE TABLE IF NOT EXISTS `business_units` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(18) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_main` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`),
  UNIQUE KEY `business_units_name_company_id_unique` (`name`,`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `business_units`
--

INSERT INTO `business_units` (`id`, `company_id`, `city_id`, `name`, `address`, `phone`, `fax`, `description`, `created_at`, `updated_at`, `deleted_at`, `is_main`) VALUES
(1, 1, 1, 'DHA Lahore Clinic', 'DHA Lahore', '+92 42 35252203', '+92 42 35253405', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc cursus semper nulla. Integer auctor, tortor nec volutpat feugiat, nisl nunc volutpat odio, sed bibendum nisi dolor sed libero. Etiam id mi tellus. Etiam eu eros efficitur, aliquet elit placerat, sodales neque. Maecenas vehicula scelerisque erat, eget sollicitudin eros luctus a. Nullam ullamcorper nibh sit amet lorem interdum, et feugiat nisl pellentesque. Maecenas ac diam aliquet, ultricies enim sed, sodales dui. Nam tristique eu est nec lobortis. Aliquam tincidunt odio dolor, vel rhoncus felis lobortis id. Morbi sollicitudin lectus sit amet dignissim porta. Donec dictum dapibus mi in hendrerit. Donec ullamcorper fermentum pretium.', '2016-10-19 15:52:32', '2016-10-19 15:52:32', NULL, 'No'),
(2, 1, 1, 'Johar Town Clinic', 'Johar Town E-Block', '+92 42 35752203', '+92 42 35753405', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc cursus semper nulla. Integer auctor, tortor nec volutpat feugiat, nisl nunc volutpat odio, sed bibendum nisi dolor sed libero. Etiam id mi tellus. Etiam eu eros efficitur, aliquet elit placerat, sodales neque. Maecenas vehicula scelerisque erat, eget sollicitudin eros luctus a. Nullam ullamcorper nibh sit amet lorem interdum, et feugiat nisl pellentesque. Maecenas ac diam aliquet, ultricies enim sed, sodales dui. Nam tristique eu est nec lobortis. Aliquam tincidunt odio dolor, vel rhoncus felis lobortis id. Morbi sollicitudin lectus sit amet dignissim porta. Donec dictum dapibus mi in hendrerit. Donec ullamcorper fermentum pretium.', '2016-10-19 15:52:32', '2016-10-19 15:52:32', NULL, 'No'),
(3, 2, 1, 'Johar Town Hospital', 'Johar Town A-Block', '+92 42 35567890', '+92 42 35567891', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc cursus semper nulla. Integer auctor, tortor nec volutpat feugiat, nisl nunc volutpat odio, sed bibendum nisi dolor sed libero. Etiam id mi tellus. Etiam eu eros efficitur, aliquet elit placerat, sodales neque. Maecenas vehicula scelerisque erat, eget sollicitudin eros luctus a. Nullam ullamcorper nibh sit amet lorem interdum, et feugiat nisl pellentesque. Maecenas ac diam aliquet, ultricies enim sed, sodales dui. Nam tristique eu est nec lobortis. Aliquam tincidunt odio dolor, vel rhoncus felis lobortis id. Morbi sollicitudin lectus sit amet dignissim porta. Donec dictum dapibus mi in hendrerit. Donec ullamcorper fermentum pretium.', '2016-10-19 15:52:32', '2016-10-19 15:52:32', NULL, 'No'),
(4, 2, 1, 'DHA Hospital', 'Johar Town A-Block', '+92 42 35567890', '+92 42 35567891', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc cursus semper nulla. Integer auctor, tortor nec volutpat feugiat, nisl nunc volutpat odio, sed bibendum nisi dolor sed libero. Etiam id mi tellus. Etiam eu eros efficitur, aliquet elit placerat, sodales neque. Maecenas vehicula scelerisque erat, eget sollicitudin eros luctus a. Nullam ullamcorper nibh sit amet lorem interdum, et feugiat nisl pellentesque. Maecenas ac diam aliquet, ultricies enim sed, sodales dui. Nam tristique eu est nec lobortis. Aliquam tincidunt odio dolor, vel rhoncus felis lobortis id. Morbi sollicitudin lectus sit amet dignissim porta. Donec dictum dapibus mi in hendrerit. Donec ullamcorper fermentum pretium.', '2016-10-19 15:52:32', '2016-10-19 15:52:32', NULL, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cities_name_state_id_unique` (`name`,`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Lahore', '2016-10-19 15:52:30', '2016-10-19 15:52:30', NULL),
(2, 1, 'Islamabad', '2016-10-19 15:52:30', '2016-10-19 15:52:30', NULL),
(3, 1, 'Rawalpindi', '2016-10-19 15:52:30', '2016-10-19 15:52:30', NULL),
(4, 1, 'Faisalabad', '2016-10-19 15:52:30', '2016-10-19 15:52:30', NULL),
(5, 1, 'Sialkot', '2016-10-19 15:52:30', '2016-10-19 15:52:30', NULL),
(6, 2, 'Karachi', '2016-10-19 15:52:30', '2016-10-19 15:52:30', NULL),
(7, 3, 'Quetta', '2016-10-19 15:52:30', '2016-10-19 15:52:30', NULL),
(8, 4, 'Pashawer', '2016-10-19 15:52:30', '2016-10-19 15:52:30', NULL),
(9, 5, 'Dubai', '2016-10-19 15:52:30', '2016-10-19 15:52:30', NULL),
(10, 6, 'Abu Dhabi', '2016-10-19 15:52:30', '2016-10-19 15:52:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clinics`
--

CREATE TABLE IF NOT EXISTS `clinics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `doctor_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 9, 3, 'Very Awesome Doctor', '2016-12-09 11:30:00', '2016-12-09 12:15:00', NULL),
(2, 15, 9, 'Should Improve Communication Skills', '2016-12-08 19:00:00', '2016-12-09 10:00:00', NULL),
(3, 14, 8, 'Good Doctor', '2016-12-09 02:00:00', '2016-12-09 09:00:00', NULL),
(4, 9, 3, 'Aitzaz Is good person', '2016-12-14 11:41:07', '2016-12-14 11:41:07', NULL),
(5, 15, 9, 'Now its working better', '2016-12-14 11:45:56', '2016-12-14 11:45:56', NULL),
(6, 14, 8, 'Appointment date is too long', '2016-12-14 11:47:13', '2016-12-14 11:47:13', NULL),
(7, 14, 8, 'Treatment style is too poor', '2016-12-14 11:48:56', '2016-12-14 11:48:56', NULL),
(8, 14, 8, 'Today he was better, isee his new style of treatment', '2016-12-14 11:50:25', '2016-12-14 11:50:25', NULL),
(9, 9, 3, 'Good Doctor', '2016-12-14 12:10:50', '2016-12-14 12:10:50', NULL),
(10, 12, 6, 'Awesome doctor from every side', '2016-12-14 02:00:00', '0000-00-00 00:00:00', NULL),
(11, 3, 1, 'Good Doctor', '2016-12-14 00:00:00', '0000-00-00 00:00:00', NULL),
(12, 8, 2, 'Good Doctor', '2016-12-14 03:00:00', '0000-00-00 00:00:00', NULL),
(13, 10, 4, 'Nice doctor', '2016-12-14 03:00:00', '0000-00-00 00:00:00', NULL),
(14, 13, 7, 'Need to improve communication skills', '2016-12-14 06:00:00', '2016-12-13 19:00:00', NULL),
(15, 3, 1, 'Aitza', '2016-12-14 14:12:49', '2016-12-14 14:12:49', NULL),
(16, 3, 1, 'Aitza', '2016-12-14 14:28:27', '2016-12-14 14:28:27', NULL),
(17, 3, 1, 'Aitza', '2016-12-14 14:32:34', '2016-12-14 14:32:34', NULL),
(18, 3, 1, 'needs to improve communication skills more', '2016-12-26 12:04:34', '2016-12-26 12:04:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `community_users`
--

CREATE TABLE IF NOT EXISTS `community_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qualification` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `cnic` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` enum('Male','Female') COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cell` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `additional_info` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start` time DEFAULT NULL,
  `end` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `community_users_name_unique` (`name`),
  UNIQUE KEY `community_users_email_unique` (`email`),
  UNIQUE KEY `community_users_password_unique` (`password`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `domain` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `company_type` enum('Hospital','Clinic') COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(18) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(18) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `companies_name_unique` (`name`),
  UNIQUE KEY `companies_domain_unique` (`domain`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `city_id`, `name`, `domain`, `company_type`, `address`, `phone`, `fax`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'EP Clinic', 'ep-clinic', 'Clinic', 'DHA Lahore', '+92 42 36852203', '+92 42 36853405', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc cursus semper nulla. Integer auctor, tortor nec volutpat feugiat, nisl nunc volutpat odio, sed bibendum nisi dolor sed libero. Etiam id mi tellus. Etiam eu eros efficitur, aliquet elit placerat, sodales neque. Maecenas vehicula scelerisque erat, eget sollicitudin eros luctus a. Nullam ullamcorper nibh sit amet lorem interdum, et feugiat nisl pellentesque. Maecenas ac diam aliquet, ultricies enim sed, sodales dui. Nam tristique eu est nec lobortis. Aliquam tincidunt odio dolor, vel rhoncus felis lobortis id. Morbi sollicitudin lectus sit amet dignissim porta. Donec dictum dapibus mi in hendrerit. Donec ullamcorper fermentum pretium.', '2016-10-19 15:52:31', '2016-10-19 15:52:31', NULL),
(2, 1, 'EP Hospital', 'ep-hospital', 'Hospital', 'DHA Lahore', '+92 42 36852203', '+92 42 36853405', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc cursus semper nulla. Integer auctor, tortor nec volutpat feugiat, nisl nunc volutpat odio, sed bibendum nisi dolor sed libero. Etiam id mi tellus. Etiam eu eros efficitur, aliquet elit placerat, sodales neque. Maecenas vehicula scelerisque erat, eget sollicitudin eros luctus a. Nullam ullamcorper nibh sit amet lorem interdum, et feugiat nisl pellentesque. Maecenas ac diam aliquet, ultricies enim sed, sodales dui. Nam tristique eu est nec lobortis. Aliquam tincidunt odio dolor, vel rhoncus felis lobortis id. Morbi sollicitudin lectus sit amet dignissim porta. Donec dictum dapibus mi in hendrerit. Donec ullamcorper fermentum pretium.', '2016-10-19 15:52:31', '2016-10-19 15:52:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pakistan', '2016-10-19 15:52:28', '2016-10-19 15:52:28', NULL),
(2, 'United Arab Emirates', '2016-10-19 15:52:28', '2016-10-19 15:52:28', NULL),
(3, 'United Kingdom', '2016-10-19 15:52:28', '2016-10-19 15:52:28', NULL),
(4, 'United States', '2016-10-19 15:52:28', '2016-10-19 15:52:28', NULL),
(5, 'Afghanistan', '2016-10-19 15:52:28', '2016-10-19 15:52:28', NULL),
(6, 'China', '2016-10-19 15:52:28', '2016-10-19 15:52:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `min_fee` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_fee` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `current_rating` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `user_id`, `employee_id`, `min_fee`, `max_fee`, `created_at`, `updated_at`, `deleted_at`, `current_rating`) VALUES
(1, 3, 2, '200', '1000', '2016-10-19 15:52:38', '2016-12-27 12:54:45', NULL, '4.5953125'),
(2, 8, 7, '705', '1294', '2016-10-19 15:52:40', '2016-10-19 15:52:40', NULL, '4.3'),
(3, 9, 8, '773', '1590', '2016-10-19 15:52:41', '2016-10-19 15:52:41', NULL, '4.5'),
(4, 10, 9, '757', '2030', '2016-10-19 15:52:41', '2016-10-19 15:52:41', NULL, '3.5'),
(5, 11, 10, '436', '2575', '2016-10-19 15:52:41', '2016-10-19 15:52:41', NULL, '4.7'),
(6, 12, 11, '664', '1604', '2016-10-19 15:52:42', '2016-10-19 15:52:42', NULL, '3.9'),
(7, 13, 12, '658', '1963', '2016-10-19 15:52:43', '2016-10-19 15:52:43', NULL, '4.6'),
(8, 14, 13, '482', '1890', '2016-10-19 15:52:43', '2016-12-27 13:08:41', NULL, '4.6'),
(9, 15, 14, '218', '2303', '2016-10-19 15:52:44', '2016-10-19 15:52:44', NULL, '3.6');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_medical_specialty`
--

CREATE TABLE IF NOT EXISTS `doctor_medical_specialty` (
  `doctor_id` int(11) NOT NULL,
  `medical_specialty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor_medical_specialty`
--

INSERT INTO `doctor_medical_specialty` (`doctor_id`, `medical_specialty_id`) VALUES
(1, 1),
(3, 1),
(8, 4),
(9, 4),
(10, 4),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_qualification`
--

CREATE TABLE IF NOT EXISTS `doctor_qualification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `qualification_id` int(11) NOT NULL,
  `institute` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `doctor_qualification`
--

INSERT INTO `doctor_qualification` (`id`, `doctor_id`, `qualification_id`, `institute`, `start_date`, `end_date`) VALUES
(1, 1, 1, NULL, NULL, NULL),
(2, 1, 9, NULL, NULL, NULL),
(3, 1, 1, NULL, NULL, NULL),
(4, 1, 9, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drug_usages`
--

CREATE TABLE IF NOT EXISTS `drug_usages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_unit_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `drug_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usage_note` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `duty_days`
--

CREATE TABLE IF NOT EXISTS `duty_days` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) DEFAULT NULL,
  `day` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start` time DEFAULT NULL,
  `end` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `duty_days`
--

INSERT INTO `duty_days` (`id`, `doctor_id`, `day`, `start`, `end`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Monday', '06:00:00', '13:30:00', '2016-10-20 15:24:52', '2016-10-20 15:24:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `business_unit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ntn` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_account_no` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `quite_date` date DEFAULT NULL,
  `joining_salary` decimal(8,2) DEFAULT NULL,
  `current_salary` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `company_id`, `business_unit_id`, `user_id`, `ntn`, `bank_account_no`, `joining_date`, `quite_date`, `joining_salary`, `current_salary`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 2, NULL, NULL, '2013-04-15', NULL, 25000.00, 35000.00, '2016-10-19 15:52:37', '2016-10-19 15:52:37', NULL),
(2, 1, 1, 3, NULL, NULL, '2013-04-15', NULL, 25000.00, 35000.00, '2016-10-19 15:52:38', '2016-10-19 15:52:38', NULL),
(3, 1, 1, 4, NULL, NULL, '2013-04-15', NULL, 25000.00, 35000.00, '2016-10-19 15:52:38', '2016-10-19 15:52:38', NULL),
(4, 1, 1, 5, NULL, NULL, '2013-04-15', NULL, 25000.00, 35000.00, '2016-10-19 15:52:39', '2016-10-19 15:52:39', NULL),
(5, 1, 1, 6, NULL, NULL, '2013-04-15', NULL, 25000.00, 35000.00, '2016-10-19 15:52:39', '2016-10-19 15:52:39', NULL),
(6, 1, 1, 7, NULL, NULL, '2013-04-15', NULL, 25000.00, 35000.00, '2016-10-19 15:52:40', '2016-10-19 15:52:40', NULL),
(7, 1, 1, 8, NULL, NULL, '2011-02-09', NULL, 9022.00, 13832.00, '2016-10-19 15:52:40', '2016-10-19 15:52:40', NULL),
(8, 1, 2, 9, NULL, NULL, '2016-02-18', NULL, 9773.00, 12321.00, '2016-10-19 15:52:41', '2016-10-19 15:52:41', NULL),
(9, 2, 3, 10, NULL, NULL, '2010-10-18', NULL, 6071.00, 24138.00, '2016-10-19 15:52:41', '2016-10-19 15:52:41', NULL),
(10, 2, 4, 11, NULL, NULL, '2013-05-20', NULL, 10322.00, 21921.00, '2016-10-19 15:52:41', '2016-10-19 15:52:41', NULL),
(11, 1, 1, 12, NULL, NULL, '2008-04-07', NULL, 14210.00, 10681.00, '2016-10-19 15:52:42', '2016-10-19 15:52:42', NULL),
(12, 1, 2, 13, NULL, NULL, '2015-11-07', NULL, 6214.00, 20119.00, '2016-10-19 15:52:43', '2016-10-19 15:52:43', NULL),
(13, 2, 3, 14, NULL, NULL, '2011-06-29', NULL, 12999.00, 12970.00, '2016-10-19 15:52:43', '2016-10-19 15:52:43', NULL),
(14, 2, 4, 15, NULL, NULL, '2014-08-21', NULL, 12562.00, 19397.00, '2016-10-19 15:52:44', '2016-10-19 15:52:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `family_histories`
--

CREATE TABLE IF NOT EXISTS `family_histories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_unit_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `patient_relation` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` enum('Male','Female') COLLATE utf8_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `disease_note` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `medical_specialties`
--

CREATE TABLE IF NOT EXISTS `medical_specialties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `photo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `medical_specialties`
--

INSERT INTO `medical_specialties` (`id`, `parent_id`, `name`, `description`, `created_at`, `updated_at`, `photo`) VALUES
(1, NULL, 'Cardiology', 'Cardiology is a branch of medicine dealing with disorders of the heart as well as parts of the circulatory system. The field includes medical diagnosis and treatment of congenital heart defects, coronary artery disease, heart failure, valvular heart disease and electrophysiology. Physicians who specialize in this field of medicine are called cardiologists,', '2016-10-19 15:52:33', '2016-10-19 15:52:33', 'cardiology.png'),
(2, NULL, 'Dentistry', 'A person who is qualified to treat diseases and other conditions that affect the teeth and gums, especially the repair and extraction of teeth and the insertion of artificial ones.', '2016-10-19 15:52:33', '2016-10-19 15:52:33', 'dentistry.jpg'),
(3, NULL, 'Dermatology | Skin Specialists', 'Dermatologist provides the medical treatment related to conditions effecting skin, hair and nails.', '2016-10-19 15:52:33', '2016-10-19 15:52:33', 'dermatology.png'),
(4, NULL, 'Cosmetology', 'Cosmetologist is the beauty expert who takes care of people''s hair, skin and nails. The word has been derived from Greek word which is related to beautifying.', '2016-10-19 15:52:33', '2016-10-19 15:52:33', 'cosmetology.png'),
(5, NULL, 'Otolaryngology | ENT-specialist', 'is the oldest medical specialty in the United States. Otolaryngologists are physicians trained in the medical and surgical management and treatment of patients with diseases and disorders of the ear, nose, throat (ENT), and related structures of the head and neck.', '2016-10-19 15:52:33', '2016-10-19 15:52:33', 'otolaryngology.jpeg'),
(6, NULL, 'Ophthalmology | Eye Specialists', 'the branch of medicine concerned with the study and treatment of disorders and diseases of the eye.', '2016-10-19 15:52:33', '2016-10-19 15:52:33', 'ophthalmology.jpg'),
(7, NULL, 'Nutritionology | Dietetics | Diet Specialists', 'the branch of knowledge concerned with the diet and its effects on health, especially with the practical application of a scientific understanding of nutrition.', '2016-10-19 15:52:33', '2016-10-19 15:52:33', 'nutritionology.png'),
(8, NULL, 'Hepatology  | Liver specialist', 'Hepatology is a branch of medicine concerned with the study, prevention, diagnosis and management of diseases that affect the liver, gallbladder, biliary tree and pancreas.', '2016-10-19 15:52:33', '2016-10-19 15:52:33', 'hepatology.jpg'),
(9, NULL, 'Nephrology', 'The branch of medicine that deals with the physiology and diseases of the kidneys.', '2016-10-19 15:52:33', '2016-10-19 15:52:33', 'nephrology.png'),
(10, NULL, 'Gynecology', 'Gynaecology is the medical practice dealing with the health of the female reproductive systems (vagina, uterus and ovaries) and the breasts. Literally, outside medicine, it means "the science of women', '2016-10-19 15:52:33', '2016-10-19 15:52:33', 'gynecology.png'),
(11, NULL, 'Family Physician', 'Family physicians care for both genders and all ages. Our comprehensive approach to care is necessary in our health care system.', '2016-10-19 15:52:33', '2016-10-19 15:52:33', 'familyphysician.jpg'),
(12, NULL, 'General Physician', 'In the medical profession, a general practitioner (GP) is a medical doctor who treats acute and chronic illnesses and provides preventive care and health education to patients.', '2016-10-19 15:52:33', '2016-10-19 15:52:33', 'generalphysician.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `medical_tests`
--

CREATE TABLE IF NOT EXISTS `medical_tests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `medical_tests_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE IF NOT EXISTS `medicines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `medicine_categories`
--

CREATE TABLE IF NOT EXISTS `medicine_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `menufacturer_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dosage_form` enum('Capsule','Tablet','Syrup','Injection','Drip','Inhaler','Spray','Ear Drop','Eye Drop','Oral Drop','Ointment (Topical)','Cream (Topical)','Pill','Powder') COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `is_derived` enum('Yes','No') COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `medicine_locations`
--

CREATE TABLE IF NOT EXISTS `medicine_locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `medicine_menufacturers`
--

CREATE TABLE IF NOT EXISTS `medicine_menufacturers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cell` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `medicine_purchases`
--

CREATE TABLE IF NOT EXISTS `medicine_purchases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_unit_id` int(11) NOT NULL,
  `menufacturer_id` int(11) NOT NULL,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `medicine_purchase_details`
--

CREATE TABLE IF NOT EXISTS `medicine_purchase_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `medicine_sales`
--

CREATE TABLE IF NOT EXISTS `medicine_sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `business_unit_id` int(11) NOT NULL,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `medicine_sale_details`
--

CREATE TABLE IF NOT EXISTS `medicine_sale_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `medicine_stocks`
--

CREATE TABLE IF NOT EXISTS `medicine_stocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `medicine_id` int(11) NOT NULL,
  `business_unit_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `minimum_quantity` int(11) NOT NULL DEFAULT '5',
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2015_01_28_184838_create_users_table', 1),
('2015_02_03_060752_create_patients_table', 1),
('2015_02_06_062003_create_surgical_histories_table', 1),
('2015_02_06_103433_create_family_histories_table', 1),
('2015_02_10_120710_create_previous_diseases_table', 1),
('2015_02_11_060123_create_allergies_table', 1),
('2015_02_11_070250_create_drug_usages_table', 1),
('2015_02_11_095950_create_vital_signs_table', 1),
('2015_02_14_110516_create_duty_days_table', 1),
('2015_02_14_111359_create_time_slots_table', 1),
('2015_02_17_060819_create_medical_tests_table', 1),
('2015_02_17_080659_create_appointments_table', 1),
('2015_02_18_064352_create_prescriptions_table', 1),
('2015_02_19_192700_create_password_reminders_table', 1),
('2015_05_09_120745_create_medicines_table', 1),
('2015_05_17_123801_create_clinics_table', 1),
('2015_05_17_123801_create_companies_table', 1),
('2016_05_03_110256_create_medicine_prescription_table', 1),
('2016_06_13_225119_create_employees_table', 1),
('2016_06_14_041054_create_business_units_table', 1),
('2016_06_14_041224_create_roles_table', 1),
('2016_06_14_142307_create_countries_table', 1),
('2016_06_14_142352_create_states_table', 1),
('2016_06_14_142407_create_cities_table', 1),
('2016_06_14_154833_create_role_user_table', 1),
('2016_06_16_141944_create_resources_table', 1),
('2016_06_18_024859_create_resource_role_table', 1),
('2016_06_21_213016_create_doctors_table', 1),
('2016_06_21_213347_create_medical_specialties_table', 1),
('2016_06_27_010859_create_qualifications_table', 1),
('2016_06_27_013351_create_doctor_qualification_table', 1),
('2016_06_27_025938_create_doctor_medical_specialty_table', 1),
('2016_07_14_185629_alter_resources_table', 1),
('2016_07_15_220231_create_fetch_resource_tree_list_function', 1),
('2016_08_01_183034_alter_business_units_table', 1),
('2016_08_14_215020_recreate_medicines_table', 1),
('2016_08_14_215358_create_prescirption_details_table', 1),
('2016_09_03_184934_alter_prescriptions_table', 1),
('2016_09_07_154107_create_medicine_stocks_table', 1),
('2016_09_07_160331_create_medicine_sales_table', 1),
('2016_09_07_161153_create_medicine_sale_details_table', 1),
('2016_09_07_161717_create_medicine_purchases_table', 1),
('2016_09_07_162452_create_medicine_purchase_details_table', 1),
('2016_09_07_163116_create_medicine_menufacturers_table', 1),
('2016_09_07_163609_create_medicine_locations_table', 1),
('2016_09_07_205349_create_medicine_categories_table', 1),
('2016_09_23_233402_alter_patients_table', 1),
('2016_11_28_194935_alter_medical_specialties_table', 2),
('2016_12_06_160304_alter_doctors_table', 2),
('2016_12_06_161120_create_comments_table', 3),
('2016_12_06_161305_create_rating_logs_table', 4),
('2016_11_18_153545_create_community_users_table', 5),
('2016_12_26_222051_alter_rating_logs_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reminders`
--

CREATE TABLE IF NOT EXISTS `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_reminders_email_index` (`email`),
  KEY `password_reminders_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `business_unit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `code` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `company_id`, `business_unit_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`, `code`) VALUES
(1, 1, 1, 16, '2016-10-19 15:52:45', '2016-10-19 15:52:45', NULL, ''),
(2, 1, 2, 17, '2016-10-19 15:52:45', '2016-10-19 15:52:45', NULL, ''),
(3, 1, 1, 18, '2016-11-03 12:30:00', '2016-11-03 12:30:00', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE IF NOT EXISTS `prescriptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `other_medicines` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `check_up_note` text COLLATE utf8_unicode_ci,
  `check_up_photo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refill` int(11) NOT NULL,
  `test_procedures` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `patient_id`, `appointment_id`, `code`, `other_medicines`, `created_at`, `updated_at`, `deleted_at`, `parent_id`, `check_up_note`, `check_up_photo`, `refill`, `test_procedures`) VALUES
(1, 1, 1, '20161003-001001001', NULL, '2016-10-20 15:45:29', '2016-10-20 15:45:29', NULL, 0, 'asdasdf', '', 4, 'CT-Scan'),
(2, 1, 1, '20161003-001001002', NULL, '2016-10-20 15:47:36', '2016-10-20 15:47:36', NULL, 0, 'Watoo', 'odEA_0.jpg', 4, 'CBC'),
(3, 1, 2, '20161003-001002003', NULL, '2016-10-28 15:35:47', '2016-10-28 15:35:47', NULL, 2, 'Head Injury', '', 2, 'CT-Scan'),
(4, 3, 4, '20161003-003004001', NULL, '2016-11-03 12:49:41', '2016-11-03 12:49:41', NULL, 0, 'Good', 'z3EL_1460192118544.jpg', 2, 'ECG');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_details`
--

CREATE TABLE IF NOT EXISTS `prescription_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prescription_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `usage_type` enum('Normal','Conditional') COLLATE utf8_unicode_ci DEFAULT NULL,
  `strength_quantity` int(11) NOT NULL,
  `dosage_strength` enum('Milligram (MG)','Gram (G)','Milliliter (ML)','Liter (L)') COLLATE utf8_unicode_ci DEFAULT NULL,
  `usage_quantity` int(11) NOT NULL,
  `quantity_unit` enum('TABLET','Capsule','Spoon','Tea Spoon','Drop','Other') COLLATE utf8_unicode_ci NOT NULL,
  `frequencies` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `extra_note` text COLLATE utf8_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `prescription_details`
--

INSERT INTO `prescription_details` (`id`, `prescription_id`, `medicine_id`, `usage_type`, `strength_quantity`, `dosage_strength`, `usage_quantity`, `quantity_unit`, `frequencies`, `extra_note`, `deleted_at`) VALUES
(1, 1, 2, 'Conditional', 4, 'Gram (G)', 3, 'Capsule', '2', 'Extra', NULL),
(2, 2, 2, 'Conditional', 4, 'Gram (G)', 4, 'Drop', '1,2', 'Aitzaz Description', NULL),
(3, 3, 2, 'Conditional', 4, 'Gram (G)', 4, 'Drop', '', 'Aitzaz Description', NULL),
(4, 4, 2, '', 0, '', 0, '', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `previous_diseases`
--

CREATE TABLE IF NOT EXISTS `previous_diseases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_unit_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `disease_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `disease_notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE IF NOT EXISTS `qualifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`id`, `code`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'MBBS', 'Bachelor of Medicine', 'MBBS is an abbreviation for Medicinae Baccalaureus, Baccalaureus Chirurgiae, or Bachelor of Medicine, Bachelor of Surgery in English, a primary medical qualification.', '2016-10-19 15:52:34', '2016-10-19 15:52:34'),
(2, 'Dip-Card', 'Diploma in Cardiology', 'Diploma in Cardiology', '2016-10-19 15:52:34', '2016-10-19 15:52:34'),
(3, 'BDS', 'Bachelor of Dental Surgery', 'Bachelor of Dental Surgery', '2016-10-19 15:52:35', '2016-10-19 15:52:35'),
(4, 'RDS', 'Respiratory Distress Syndrome', 'Respiratory Distress Syndrome', '2016-10-19 15:52:35', '2016-10-19 15:52:35'),
(5, 'PMDS', 'Persistent Müllerian duct syndrome', 'Persistent Müllerian duct syndrome', '2016-10-19 15:52:35', '2016-10-19 15:52:35'),
(6, 'MCPS', 'Member of College of Physicians & Surgeons', 'Its is Member of College of Physicians and Surgeons Pakistan.\r\n\r\nCollege of Physicians and Surgeons Pakistan is a firm responsible for the registration of Postgraduate Doctors of Pakistan. It makes rules, enrolls doctors and conducts exams for the Post graduation in Pakistan. Currently, CPSP is registering for FCPSI, II and MCPS. CPSP also enrolls foreign qualified doctors.', '2016-10-19 15:52:35', '2016-10-19 15:52:35'),
(7, 'MPH', 'Master of public health', 'Master of public health, a degree designating successful training in analyzing past, present, and future public health issues.', '2016-10-19 15:52:35', '2016-10-19 15:52:35'),
(8, 'MSC (Food & Nutrition)', 'Master of Science (Food & Nutrition)', 'Master of Science (Food & Nutrition)', '2016-10-19 15:52:35', '2016-10-19 15:52:35'),
(9, 'FRCS', 'Fellowship of the Royal College of Surgeons', 'Fellowship of the Royal College of Surgeons (FRCS) is a professional qualification to practise as a senior surgeon in Ireland or the United Kingdom.', '2016-10-19 15:52:35', '2016-10-19 15:52:35'),
(10, 'MS General Surgery', 'M.S Degree in General Surgery', 'M.S Degree in General Surgery', '2016-10-19 15:52:35', '2016-10-19 15:52:35'),
(11, 'FCPS', 'Fellowship of the College of Physicians and Surgeons', 'M.S Degree in General Surgery', '2016-10-19 15:52:35', '2016-10-19 15:52:35'),
(12, 'Fellowship Liver Transplant Surgery', 'Fellowship Liver Transplant Surgery', 'FFellowship Liver Transplant Surgery', '2016-10-19 15:52:35', '2016-10-19 15:52:35'),
(13, 'Hepatobiliary Surgeon', 'Hepatobiliary Surgeon', 'Hepatobiliary: Having to do with the liver plus the gallbladder, bile ducts, or bile. For example, MRI (magnetic resonance imaging) can be applied to the hepatobiliary system. Hepatobiliary makes sense since "hepato-" refers to the liver and "-biliary" refers to the gallbladder, bile ducts, or bile.', '2016-10-19 15:52:35', '2016-10-19 15:52:35'),
(14, 'CPS', 'Cycle per second', 'Cycle per second, now known as hertz, which is the SI unit for frequency. Counts per second and counts per minute are widely used in ionising radiation metrology to signify the rate at which ionising events are detected by a radiological measurement instrument.', '2016-10-19 15:52:35', '2016-10-19 15:52:35'),
(15, 'MD/DM', 'Doctor of Medicine', 'Doctor of Medicine (MD or DM), or in Latin: Medicinae Doctor, meaning "teacher of medicine", is a terminal degree for physicians and surgeons. In countries that follow the tradition of ancient Scotland, it is a first professional graduate degree awarded upon graduation from medical school.', '2016-10-19 15:52:35', '2016-10-19 15:52:35');

-- --------------------------------------------------------

--
-- Table structure for table `rating_logs`
--

CREATE TABLE IF NOT EXISTS `rating_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `rating` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `rating_logs`
--

INSERT INTO `rating_logs` (`id`, `user_id`, `doctor_id`, `rating`, `created_at`, `updated_at`, `deleted_at`, `title`, `description`) VALUES
(1, 3, 1, '4.4', '2016-12-26 12:03:49', '2016-12-26 12:03:49', NULL, NULL, NULL),
(2, 3, 1, '4.3', '2016-12-26 13:42:16', '2016-12-26 13:42:16', NULL, NULL, NULL),
(15, 3, 1, '4.6', '2016-12-27 12:00:40', '2016-12-27 12:00:40', NULL, 'Aitzaz', 'Good Person'),
(16, 3, 1, '4.4', '2016-12-27 12:26:23', '2016-12-27 12:26:23', NULL, 'Why i don''t like it', 'it''s attitude was bad'),
(18, 3, 1, '4.4', '2016-12-27 12:31:13', '2016-12-27 12:31:13', NULL, 'good', 'today he was good'),
(19, 3, 1, '3.5', '2016-12-27 12:34:41', '2016-12-27 12:34:41', NULL, 'gg', 'sdd'),
(20, 3, 1, '4.3', '2016-12-27 12:40:27', '2016-12-27 12:40:27', NULL, 'good', 'nice'),
(21, 3, 1, '4.3', '2016-12-27 12:43:53', '2016-12-27 12:43:53', NULL, 'good', 'improving'),
(22, 3, 1, '5.0', '2016-12-27 12:54:45', '2016-12-27 12:54:45', NULL, 'Awesome Doctor', 'I did not see  this type of doctor in my life in terms of method of treatment, behaviours etc'),
(23, 9, 3, '4.5', '2016-12-27 13:03:58', '2016-12-27 13:03:58', NULL, '', ''),
(24, 14, 8, '4.8', '2016-12-27 13:07:32', '2016-12-27 13:07:32', NULL, 'Good Doctor', 'Should improve more'),
(25, 14, 8, '4.8', '2016-12-27 13:08:41', '2016-12-27 13:08:41', NULL, 'Good', 'Today he was more good');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `type` enum('Module','Group','Controller','Action') COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `display` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=197 ;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `parent_id`, `type`, `name`, `display`, `created_at`, `updated_at`) VALUES
(1, 0, 'Module', 'Hospital Management', 'Hospital Management', '2016-10-19 15:52:48', '2016-10-19 15:52:48'),
(2, 1, 'Group', 'Administration', 'Administration', '2016-10-19 15:52:48', '2016-10-19 15:52:48'),
(3, 1, 'Group', 'Manage Clinics or Hospital', 'Manage Clinics or Hospital', '2016-10-19 15:52:48', '2016-10-19 15:52:48'),
(4, 1, 'Group', 'Public Resources', 'Public Resources', '2016-10-19 15:52:48', '2016-10-19 15:52:48'),
(5, 1, 'Group', 'Other Resources', 'Other Resources', '2016-10-19 15:52:48', '2016-10-19 15:52:48'),
(6, 4, 'Controller', 'AuthController', 'AuthController', '2016-10-19 15:52:48', '2016-10-19 15:52:48'),
(7, 6, 'Action', 'showLogin', 'ShowLogin', '2016-10-19 15:52:48', '2016-10-19 15:52:48'),
(8, 6, 'Action', 'doLogin', 'DoLogin', '2016-10-19 15:52:48', '2016-10-19 15:52:48'),
(9, 6, 'Action', 'logout', 'Logout', '2016-10-19 15:52:48', '2016-10-19 15:52:48'),
(10, 6, 'Action', 'unauthorized', 'Unauthorized', '2016-10-19 15:52:48', '2016-10-19 15:52:48'),
(11, 4, 'Controller', 'HomeController', 'HomeController', '2016-10-19 15:52:48', '2016-10-19 15:52:48'),
(12, 11, 'Action', 'index', 'Index', '2016-10-19 15:52:48', '2016-10-19 15:52:48'),
(13, 11, 'Action', 'showAbout', 'ShowAbout', '2016-10-19 15:52:48', '2016-10-19 15:52:48'),
(14, 11, 'Action', 'showServices', 'ShowServices', '2016-10-19 15:52:48', '2016-10-19 15:52:48'),
(15, 11, 'Action', 'showContacts', 'ShowContacts', '2016-10-19 15:52:48', '2016-10-19 15:52:48'),
(16, 11, 'Action', 'showDoctorHome', 'ShowDoctorHome', '2016-10-19 15:52:49', '2016-10-19 15:52:49'),
(17, 11, 'Action', 'showCompanyHomePage', 'ShowCompanyHomePage', '2016-10-19 15:52:49', '2016-10-19 15:52:49'),
(18, 11, 'Action', 'fetchDoctorDutyAndFeeInfo', 'FetchDoctorDutyAndFeeInfo', '2016-10-19 15:52:49', '2016-10-19 15:52:49'),
(19, 11, 'Action', 'sendContactUsMail', 'SendContactUsMail', '2016-10-19 15:52:49', '2016-10-19 15:52:49'),
(20, 5, 'Controller', 'RemindersController', 'RemindersController', '2016-10-19 15:52:49', '2016-10-19 15:52:49'),
(21, 20, 'Action', 'getRemind', 'GetRemind', '2016-10-19 15:52:49', '2016-10-19 15:52:49'),
(22, 20, 'Action', 'postRemind', 'PostRemind', '2016-10-19 15:52:49', '2016-10-19 15:52:49'),
(23, 20, 'Action', 'getReset', 'GetReset', '2016-10-19 15:52:49', '2016-10-19 15:52:49'),
(24, 20, 'Action', 'postReset', 'PostReset', '2016-10-19 15:52:49', '2016-10-19 15:52:49'),
(25, 5, 'Controller', 'DashboardsController', 'DashboardsController', '2016-10-19 15:52:49', '2016-10-19 15:52:49'),
(26, 25, 'Action', 'showDashboard', 'ShowDashboard', '2016-10-19 15:52:49', '2016-10-19 15:52:49'),
(27, 3, 'Controller', 'TimeSlotsController', 'TimeSlotsController', '2016-10-19 15:52:49', '2016-10-19 15:52:49'),
(28, 27, 'Action', 'index', 'Index', '2016-10-19 15:52:49', '2016-10-19 15:52:49'),
(29, 27, 'Action', 'create', 'Create', '2016-10-19 15:52:49', '2016-10-19 15:52:49'),
(30, 27, 'Action', 'store', 'Store', '2016-10-19 15:52:50', '2016-10-19 15:52:50'),
(31, 27, 'Action', 'show', 'Show', '2016-10-19 15:52:50', '2016-10-19 15:52:50'),
(32, 27, 'Action', 'edit', 'Edit', '2016-10-19 15:52:50', '2016-10-19 15:52:50'),
(33, 27, 'Action', 'update', 'Update', '2016-10-19 15:52:50', '2016-10-19 15:52:50'),
(34, 27, 'Action', 'destroy', 'Destroy', '2016-10-19 15:52:50', '2016-10-19 15:52:50'),
(35, 27, 'Action', 'getFreeSlots', 'GetFreeSlots', '2016-10-19 15:52:50', '2016-10-19 15:52:50'),
(36, 2, 'Controller', 'UsersController', 'UsersController', '2016-10-19 15:52:50', '2016-10-19 15:52:50'),
(37, 36, 'Action', 'index', 'Index', '2016-10-19 15:52:50', '2016-10-19 15:52:50'),
(38, 36, 'Action', 'create', 'Create', '2016-10-19 15:52:50', '2016-10-19 15:52:50'),
(39, 36, 'Action', 'store', 'Store', '2016-10-19 15:52:50', '2016-10-19 15:52:50'),
(40, 36, 'Action', 'show', 'Show', '2016-10-19 15:52:50', '2016-10-19 15:52:50'),
(41, 36, 'Action', 'edit', 'Edit', '2016-10-19 15:52:51', '2016-10-19 15:52:51'),
(42, 36, 'Action', 'update', 'Update', '2016-10-19 15:52:51', '2016-10-19 15:52:51'),
(43, 36, 'Action', 'destroy', 'Destroy', '2016-10-19 15:52:51', '2016-10-19 15:52:51'),
(44, 36, 'Action', 'uploadProfilePic', 'UploadProfilePic', '2016-10-19 15:52:51', '2016-10-19 15:52:51'),
(45, 2, 'Controller', 'RolesController', 'RolesController', '2016-10-19 15:52:51', '2016-10-19 15:52:51'),
(46, 45, 'Action', 'index', 'Index', '2016-10-19 15:52:51', '2016-10-19 15:52:51'),
(47, 45, 'Action', 'create', 'Create', '2016-10-19 15:52:51', '2016-10-19 15:52:51'),
(48, 45, 'Action', 'store', 'Store', '2016-10-19 15:52:51', '2016-10-19 15:52:51'),
(49, 45, 'Action', 'show', 'Show', '2016-10-19 15:52:51', '2016-10-19 15:52:51'),
(50, 45, 'Action', 'edit', 'Edit', '2016-10-19 15:52:51', '2016-10-19 15:52:51'),
(51, 45, 'Action', 'update', 'Update', '2016-10-19 15:52:51', '2016-10-19 15:52:51'),
(52, 45, 'Action', 'destroy', 'Destroy', '2016-10-19 15:52:51', '2016-10-19 15:52:51'),
(53, 2, 'Controller', 'CompaniesController', 'CompaniesController', '2016-10-19 15:52:51', '2016-10-19 15:52:51'),
(54, 53, 'Action', 'index', 'Index', '2016-10-19 15:52:51', '2016-10-19 15:52:51'),
(55, 53, 'Action', 'create', 'Create', '2016-10-19 15:52:51', '2016-10-19 15:52:51'),
(56, 53, 'Action', 'store', 'Store', '2016-10-19 15:52:51', '2016-10-19 15:52:51'),
(57, 53, 'Action', 'show', 'Show', '2016-10-19 15:52:51', '2016-10-19 15:52:51'),
(58, 53, 'Action', 'edit', 'Edit', '2016-10-19 15:52:51', '2016-10-19 15:52:51'),
(59, 53, 'Action', 'update', 'Update', '2016-10-19 15:52:52', '2016-10-19 15:52:52'),
(60, 53, 'Action', 'destroy', 'Destroy', '2016-10-19 15:52:52', '2016-10-19 15:52:52'),
(61, 3, 'Controller', 'DoctorsController', 'DoctorsController', '2016-10-19 15:52:52', '2016-10-19 15:52:52'),
(62, 61, 'Action', 'index', 'Index', '2016-10-19 15:52:52', '2016-10-19 15:52:52'),
(63, 61, 'Action', 'create', 'Create', '2016-10-19 15:52:52', '2016-10-19 15:52:52'),
(64, 61, 'Action', 'store', 'Store', '2016-10-19 15:52:52', '2016-10-19 15:52:52'),
(65, 61, 'Action', 'show', 'Show', '2016-10-19 15:52:52', '2016-10-19 15:52:52'),
(66, 61, 'Action', 'edit', 'Edit', '2016-10-19 15:52:52', '2016-10-19 15:52:52'),
(67, 61, 'Action', 'update', 'Update', '2016-10-19 15:52:53', '2016-10-19 15:52:53'),
(68, 61, 'Action', 'destroy', 'Destroy', '2016-10-19 15:52:53', '2016-10-19 15:52:53'),
(69, 3, 'Controller', 'PatientsController', 'PatientsController', '2016-10-19 15:52:53', '2016-10-19 15:52:53'),
(70, 69, 'Action', 'index', 'Index', '2016-10-19 15:52:53', '2016-10-19 15:52:53'),
(71, 69, 'Action', 'create', 'Create', '2016-10-19 15:52:53', '2016-10-19 15:52:53'),
(72, 69, 'Action', 'store', 'Store', '2016-10-19 15:52:53', '2016-10-19 15:52:53'),
(73, 69, 'Action', 'show', 'Show', '2016-10-19 15:52:53', '2016-10-19 15:52:53'),
(74, 69, 'Action', 'edit', 'Edit', '2016-10-19 15:52:53', '2016-10-19 15:52:53'),
(75, 69, 'Action', 'update', 'Update', '2016-10-19 15:52:53', '2016-10-19 15:52:53'),
(76, 69, 'Action', 'destroy', 'Destroy', '2016-10-19 15:52:53', '2016-10-19 15:52:53'),
(77, 69, 'Action', 'patientsReporting', 'PatientsReporting', '2016-10-19 15:52:53', '2016-10-19 15:52:53'),
(78, 5, 'Controller', 'MedicinesController', 'MedicinesController', '2016-10-19 15:52:53', '2016-10-19 15:52:53'),
(79, 78, 'Action', 'index', 'Index', '2016-10-19 15:52:53', '2016-10-19 15:52:53'),
(80, 78, 'Action', 'create', 'Create', '2016-10-19 15:52:54', '2016-10-19 15:52:54'),
(81, 78, 'Action', 'store', 'Store', '2016-10-19 15:52:54', '2016-10-19 15:52:54'),
(82, 78, 'Action', 'show', 'Show', '2016-10-19 15:52:54', '2016-10-19 15:52:54'),
(83, 78, 'Action', 'edit', 'Edit', '2016-10-19 15:52:54', '2016-10-19 15:52:54'),
(84, 78, 'Action', 'update', 'Update', '2016-10-19 15:52:54', '2016-10-19 15:52:54'),
(85, 78, 'Action', 'destroy', 'Destroy', '2016-10-19 15:52:54', '2016-10-19 15:52:54'),
(86, 5, 'Controller', 'FamilyHistoriesController', 'FamilyHistoriesController', '2016-10-19 15:52:54', '2016-10-19 15:52:54'),
(87, 86, 'Action', 'index', 'Index', '2016-10-19 15:52:54', '2016-10-19 15:52:54'),
(88, 86, 'Action', 'create', 'Create', '2016-10-19 15:52:54', '2016-10-19 15:52:54'),
(89, 86, 'Action', 'store', 'Store', '2016-10-19 15:52:54', '2016-10-19 15:52:54'),
(90, 86, 'Action', 'show', 'Show', '2016-10-19 15:52:54', '2016-10-19 15:52:54'),
(91, 86, 'Action', 'edit', 'Edit', '2016-10-19 15:52:54', '2016-10-19 15:52:54'),
(92, 86, 'Action', 'update', 'Update', '2016-10-19 15:52:54', '2016-10-19 15:52:54'),
(93, 86, 'Action', 'destroy', 'Destroy', '2016-10-19 15:52:54', '2016-10-19 15:52:54'),
(94, 5, 'Controller', 'PreviousDiseasesController', 'PreviousDiseasesController', '2016-10-19 15:52:54', '2016-10-19 15:52:54'),
(95, 94, 'Action', 'index', 'Index', '2016-10-19 15:52:54', '2016-10-19 15:52:54'),
(96, 94, 'Action', 'create', 'Create', '2016-10-19 15:52:54', '2016-10-19 15:52:54'),
(97, 94, 'Action', 'store', 'Store', '2016-10-19 15:52:54', '2016-10-19 15:52:54'),
(98, 94, 'Action', 'show', 'Show', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(99, 94, 'Action', 'edit', 'Edit', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(100, 94, 'Action', 'update', 'Update', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(101, 94, 'Action', 'destroy', 'Destroy', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(102, 5, 'Controller', 'AllergiesController', 'AllergiesController', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(103, 5, 'Controller', 'DrugUsagesController', 'DrugUsagesController', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(104, 103, 'Action', 'index', 'Index', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(105, 103, 'Action', 'create', 'Create', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(106, 103, 'Action', 'store', 'Store', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(107, 103, 'Action', 'show', 'Show', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(108, 103, 'Action', 'edit', 'Edit', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(109, 103, 'Action', 'update', 'Update', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(110, 103, 'Action', 'destroy', 'Destroy', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(111, 5, 'Controller', 'VitalSignsController', 'VitalSignsController', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(112, 111, 'Action', 'index', 'Index', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(113, 111, 'Action', 'create', 'Create', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(114, 111, 'Action', 'store', 'Store', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(115, 111, 'Action', 'show', 'Show', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(116, 111, 'Action', 'edit', 'Edit', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(117, 111, 'Action', 'update', 'Update', '2016-10-19 15:52:55', '2016-10-19 15:52:55'),
(118, 111, 'Action', 'destroy', 'Destroy', '2016-10-19 15:52:56', '2016-10-19 15:52:56'),
(119, 3, 'Controller', 'DutyDaysController', 'DutyDaysController', '2016-10-19 15:52:56', '2016-10-19 15:52:56'),
(120, 119, 'Action', 'index', 'Index', '2016-10-19 15:52:56', '2016-10-19 15:52:56'),
(121, 119, 'Action', 'create', 'Create', '2016-10-19 15:52:56', '2016-10-19 15:52:56'),
(122, 119, 'Action', 'store', 'Store', '2016-10-19 15:52:56', '2016-10-19 15:52:56'),
(123, 119, 'Action', 'show', 'Show', '2016-10-19 15:52:56', '2016-10-19 15:52:56'),
(124, 119, 'Action', 'edit', 'Edit', '2016-10-19 15:52:56', '2016-10-19 15:52:56'),
(125, 119, 'Action', 'update', 'Update', '2016-10-19 15:52:56', '2016-10-19 15:52:56'),
(126, 119, 'Action', 'destroy', 'Destroy', '2016-10-19 15:52:56', '2016-10-19 15:52:56'),
(127, 3, 'Controller', 'AppointmentsController', 'AppointmentsController', '2016-10-19 15:52:56', '2016-10-19 15:52:56'),
(128, 127, 'Action', 'index', 'Index', '2016-10-19 15:52:56', '2016-10-19 15:52:56'),
(129, 127, 'Action', 'create', 'Create', '2016-10-19 15:52:56', '2016-10-19 15:52:56'),
(130, 127, 'Action', 'store', 'Store', '2016-10-19 15:52:56', '2016-10-19 15:52:56'),
(131, 127, 'Action', 'show', 'Show', '2016-10-19 15:52:56', '2016-10-19 15:52:56'),
(132, 127, 'Action', 'edit', 'Edit', '2016-10-19 15:52:56', '2016-10-19 15:52:56'),
(133, 127, 'Action', 'update', 'Update', '2016-10-19 15:52:56', '2016-10-19 15:52:56'),
(134, 127, 'Action', 'destroy', 'Destroy', '2016-10-19 15:52:56', '2016-10-19 15:52:56'),
(135, 127, 'Action', 'fetchTimeSlotsAndBookedAppointments', 'FetchTimeSlotsAndBookedAppointments', '2016-10-19 15:52:56', '2016-10-19 15:52:56'),
(136, 3, 'Controller', 'PrescriptionsController', 'PrescriptionsController', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(137, 136, 'Action', 'index', 'Index', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(138, 136, 'Action', 'patientPrescriptions', 'PatientPrescriptions', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(139, 136, 'Action', 'create', 'Create', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(140, 136, 'Action', 'followUpPrescriptions', 'FollowUpPrescriptions', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(141, 136, 'Action', 'store', 'Store', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(142, 136, 'Action', 'show', 'Show', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(143, 136, 'Action', 'edit', 'Edit', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(144, 136, 'Action', 'update', 'Update', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(145, 136, 'Action', 'destroy', 'Destroy', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(146, 136, 'Action', 'printPrescription', 'PrintPrescription', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(147, 136, 'Action', 'uploadCheckUpPic', 'UploadCheckUpPic', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(148, 136, 'Action', 'deleteCheckUpPic', 'DeleteCheckUpPic', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(149, 5, 'Controller', 'App\\Controllers\\Inventory\\MedicinePurchasesController', 'App\\Controllers\\Inventory\\MedicinePurchasesController', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(150, 149, 'Action', 'index', 'Index', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(151, 149, 'Action', 'create', 'Create', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(152, 149, 'Action', 'store', 'Store', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(153, 149, 'Action', 'show', 'Show', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(154, 149, 'Action', 'edit', 'Edit', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(155, 149, 'Action', 'update', 'Update', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(156, 149, 'Action', 'destroy', 'Destroy', '2016-10-19 15:52:57', '2016-10-19 15:52:57'),
(157, 5, 'Controller', 'App\\Controllers\\Inventory\\MedicineSalesController', 'App\\Controllers\\Inventory\\MedicineSalesController', '2016-10-19 15:52:58', '2016-10-19 15:52:58'),
(158, 157, 'Action', 'index', 'Index', '2016-10-19 15:52:58', '2016-10-19 15:52:58'),
(159, 157, 'Action', 'create', 'Create', '2016-10-19 15:52:58', '2016-10-19 15:52:58'),
(160, 157, 'Action', 'store', 'Store', '2016-10-19 15:52:58', '2016-10-19 15:52:58'),
(161, 157, 'Action', 'show', 'Show', '2016-10-19 15:52:58', '2016-10-19 15:52:58'),
(162, 157, 'Action', 'edit', 'Edit', '2016-10-19 15:52:58', '2016-10-19 15:52:58'),
(163, 157, 'Action', 'update', 'Update', '2016-10-19 15:52:58', '2016-10-19 15:52:58'),
(164, 157, 'Action', 'destroy', 'Destroy', '2016-10-19 15:52:58', '2016-10-19 15:52:58'),
(165, 5, 'Controller', 'App\\Controllers\\Inventory\\MedicineStocksController', 'App\\Controllers\\Inventory\\MedicineStocksController', '2016-10-19 15:52:58', '2016-10-19 15:52:58'),
(166, 165, 'Action', 'index', 'Index', '2016-10-19 15:52:58', '2016-10-19 15:52:58'),
(167, 165, 'Action', 'create', 'Create', '2016-10-19 15:52:58', '2016-10-19 15:52:58'),
(168, 165, 'Action', 'store', 'Store', '2016-10-19 15:52:58', '2016-10-19 15:52:58'),
(169, 165, 'Action', 'show', 'Show', '2016-10-19 15:52:58', '2016-10-19 15:52:58'),
(170, 165, 'Action', 'edit', 'Edit', '2016-10-19 15:52:58', '2016-10-19 15:52:58'),
(171, 165, 'Action', 'update', 'Update', '2016-10-19 15:52:58', '2016-10-19 15:52:58'),
(172, 165, 'Action', 'destroy', 'Destroy', '2016-10-19 15:52:58', '2016-10-19 15:52:58'),
(173, 5, 'Controller', 'App\\Controllers\\Inventory\\MedicineLocationsController', 'App\\Controllers\\Inventory\\MedicineLocationsController', '2016-10-19 15:52:58', '2016-10-19 15:52:58'),
(174, 173, 'Action', 'index', 'Index', '2016-10-19 15:52:58', '2016-10-19 15:52:58'),
(175, 173, 'Action', 'create', 'Create', '2016-10-19 15:52:59', '2016-10-19 15:52:59'),
(176, 173, 'Action', 'store', 'Store', '2016-10-19 15:52:59', '2016-10-19 15:52:59'),
(177, 173, 'Action', 'show', 'Show', '2016-10-19 15:52:59', '2016-10-19 15:52:59'),
(178, 173, 'Action', 'edit', 'Edit', '2016-10-19 15:52:59', '2016-10-19 15:52:59'),
(179, 173, 'Action', 'update', 'Update', '2016-10-19 15:52:59', '2016-10-19 15:52:59'),
(180, 173, 'Action', 'destroy', 'Destroy', '2016-10-19 15:52:59', '2016-10-19 15:52:59'),
(181, 5, 'Controller', 'App\\Controllers\\Inventory\\MedicineMenufacturersController', 'App\\Controllers\\Inventory\\MedicineMenufacturersController', '2016-10-19 15:52:59', '2016-10-19 15:52:59'),
(182, 181, 'Action', 'index', 'Index', '2016-10-19 15:52:59', '2016-10-19 15:52:59'),
(183, 181, 'Action', 'create', 'Create', '2016-10-19 15:52:59', '2016-10-19 15:52:59'),
(184, 181, 'Action', 'store', 'Store', '2016-10-19 15:52:59', '2016-10-19 15:52:59'),
(185, 181, 'Action', 'show', 'Show', '2016-10-19 15:52:59', '2016-10-19 15:52:59'),
(186, 181, 'Action', 'edit', 'Edit', '2016-10-19 15:52:59', '2016-10-19 15:52:59'),
(187, 181, 'Action', 'update', 'Update', '2016-10-19 15:52:59', '2016-10-19 15:52:59'),
(188, 181, 'Action', 'destroy', 'Destroy', '2016-10-19 15:52:59', '2016-10-19 15:52:59'),
(189, 5, 'Controller', 'App\\Controllers\\Inventory\\MedicineCategoriesController', 'App\\Controllers\\Inventory\\MedicineCategoriesController', '2016-10-19 15:52:59', '2016-10-19 15:52:59'),
(190, 189, 'Action', 'index', 'Index', '2016-10-19 15:52:59', '2016-10-19 15:52:59'),
(191, 189, 'Action', 'create', 'Create', '2016-10-19 15:52:59', '2016-10-19 15:52:59'),
(192, 189, 'Action', 'store', 'Store', '2016-10-19 15:52:59', '2016-10-19 15:52:59'),
(193, 189, 'Action', 'show', 'Show', '2016-10-19 15:53:00', '2016-10-19 15:53:00'),
(194, 189, 'Action', 'edit', 'Edit', '2016-10-19 15:53:00', '2016-10-19 15:53:00'),
(195, 189, 'Action', 'update', 'Update', '2016-10-19 15:53:00', '2016-10-19 15:53:00'),
(196, 189, 'Action', 'destroy', 'Destroy', '2016-10-19 15:53:00', '2016-10-19 15:53:00');

-- --------------------------------------------------------

--
-- Table structure for table `resource_role`
--

CREATE TABLE IF NOT EXISTS `resource_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resource_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` enum('Allow','Deny','Indeterminate') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=197 ;

--
-- Dumping data for table `resource_role`
--

INSERT INTO `resource_role` (`id`, `resource_id`, `role_id`, `status`) VALUES
(1, 1, 2, 'Allow'),
(2, 2, 2, 'Allow'),
(3, 3, 2, 'Allow'),
(4, 4, 2, 'Allow'),
(5, 5, 2, 'Allow'),
(6, 6, 2, 'Allow'),
(7, 7, 2, 'Allow'),
(8, 8, 2, 'Allow'),
(9, 9, 2, 'Allow'),
(10, 10, 2, 'Allow'),
(11, 11, 2, 'Allow'),
(12, 12, 2, 'Allow'),
(13, 13, 2, 'Allow'),
(14, 14, 2, 'Allow'),
(15, 15, 2, 'Allow'),
(16, 16, 2, 'Allow'),
(17, 17, 2, 'Allow'),
(18, 18, 2, 'Allow'),
(19, 19, 2, 'Allow'),
(20, 20, 2, 'Allow'),
(21, 21, 2, 'Allow'),
(22, 22, 2, 'Allow'),
(23, 23, 2, 'Allow'),
(24, 24, 2, 'Allow'),
(25, 25, 2, 'Allow'),
(26, 26, 2, 'Allow'),
(27, 27, 2, 'Allow'),
(28, 28, 2, 'Allow'),
(29, 29, 2, 'Allow'),
(30, 30, 2, 'Allow'),
(31, 31, 2, 'Allow'),
(32, 32, 2, 'Allow'),
(33, 33, 2, 'Allow'),
(34, 34, 2, 'Allow'),
(35, 35, 2, 'Allow'),
(36, 36, 2, 'Allow'),
(37, 37, 2, 'Allow'),
(38, 38, 2, 'Allow'),
(39, 39, 2, 'Allow'),
(40, 40, 2, 'Allow'),
(41, 41, 2, 'Allow'),
(42, 42, 2, 'Allow'),
(43, 43, 2, 'Allow'),
(44, 44, 2, 'Allow'),
(45, 45, 2, 'Allow'),
(46, 46, 2, 'Allow'),
(47, 47, 2, 'Allow'),
(48, 48, 2, 'Allow'),
(49, 49, 2, 'Allow'),
(50, 50, 2, 'Allow'),
(51, 51, 2, 'Allow'),
(52, 52, 2, 'Allow'),
(53, 53, 2, 'Allow'),
(54, 54, 2, 'Allow'),
(55, 55, 2, 'Allow'),
(56, 56, 2, 'Allow'),
(57, 57, 2, 'Allow'),
(58, 58, 2, 'Allow'),
(59, 59, 2, 'Allow'),
(60, 60, 2, 'Allow'),
(61, 61, 2, 'Allow'),
(62, 62, 2, 'Allow'),
(63, 63, 2, 'Allow'),
(64, 64, 2, 'Allow'),
(65, 65, 2, 'Allow'),
(66, 66, 2, 'Allow'),
(67, 67, 2, 'Allow'),
(68, 68, 2, 'Allow'),
(69, 69, 2, 'Allow'),
(70, 70, 2, 'Allow'),
(71, 71, 2, 'Allow'),
(72, 72, 2, 'Allow'),
(73, 73, 2, 'Allow'),
(74, 74, 2, 'Allow'),
(75, 75, 2, 'Allow'),
(76, 76, 2, 'Allow'),
(77, 77, 2, 'Allow'),
(78, 78, 2, 'Allow'),
(79, 79, 2, 'Allow'),
(80, 80, 2, 'Allow'),
(81, 81, 2, 'Allow'),
(82, 82, 2, 'Allow'),
(83, 83, 2, 'Allow'),
(84, 84, 2, 'Allow'),
(85, 85, 2, 'Allow'),
(86, 86, 2, 'Allow'),
(87, 87, 2, 'Allow'),
(88, 88, 2, 'Allow'),
(89, 89, 2, 'Allow'),
(90, 90, 2, 'Allow'),
(91, 91, 2, 'Allow'),
(92, 92, 2, 'Allow'),
(93, 93, 2, 'Allow'),
(94, 94, 2, 'Allow'),
(95, 95, 2, 'Allow'),
(96, 96, 2, 'Allow'),
(97, 97, 2, 'Allow'),
(98, 98, 2, 'Allow'),
(99, 99, 2, 'Allow'),
(100, 100, 2, 'Allow'),
(101, 101, 2, 'Allow'),
(102, 102, 2, 'Allow'),
(103, 103, 2, 'Allow'),
(104, 104, 2, 'Allow'),
(105, 105, 2, 'Allow'),
(106, 106, 2, 'Allow'),
(107, 107, 2, 'Allow'),
(108, 108, 2, 'Allow'),
(109, 109, 2, 'Allow'),
(110, 110, 2, 'Allow'),
(111, 111, 2, 'Allow'),
(112, 112, 2, 'Allow'),
(113, 113, 2, 'Allow'),
(114, 114, 2, 'Allow'),
(115, 115, 2, 'Allow'),
(116, 116, 2, 'Allow'),
(117, 117, 2, 'Allow'),
(118, 118, 2, 'Allow'),
(119, 119, 2, 'Allow'),
(120, 120, 2, 'Allow'),
(121, 121, 2, 'Allow'),
(122, 122, 2, 'Allow'),
(123, 123, 2, 'Allow'),
(124, 124, 2, 'Allow'),
(125, 125, 2, 'Allow'),
(126, 126, 2, 'Allow'),
(127, 127, 2, 'Allow'),
(128, 128, 2, 'Allow'),
(129, 129, 2, 'Allow'),
(130, 130, 2, 'Allow'),
(131, 131, 2, 'Allow'),
(132, 132, 2, 'Allow'),
(133, 133, 2, 'Allow'),
(134, 134, 2, 'Allow'),
(135, 135, 2, 'Allow'),
(136, 136, 2, 'Allow'),
(137, 137, 2, 'Allow'),
(138, 138, 2, 'Allow'),
(139, 139, 2, 'Allow'),
(140, 140, 2, 'Allow'),
(141, 141, 2, 'Allow'),
(142, 142, 2, 'Allow'),
(143, 143, 2, 'Allow'),
(144, 144, 2, 'Allow'),
(145, 145, 2, 'Allow'),
(146, 146, 2, 'Allow'),
(147, 147, 2, 'Allow'),
(148, 148, 2, 'Allow'),
(149, 149, 2, 'Allow'),
(150, 150, 2, 'Allow'),
(151, 151, 2, 'Allow'),
(152, 152, 2, 'Allow'),
(153, 153, 2, 'Allow'),
(154, 154, 2, 'Allow'),
(155, 155, 2, 'Allow'),
(156, 156, 2, 'Allow'),
(157, 157, 2, 'Allow'),
(158, 158, 2, 'Allow'),
(159, 159, 2, 'Allow'),
(160, 160, 2, 'Allow'),
(161, 161, 2, 'Allow'),
(162, 162, 2, 'Allow'),
(163, 163, 2, 'Allow'),
(164, 164, 2, 'Allow'),
(165, 165, 2, 'Allow'),
(166, 166, 2, 'Allow'),
(167, 167, 2, 'Allow'),
(168, 168, 2, 'Allow'),
(169, 169, 2, 'Allow'),
(170, 170, 2, 'Allow'),
(171, 171, 2, 'Allow'),
(172, 172, 2, 'Allow'),
(173, 173, 2, 'Allow'),
(174, 174, 2, 'Allow'),
(175, 175, 2, 'Allow'),
(176, 176, 2, 'Allow'),
(177, 177, 2, 'Allow'),
(178, 178, 2, 'Allow'),
(179, 179, 2, 'Allow'),
(180, 180, 2, 'Allow'),
(181, 181, 2, 'Allow'),
(182, 182, 2, 'Allow'),
(183, 183, 2, 'Allow'),
(184, 184, 2, 'Allow'),
(185, 185, 2, 'Allow'),
(186, 186, 2, 'Allow'),
(187, 187, 2, 'Allow'),
(188, 188, 2, 'Allow'),
(189, 189, 2, 'Allow'),
(190, 190, 2, 'Allow'),
(191, 191, 2, 'Allow'),
(192, 192, 2, 'Allow'),
(193, 193, 2, 'Allow'),
(194, 194, 2, 'Allow'),
(195, 195, 2, 'Allow'),
(196, 196, 2, 'Allow');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_company_id_unique` (`name`,`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `company_id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Super Admin', 'It is a SuperAdmin who manages the whole EP Portal', '2016-10-19 15:52:46', '2016-10-19 15:52:46', NULL),
(2, 1, 'Company Admin', 'It is a Admin for the registered company, who manages his company on EP', '2016-10-19 15:52:46', '2016-10-19 15:52:46', NULL),
(3, NULL, 'Portal User', 'It is a Registered User into public EP portal', '2016-10-19 15:52:47', '2016-10-19 15:52:47', NULL),
(4, NULL, 'Portal Doctor', 'It is a Registered User who is actually a doctor but not the EP company doctor', '2016-10-19 15:52:47', '2016-10-19 15:52:47', NULL),
(5, 1, 'Company Doctor', 'It is a Employee of the registered company who perform his job as a Doctor', '2016-10-19 15:52:47', '2016-10-19 15:52:47', NULL),
(6, 1, 'Receptionist', 'It is an Employee of the registered company who perform his job as a Receptionist', '2016-10-19 15:52:47', '2016-10-19 15:52:47', NULL),
(7, 1, 'Nurse', 'It is an Employee of the registered company who perform his job as a Nurse', '2016-10-19 15:52:47', '2016-10-19 15:52:47', NULL),
(8, 1, 'Accountant', 'It is an Employee of the registered company who perform his job as a Nurse', '2016-10-19 15:52:47', '2016-10-19 15:52:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `states_name_country_id_unique` (`name`,`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Punjab', '2016-10-19 15:52:29', '2016-10-19 15:52:29', NULL),
(2, 1, 'Sindh', '2016-10-19 15:52:29', '2016-10-19 15:52:29', NULL),
(3, 1, 'Blochistan', '2016-10-19 15:52:29', '2016-10-19 15:52:29', NULL),
(4, 1, 'Khaiber Pakhtoon Khan', '2016-10-19 15:52:29', '2016-10-19 15:52:29', NULL),
(5, 2, 'Dubai', '2016-10-19 15:52:29', '2016-10-19 15:52:29', NULL),
(6, 2, 'Abu Dhabi', '2016-10-19 15:52:29', '2016-10-19 15:52:29', NULL),
(7, 2, 'Sharjah', '2016-10-19 15:52:29', '2016-10-19 15:52:29', NULL),
(8, 2, 'Fujairah', '2016-10-19 15:52:29', '2016-10-19 15:52:29', NULL),
(9, 2, 'Umm al-Quwain', '2016-10-19 15:52:29', '2016-10-19 15:52:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `surgical_histories`
--

CREATE TABLE IF NOT EXISTS `surgical_histories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_unit_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `surgery_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surgery_date` date DEFAULT NULL,
  `surgery_notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `time_slots`
--

CREATE TABLE IF NOT EXISTS `time_slots` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `duty_day_id` int(11) NOT NULL,
  `slot` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `time_slots`
--

INSERT INTO `time_slots` (`id`, `doctor_id`, `duty_day_id`, `slot`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '06:00:00', '2016-10-20 15:24:52', '2016-10-20 15:24:52'),
(2, 1, 1, '06:20:00', '2016-10-20 15:24:52', '2016-10-20 15:24:52'),
(3, 1, 1, '06:40:00', '2016-10-20 15:24:52', '2016-10-20 15:24:52'),
(4, 1, 1, '07:00:00', '2016-10-20 15:24:52', '2016-10-20 15:24:52'),
(5, 1, 1, '07:20:00', '2016-10-20 15:24:52', '2016-10-20 15:24:53'),
(6, 1, 1, '07:40:00', '2016-10-20 15:24:53', '2016-10-20 15:24:53'),
(7, 1, 1, '08:00:00', '2016-10-20 15:24:53', '2016-10-20 15:24:53'),
(8, 1, 1, '08:20:00', '2016-10-20 15:24:53', '2016-10-20 15:24:53'),
(9, 1, 1, '08:40:00', '2016-10-20 15:24:53', '2016-10-20 15:24:53'),
(10, 1, 1, '09:00:00', '2016-10-20 15:24:53', '2016-10-20 15:24:53'),
(11, 1, 1, '09:20:00', '2016-10-20 15:24:53', '2016-10-20 15:24:53'),
(12, 1, 1, '09:40:00', '2016-10-20 15:24:53', '2016-10-20 15:24:53'),
(13, 1, 1, '10:00:00', '2016-10-20 15:24:53', '2016-10-20 15:24:53'),
(14, 1, 1, '10:20:00', '2016-10-20 15:24:54', '2016-10-20 15:24:54'),
(15, 1, 1, '10:40:00', '2016-10-20 15:24:54', '2016-10-20 15:24:54'),
(16, 1, 1, '11:00:00', '2016-10-20 15:24:54', '2016-10-20 15:24:54'),
(17, 1, 1, '11:20:00', '2016-10-20 15:24:54', '2016-10-20 15:24:54'),
(18, 1, 1, '11:40:00', '2016-10-20 15:24:54', '2016-10-20 15:24:54'),
(19, 1, 1, '12:00:00', '2016-10-20 15:24:54', '2016-10-20 15:24:54'),
(20, 1, 1, '12:20:00', '2016-10-20 15:24:54', '2016-10-20 15:24:55'),
(21, 1, 1, '12:40:00', '2016-10-20 15:24:55', '2016-10-20 15:24:55'),
(22, 1, 1, '13:00:00', '2016-10-20 15:24:55', '2016-10-20 15:24:55'),
(23, 1, 1, '13:20:00', '2016-10-20 15:24:55', '2016-10-20 15:24:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `business_unit_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` enum('Super Admin','Admin','Employee','Worker','Doctor','Patient','Portal User') COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `cnic` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` enum('Male','Female') COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cell` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `additional_info` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company_id`, `business_unit_id`, `city_id`, `username`, `email`, `password`, `fname`, `lname`, `full_name`, `user_type`, `photo`, `dob`, `cnic`, `gender`, `address`, `cell`, `phone`, `status`, `additional_info`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, 1, 'superAdmin', 'superAdmin@easyphysicians.com', '$2y$10$/B23TVvKQ8KalDHapDvg7erF0p6t4YMBn3TetEeLcLsOyquAqbQ0S', 'Rashid', 'Hussain', 'Rashid Hussain', 'Super Admin', 'rashid.png', '1988-12-01', '35200-1478048-1', 'Male', NULL, NULL, NULL, 'Active', NULL, NULL, '2016-10-19 15:52:37', '2016-10-19 15:52:37', NULL),
(2, 1, 1, 1, 'adminD1', 'admin@easyphysicians.com', '$2y$10$PyYXIRaRq3PbRjCnyzSRdOxNwHZPKe/5axExdZDZHGgyE9/Hv8/ZW', 'Ahmad', 'Raza', 'Ahmad Raza', 'Admin', 'ali.png', '1988-12-01', '35200-1478048-1', 'Male', NULL, NULL, NULL, 'Active', NULL, 'r3f3YkLNWyPcLrlgzwVQ44SJlsC1uw0sVrHB8zwKUKNtBMy3mWgAjIDHLbJE', '2016-10-19 15:52:37', '2016-12-27 14:41:02', NULL),
(3, 1, 1, 1, 'doctor', 'doctor@easyphysicians.com', '$2y$10$Z1HnqRzaEnO2wW6J3ul4ZuSkKxOZuaPU1lO8A65uCRddJ.Lhwk7ny', 'Ehsaan', 'Ali', 'Ehsaan Ali', 'Doctor', 'aitzaz.jpg', '1988-12-01', '35200-1478048-1', 'Male', NULL, '03347009694', '03347009694', 'Active', NULL, NULL, '2016-10-19 15:52:38', '2016-10-19 15:52:38', NULL),
(4, 1, 1, 1, 'receptionist', 'receptionist@easyphysicians.com', '$2y$10$8zZ40AGMh6xJXAVf8YCKgenc1FamKRuee6QNnJsh/uxq5Ga4XGbAW', 'Rafia', 'Khan', 'Rafia Khan', 'Employee', 'index-1_img07.jpg', '1988-12-01', '35200-1478048-1', 'Female', NULL, NULL, NULL, 'Active', NULL, NULL, '2016-10-19 15:52:38', '2016-10-19 15:52:38', NULL),
(5, 1, 1, 1, 'nurse', 'nurse@easyphysicians.com', '$2y$10$klP8xcMYo06dSuUu34hV9OUCzYLfelTdbI/HVgdsYATKhQskYu.8u', 'Shaziya', 'Tariq', 'Shaziya Tariq', 'Employee', 'index-2_img04.jpg', '1988-12-01', '35200-1478048-1', 'Female', NULL, NULL, NULL, 'Active', NULL, NULL, '2016-10-19 15:52:39', '2016-10-19 15:52:39', NULL),
(6, 1, 1, 1, 'accountant', 'accountant@easyphysicians.com', '$2y$10$EA.0CdTlQ881lZEDZacI2..N5bsDxKcSuLffpjJG17NntU7ubtCwO', 'Umer', 'Khan', 'Umer Khan', 'Employee', 'index-1_img06.jpg', '1988-12-01', '35200-1478048-1', 'Female', NULL, NULL, NULL, 'Active', NULL, NULL, '2016-10-19 15:52:39', '2016-10-19 15:52:39', NULL),
(7, 2, 3, 1, 'adminD2', 'adminTwo@easyphysicians.com', '$2y$10$mh5FJCUyigxo8M7/mrRS8uISAzGf.EptAzBKbZ7hOCFPW/GwqEuky', 'Atif', 'Khan', 'Atif Khan', 'Admin', 'index-3_img02.jpg', '1988-12-01', '35200-1478048-1', 'Male', NULL, NULL, NULL, 'Active', NULL, NULL, '2016-10-19 15:52:40', '2016-10-19 15:52:40', NULL),
(8, 1, 1, 1, 'roel.haag', 'nienow.pearl@blick.net', '$2y$10$PBe.8X3lvg4Ex9cgHrjY9OWAXjlmyMTZgnTaam.5UUVthsZqhYDW2', 'Scottie', 'Kemmer', 'Deontae Toy', 'Doctor', 'index-1_img08.jpg', '1984-11-06', '35200-1664795-7', 'Male', '07217 Clotilde Estate Apt. 672\nPort Arishire, MO 30983', '567.313.5363x712', NULL, 'Active', NULL, NULL, '2016-10-19 15:52:40', '2016-10-19 15:52:40', NULL),
(9, 1, 2, 2, 'stracke.josefina', 'adaline.stokes@hotmail.com', '$2y$10$00aAL4BM6TNq82Fxx27lYevK3jCrIFzTYAeM578uZ.Iv7aCedqvjW', 'Arch', 'Flatley', 'Aliyah Hirthe', 'Doctor', 'index-1_img03.jpg', '1921-01-06', '35200-1588321-3', 'Female', '92109 Oda Field\nWest Jacynthestad, FM 49038-3190', '1-564-978-3858x6', NULL, 'Active', NULL, NULL, '2016-10-19 15:52:40', '2016-10-19 15:52:40', NULL),
(10, 2, 3, 3, 'jena68', 'wwalter@waelchiwisoky.com', '$2y$10$RllxpnIGoM2nPRKbkYSctuffg5sSPlW6MimNMPb9P2LZhpzuREz4u', 'Caleigh', 'O''Connell', 'Amy Bogan', 'Doctor', 'index-1_img04.jpg', '1984-11-06', '35200-1786051-7', 'Male', '40873 McClure Harbors Suite 850\nVeldafort, FL 35944-0751', '515.725.7171', NULL, 'Active', NULL, NULL, '2016-10-19 15:52:41', '2016-10-19 15:52:41', NULL),
(11, 2, 4, 4, 'eschowalter', 'bturner@gleichner.com', '$2y$10$yd7rRaH3EVu7ctVBiAbqfu5mvCJit6cp.IZiEJnY6HZ1F5fDE.hOm', 'Frida', 'Rolfson', 'Elizabeth King', 'Doctor', 'index-1_img05.jpg', '1984-11-06', '35200-1939266-8', 'Male', '2343 Linnea Village\nPort Lexus, SD 16170-5954', '783-125-9195', NULL, 'Active', NULL, NULL, '2016-10-19 15:52:41', '2016-10-19 15:52:41', NULL),
(12, 1, 1, 5, 'zena.mraz', 'soledad.beer@yahoo.com', '$2y$10$gy5fVtJRqSz8oQXpnNi/u.oE4Cw7DMYEhWLcSM3Zuzhw4bj7faGlO', 'Sheridan', 'Harris', 'Joelle Thompson', 'Doctor', 'index-1_img04.jpg', '1931-11-19', '35200-1837710-5', 'Female', '8095 Schoen Light\nDenesikborough, NJ 11395-4074', '(495)057-9811x86', NULL, 'Active', NULL, NULL, '2016-10-19 15:52:42', '2016-10-19 15:52:42', NULL),
(13, 1, 2, 6, 'felipa.oberbrunner', 'freddie54@hotmail.com', '$2y$10$RFPyRIdtYP3L0xo4zo.I/OFtZE/kES/Ffig1pRGffmALfGU.tZMUC', 'Kathryne', 'Kerluke', 'Mable Kunze', 'Doctor', 'index-1_img07.jpg', '1984-11-06', '35200-2702372-1', 'Female', '799 Spinka Trail\nNew Rahulshire, AR 85553', '299.690.5415', NULL, 'Active', NULL, NULL, '2016-10-19 15:52:42', '2016-10-19 15:52:42', NULL),
(14, 2, 3, 7, 'metz.cristopher', 'pmertz@gmail.com', '$2y$10$2oxaf0SKdluxYEO86flCjuZHOCrlTfGoCmNE8BG8OsLwUfbUitd/2', 'Whitney', 'Wehner', 'Johann Dare', 'Doctor', 'index-1_img06.jpg', '1955-10-12', '35200-1790354-6', 'Male', '9001 Hirthe Loaf\nNorth Abnershire, WV 05085-8689', '(870)992-5157', NULL, 'Active', NULL, NULL, '2016-10-19 15:52:43', '2016-10-19 15:52:43', NULL),
(15, 2, 4, 8, 'alexander29', 'felicia05@yahoo.com', '$2y$10$7h1xWqhZMeL9LxkFNPJU..BdE8X28KHSOYUqs0P8bzV7URuu36fTu', 'Moises', 'Veum', 'Kari Brakus', 'Doctor', 'index-1_img08.jpg', '1937-07-01', '35200-2658454-7', 'Male', '097 Darlene Islands\nJeremyton, AS 31078-1602', '(950)570-3470x78', NULL, 'Active', NULL, NULL, '2016-10-19 15:52:43', '2016-10-19 15:52:43', NULL),
(16, 1, 1, 9, 'tamia.nicolas', 'sophia85@yahoo.com', '$2y$10$qHfStgWPwjbWqnnEa0CQL.RlcAVHI1rBzzV/a1HGfS6UkRXiUgtk.', 'Randy', 'O''Conner', 'Armand Bahringer', 'Patient', 'index-1_img05.jpg', '1957-10-15', '35200-2362840-4', 'Male', '14134 Wilfredo Manor\nKuhlmanborough, MN 03379', '+98(9)2539395266', NULL, 'Active', NULL, NULL, '2016-10-19 15:52:44', '2016-10-19 15:52:44', NULL),
(17, 1, 2, 10, 'rodger.heidenreich', 'jovany15@hotmail.com', '$2y$10$DxJU1me7KkpXpceWMWHfPO0DoJBVvb32t3oW4c3k/VMqGn8JvS56O', 'Heath', 'Keeling', 'Kenna Mohr', 'Patient', 'index-1_img06.jpg', '1984-11-06', '35200-1594242-4', 'Male', '67111 Stanley Plains Apt. 035\nWest Jakayla, WY 29213', '(824)572-9234', NULL, 'Inactive', NULL, NULL, '2016-10-19 15:52:45', '2016-10-19 15:52:45', NULL),
(18, 1, 1, 1, 'Aitzaz', 'aitzazwattoo96@gmail.com', '$2y$10$L26ivWps//G1iwt1UDLol.M6.5WwVFTk3ZqQcOt0zmMEVH5ah.izK', 'Aitzaz', 'Hassan', 'Aitzaz Hassan', 'Patient', 'aitzaz.jpg', '1995-04-15', '3110166247333', 'Male', 'Bahawalnaagr', '3347009694', '3347009694', 'Active', 'yead', NULL, '2016-11-03 12:30:00', '2016-11-03 12:30:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vital_signs`
--

CREATE TABLE IF NOT EXISTS `vital_signs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `weight` smallint(6) DEFAULT NULL,
  `height` smallint(6) DEFAULT NULL,
  `bp_systolic` int(11) DEFAULT NULL,
  `bp_diastolic` int(11) DEFAULT NULL,
  `blood_group` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pulse_rate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `respiration_rate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `temperature` int(11) DEFAULT NULL,
  `gait_speed` int(11) DEFAULT NULL,
  `addiction` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `communities` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `vital_signs`
--

INSERT INTO `vital_signs` (`id`, `patient_id`, `appointment_id`, `weight`, `height`, `bp_systolic`, `bp_diastolic`, `blood_group`, `pulse_rate`, `respiration_rate`, `temperature`, `gait_speed`, `addiction`, `communities`, `note`, `created_at`, `updated_at`, `deleted_at`) VALUES
(27, 2, 3, 22, 22, 22, 22, 'AB+', '22', '22', 22, 22, 'No', 'No', 'No', '2016-11-14 10:55:45', '2016-11-14 10:55:45', NULL),
(28, 1, 3, 53, 5, 128, 90, 'O+', '65', '75', 99, 102, 'No', 'Scouting', 'Head Operation Holder', '2016-11-16 12:02:51', '2016-11-16 12:02:51', NULL),
(29, 2, 3, 55, 6, 123, 98, 'A+', '78', '65', 98, 123, 'No', 'No', 'No', '2016-11-16 15:14:41', '2016-11-16 15:14:41', NULL),
(30, 2, 3, 48, 54, 124, 89, 'O+', '76', '76', 98, 123, 'No', 'Scouting', 'No', '2016-11-16 15:18:35', '2016-11-16 15:18:35', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
