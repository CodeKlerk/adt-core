-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 14, 2017 at 06:07 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.6.14-1+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `new_adt`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `patients_enrolled_in_care`
--
CREATE TABLE IF NOT EXISTS `patients_enrolled_in_care` (
`source` varchar(30)
,`service` varchar(20)
,`gender` enum('male','female')
,`birth_date` date
,`enrollment_date` date
,`facility` varchar(30)
,`subcounty` varchar(30)
,`county` varchar(20)
);
-- --------------------------------------------------------

--
-- Table structure for table `regimen_drug`
--

CREATE TABLE IF NOT EXISTS `regimen_drug` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `drug_id` bigint(20) NOT NULL,
  `regimen` text NOT NULL,
  `source` varchar(10) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  `Merged_From` varchar(50) NOT NULL,
  `Regimen_Merged_From` varchar(20) NOT NULL,
  `ccc_store_sp` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  KEY `ccc_store_sp` (`ccc_store_sp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_access_level`
--

CREATE TABLE IF NOT EXISTS `tbl_access_level` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_access_level`
--

INSERT INTO `tbl_access_level` (`id`, `name`, `deleted_at`, `description`, `created_at`, `updated_at`) VALUES
(1, 'System Administ', NULL, 'Users with this access level can perform all administrative duties in the system', NULL, NULL),
(2, 'Pharmacist', NULL, 'Users with this access level can only manage their patients and making orders for new drugs', NULL, NULL),
(3, 'Facility Admini', NULL, 'Highest Level of User in Facility', NULL, NULL),
(4, 'The Brian Level', '2017-02-10 09:10:03', 'Super admin', '2017-02-10 09:09:13', '2017-02-10 09:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointment`
--

CREATE TABLE IF NOT EXISTS `tbl_appointment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `appointment_date` date NOT NULL,
  `is_appointment` tinyint(1) NOT NULL DEFAULT '1',
  `patient_id` bigint(20) NOT NULL,
  `facility_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appointment_date` (`appointment_date`),
  KEY `patient_id` (`patient_id`),
  KEY `facility_id` (`facility_id`),
  KEY `is_appointment` (`is_appointment`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'PMTCT Mother', NULL, NULL, NULL),
(2, 'Adult First Line', NULL, NULL, NULL),
(3, 'Adult Second Line', NULL, NULL, NULL),
(4, 'Other Adult ART', NULL, NULL, NULL),
(5, 'Paediatric First lin', NULL, NULL, NULL),
(6, 'Paediatric Second li', NULL, NULL, NULL),
(7, 'Other Pediatrics Reg', NULL, NULL, NULL),
(8, 'B C', '2017-01-23 10:20:33', '2017-01-23 10:05:35', '2017-01-23 10:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cdrr`
--

CREATE TABLE IF NOT EXISTS `tbl_cdrr` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) NOT NULL,
  `code` enum('D-CDRR','F-CDRR_units,F-CDRR_packs') NOT NULL,
  `period_begin` date NOT NULL,
  `period_end` date NOT NULL,
  `comments` text NOT NULL,
  `reports_expected` int(11) NOT NULL DEFAULT '0',
  `reports_actual` int(11) NOT NULL DEFAULT '0',
  `services` text NOT NULL,
  `is_non_arv` tinyint(1) NOT NULL DEFAULT '0',
  `facility_id` bigint(20) NOT NULL,
  `supporter_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `facility_id` (`facility_id`),
  KEY `supporter_id` (`supporter_id`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `code` (`code`),
  KEY `period_begin` (`period_begin`),
  KEY `period_end` (`period_end`),
  KEY `reports_expected` (`reports_expected`),
  KEY `reports_actual` (`reports_actual`),
  KEY `is_non_arv` (`is_non_arv`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cdrr_item`
--

CREATE TABLE IF NOT EXISTS `tbl_cdrr_item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `balance` int(11) DEFAULT NULL,
  `received` int(11) DEFAULT NULL,
  `dispensed_units` int(11) DEFAULT NULL,
  `dispensed_packs` int(11) DEFAULT NULL,
  `losses` int(11) DEFAULT NULL,
  `adjustments_pos` int(11) DEFAULT NULL,
  `adjustments_neg` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `expiry_quantity` int(11) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `out_of_stock` int(11) DEFAULT NULL,
  `resupply` int(11) DEFAULT NULL,
  `aggr_consumed` int(11) DEFAULT NULL,
  `aggr_on_hand` int(11) DEFAULT NULL,
  `drug_id` bigint(20) NOT NULL,
  `cdrr_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `drug_id` (`drug_id`),
  KEY `cdrr_id` (`cdrr_id`),
  KEY `balance` (`balance`),
  KEY `received` (`received`),
  KEY `dispensed_units` (`dispensed_units`),
  KEY `dispensed_packs` (`dispensed_packs`),
  KEY `losses` (`losses`),
  KEY `adjustments_pos` (`adjustments_pos`),
  KEY `adjustments_neg` (`adjustments_neg`),
  KEY `count` (`count`),
  KEY `expiry_quantity` (`expiry_quantity`),
  KEY `expiry_date` (`expiry_date`),
  KEY `out_of_stock` (`out_of_stock`),
  KEY `resupply` (`resupply`),
  KEY `aggr_consumed` (`aggr_consumed`),
  KEY `aggr_on_hand` (`aggr_on_hand`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cdrr_log`
--

CREATE TABLE IF NOT EXISTS `tbl_cdrr_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `status` varchar(10) NOT NULL,
  `cdrr_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cdrr_id` (`cdrr_id`),
  KEY `user_id` (`user_id`),
  KEY `status` (`status`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_change_reason`
--

CREATE TABLE IF NOT EXISTS `tbl_change_reason` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_change_reason`
--

INSERT INTO `tbl_change_reason` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Toxicity/Side effect', '2017-01-26 16:42:30', '2017-01-26 16:42:30', NULL),
(2, 'Pregnancy', '2017-01-26 16:45:27', '2017-01-26 16:45:27', NULL),
(3, 'brian', '2017-01-26 16:46:33', '2017-01-26 16:59:39', '2017-01-26 16:59:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_classification`
--

CREATE TABLE IF NOT EXISTS `tbl_classification` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_classification`
--

INSERT INTO `tbl_classification` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'classification', '2017-02-09 17:34:33', '2017-02-09 17:36:42', '2017-02-09 17:36:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_county`
--

CREATE TABLE IF NOT EXISTS `tbl_county` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `tbl_county`
--

INSERT INTO `tbl_county` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'baringo', NULL, NULL, NULL),
(2, 'bomet', NULL, NULL, NULL),
(3, 'bungoma', NULL, NULL, NULL),
(4, 'busia', NULL, NULL, NULL),
(5, 'elgeyo marakwet', NULL, NULL, NULL),
(6, 'embu', NULL, NULL, NULL),
(7, 'garissa', NULL, NULL, NULL),
(8, 'homa bay', NULL, NULL, NULL),
(9, 'isiolo', NULL, NULL, NULL),
(10, 'kajiado', NULL, NULL, NULL),
(11, 'kakamega', NULL, NULL, NULL),
(12, 'kericho', NULL, NULL, NULL),
(13, 'kiambu', NULL, NULL, NULL),
(14, 'kilifi', NULL, NULL, NULL),
(15, 'kirinyaga', NULL, NULL, NULL),
(16, 'kisii', NULL, NULL, NULL),
(17, 'kisumu', NULL, NULL, NULL),
(18, 'kitui', NULL, NULL, NULL),
(19, 'kwale', NULL, NULL, NULL),
(20, 'laikipia', NULL, NULL, NULL),
(21, 'lamu', NULL, NULL, NULL),
(22, 'machakos', NULL, NULL, NULL),
(23, 'makueni', NULL, NULL, NULL),
(24, 'mandera', NULL, NULL, NULL),
(25, 'marsabit', NULL, NULL, NULL),
(26, 'meru', NULL, NULL, NULL),
(27, 'migori', NULL, NULL, NULL),
(28, 'mombasa', NULL, NULL, NULL),
(29, 'muranga', NULL, NULL, NULL),
(30, 'nairobi', NULL, NULL, NULL),
(31, 'nakuru', NULL, NULL, NULL),
(32, 'nandi', NULL, NULL, NULL),
(33, 'narok', NULL, NULL, NULL),
(34, 'nyamira', NULL, NULL, NULL),
(35, 'nyandarua', NULL, NULL, NULL),
(36, 'nyeri', NULL, NULL, NULL),
(37, 'samburu', NULL, NULL, NULL),
(38, 'siaya', NULL, NULL, NULL),
(39, 'taita taveta', NULL, NULL, NULL),
(40, 'tana river', NULL, NULL, NULL),
(41, 'tharaka nithi', NULL, NULL, NULL),
(42, 'trans nzoia', NULL, NULL, NULL),
(43, 'turkana', NULL, NULL, NULL),
(44, 'uasin gishu', NULL, NULL, NULL),
(45, 'vihiga', NULL, NULL, NULL),
(46, 'wajir', NULL, NULL, NULL),
(47, 'west pokot', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_county_sub`
--

CREATE TABLE IF NOT EXISTS `tbl_county_sub` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `county_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `county_id` (`county_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_county_sub`
--

INSERT INTO `tbl_county_sub` (`id`, `name`, `deleted_at`, `county_id`) VALUES
(1, 'Sub_county', NULL, 2),
(2, 'Sub_county2', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dose`
--

CREATE TABLE IF NOT EXISTS `tbl_dose` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `frequency` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `quantity` (`quantity`),
  KEY `frequency` (`frequency`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_dose`
--

INSERT INTO `tbl_dose` (`id`, `name`, `quantity`, `frequency`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dose one', 0, 0, NULL, NULL, NULL),
(2, 'Dose two', 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drug`
--

CREATE TABLE IF NOT EXISTS `tbl_drug` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(35) NOT NULL,
  `pack_size` int(11) NOT NULL DEFAULT '0',
  `duration` int(11) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `is_arv` tinyint(1) NOT NULL DEFAULT '0',
  `is_tb` tinyint(1) NOT NULL DEFAULT '0',
  `is_oi` tinyint(1) NOT NULL DEFAULT '0',
  `unit_id` bigint(20) NOT NULL,
  `dose_id` bigint(20) NOT NULL,
  `generic_id` bigint(20) NOT NULL,
  `supporter_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `unit_id` (`unit_id`),
  KEY `dose_id` (`dose_id`),
  KEY `generic_id` (`generic_id`),
  KEY `pack_size` (`pack_size`),
  KEY `duration` (`duration`),
  KEY `quantity` (`quantity`),
  KEY `is_arv` (`is_arv`),
  KEY `is_tb` (`is_tb`),
  KEY `support_id` (`supporter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_drug`
--

INSERT INTO `tbl_drug` (`id`, `name`, `pack_size`, `duration`, `quantity`, `is_arv`, `is_tb`, `is_oi`, `unit_id`, `dose_id`, `generic_id`, `supporter_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'NEVIRAPINE', 20, 20, 30, 0, 0, 0, 1, 2, 1, 1, NULL, '2017-01-17 06:37:39', NULL),
(2, 'ABACAVIR (ABC)300MG TABS', 20, 20, 30, 0, 0, 0, 1, 2, 1, 1, NULL, NULL, NULL),
(3, 'ABACAVIR 60/LAMIVUDINE 30MG TABS', 20, 20, 30, 0, 0, 0, 1, 2, 1, 1, NULL, NULL, NULL),
(4, 'ABC/3TC 60/30 FDC Tabs', 20, 20, 30, 0, 0, 0, 3, 2, 1, 1, NULL, NULL, NULL),
(5, 'ACYCLOVIR 400 MG TABS ( 30s)', 20, 20, 30, 0, 0, 0, 3, 2, 1, 1, NULL, NULL, NULL),
(6, 'ACYCLOVIR 400MG (10s)', 20, 20, 30, 0, 0, 0, 3, 2, 1, 1, NULL, NULL, NULL),
(7, 'AMPHOTERICIN B 50MG INJ', 20, 20, 30, 0, 0, 0, 5, 2, 1, 1, NULL, NULL, NULL),
(8, 'AZT/3TC  FDC (300MG/150MG)TABS', 20, 20, 30, 0, 0, 0, 5, 2, 1, 1, NULL, NULL, NULL),
(9, 'AZT/3TC  FDC (60MG/30MG)', 20, 20, 30, 0, 0, 0, 10, 2, 1, 1, NULL, NULL, NULL),
(10, 'AZT/3TC/NVP  FDC (300MG/150MG/200MG', 20, 20, 30, 0, 0, 0, 2, 2, 1, 1, NULL, NULL, NULL),
(11, 'AZT/3TC/NVP FDC  (60MG/30MG/50MG)', 20, 20, 30, 0, 0, 0, 8, 2, 1, 1, NULL, NULL, NULL),
(12, 'COTRIMOXAZOLE 480MG Tabs', 20, 20, 30, 0, 0, 0, 6, 2, 1, 1, NULL, NULL, NULL),
(13, 'COTRIMOXAZOLE 960MG Tabs (100s)', 20, 20, 30, 0, 0, 0, 4, 2, 1, 1, NULL, NULL, NULL),
(14, 'COTRIMOXAZOLE DS 960 ( 500s)', 20, 20, 30, 0, 0, 0, 4, 2, 1, 1, NULL, NULL, NULL),
(15, 'COTRIMOXAZOLE Susp 240mg/5ml', 20, 20, 30, 0, 0, 0, 3, 2, 1, 1, NULL, NULL, NULL),
(16, 'NEVIRAPINE (NVP) Susp 10MG/ML  PMTC', 20, 20, 30, 0, 0, 0, 1, 2, 1, 1, '2017-01-16 07:36:57', '2017-01-16 07:36:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drug_instruction`
--

CREATE TABLE IF NOT EXISTS `tbl_drug_instruction` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `drug_id` bigint(20) NOT NULL,
  `instruction_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `drug_id` (`drug_id`),
  KEY `instruction_id` (`instruction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drug_stock_balance`
--

CREATE TABLE IF NOT EXISTS `tbl_drug_stock_balance` (
  `id` bigint(20) NOT NULL,
  `stock_item_id` bigint(20) NOT NULL,
  `stock_type` int(4) NOT NULL,
  `balance` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_item_id` (`stock_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facility`
--

CREATE TABLE IF NOT EXISTS `tbl_facility` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `postal_address` varchar(20) NOT NULL,
  `email_address` varchar(30) NOT NULL,
  `phone_number` int(12) NOT NULL,
  `adult_age` int(3) NOT NULL DEFAULT '14' COMMENT 'age in years',
  `service` text NOT NULL,
  `weekday_max` int(5) NOT NULL,
  `weekend_max` int(5) NOT NULL DEFAULT '0',
  `county_sub_id` bigint(20) NOT NULL,
  `supporter_id` bigint(20) NOT NULL,
  `facility_type_id` int(10) NOT NULL DEFAULT '5',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_sms` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `code` (`code`),
  KEY `name` (`name`),
  KEY `supporter_id` (`supporter_id`),
  KEY `county_sub_id` (`county_sub_id`),
  KEY `facility_type_id` (`facility_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_facility`
--

INSERT INTO `tbl_facility` (`id`, `code`, `name`, `postal_address`, `email_address`, `phone_number`, `adult_age`, `service`, `weekday_max`, `weekend_max`, `county_sub_id`, `supporter_id`, `facility_type_id`, `created_at`, `updated_at`, `deleted_at`, `is_sms`) VALUES
(1, 19224, ' CDF Kiriari Dispensary', 'P.O Box 15356', 'adt@development.test', 733231565, 18, 'all', 20, 15, 1, 1, 5, NULL, NULL, '0000-00-00 00:00:00', 0),
(2, 14180, '10 Engineer VCT', 'P.O Box 15356', 'adt@development.test', 733231565, 18, 'all', 20, 15, 1, 1, 5, NULL, NULL, NULL, 0),
(3, 17486, '12 Engineers', 'P.O Box 15356', 'adt@development.test', 733231565, 18, 'all', 20, 15, 1, 1, 5, NULL, NULL, NULL, 0),
(4, 18393, '3Kl Maternity & Nursing Home', 'P.O Box 15356', 'adt@development.test', 733231565, 18, 'all', 20, 15, 1, 1, 5, NULL, NULL, NULL, 0),
(5, 14181, '3Kr Health Centre', 'P.O Box P.O. Box 301', 'adt@development.test', 733231565, 18, 'all', 20, 15, 1, 1, 5, NULL, NULL, NULL, 0),
(6, 11917, '78 Tank Battalion Dispensary', 'P.O. Box 66', 'adt@development.test', 721436270, 18, 'all', 20, 15, 1, 1, 5, NULL, NULL, NULL, 0),
(7, 13043, '7Kr Mrs Health Centre', 'P.O Box 44008', 'adt@development.test', 733231565, 18, 'all', 20, 15, 1, 1, 5, NULL, NULL, NULL, 0),
(8, 14182, '8Th Street Clinic', 'P.O Box 8626', 'adt@development.test', 720, 18, 'all', 20, 15, 1, 1, 5, NULL, NULL, NULL, 0),
(9, 18137, 'A To Z Quality Health Family H', 'P.O Box 12514', 'adt@development.test', 733231565, 18, 'all', 20, 15, 1, 1, 5, NULL, NULL, NULL, 0),
(10, 20346, 'AAR Adams Health Centre', 'P.O Box 41766', 'adt@development.test', 731191077, 18, 'all', 20, 15, 1, 1, 5, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facility_type`
--

CREATE TABLE IF NOT EXISTS `tbl_facility_type` (
  `id` int(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_facility_type`
--

INSERT INTO `tbl_facility_type` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(0, 'Brian type', '2017-02-10 09:27:20', '2017-02-10 09:29:54', '2017-02-10 09:29:54'),
(1, 'Laboratory (Stand-alone)', NULL, NULL, NULL),
(2, 'Medical Clinic - Nurse/ Midwife', NULL, NULL, NULL),
(3, 'Medical Clinic - Other', NULL, NULL, NULL),
(4, 'Medical Clinic - Clinical office', NULL, NULL, NULL),
(5, 'Dispensary', NULL, NULL, NULL),
(6, 'Health Centre', NULL, NULL, NULL),
(7, 'Rehabilitation Centre', NULL, NULL, NULL),
(8, 'Medical Clinic - Medical special', NULL, NULL, NULL),
(9, 'Nursing home with Maternity', NULL, NULL, NULL),
(10, 'Eye Centre', NULL, NULL, NULL),
(11, 'Medical Clinic - General practitioner', NULL, NULL, NULL),
(12, 'Primary Hospital', NULL, NULL, NULL),
(13, 'Other Health Facility', NULL, NULL, NULL),
(14, 'Other Hospital', NULL, NULL, NULL),
(15, 'Nursing home without Maternity', NULL, NULL, NULL),
(16, 'Dental Clinic', NULL, NULL, NULL),
(17, 'Radiology Unit', NULL, NULL, NULL),
(18, 'Unknown', NULL, NULL, NULL),
(19, 'Training Institution in Health (Stand-alone)', NULL, NULL, NULL),
(20, 'Secondary Hospital', NULL, NULL, NULL),
(21, 'VCT Centre (Stand-Alone)', NULL, NULL, NULL),
(22, 'Tertiary Hospital', NULL, NULL, NULL),
(23, 'Health Programme', NULL, NULL, NULL),
(24, 'Blood Bank', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_family_planning`
--

CREATE TABLE IF NOT EXISTS `tbl_family_planning` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_family_planning`
--

INSERT INTO `tbl_family_planning` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'family plan', NULL, NULL, NULL),
(2, 'B P', '2017-01-23 13:38:46', '2017-01-23 13:42:35', '2017-01-23 13:42:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_generic`
--

CREATE TABLE IF NOT EXISTS `tbl_generic` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_generic`
--

INSERT INTO `tbl_generic` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'abacavir', NULL, NULL, NULL),
(2, 'abacavir/lamivudine', NULL, NULL, NULL),
(3, 'ACYCLOVIR', NULL, NULL, NULL),
(4, 'ALBEDAZOLE', NULL, NULL, NULL),
(5, 'b G', '2017-01-26 17:08:59', '2017-01-26 17:14:33', '2017-01-26 17:14:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_illness`
--

CREATE TABLE IF NOT EXISTS `tbl_illness` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_illness`
--

INSERT INTO `tbl_illness` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Diabetes', NULL, NULL, NULL),
(2, 'Hypertension', NULL, NULL, NULL),
(3, 'Obesity', NULL, NULL, NULL),
(4, 'Asthma', NULL, NULL, NULL),
(5, 'Gout', NULL, NULL, NULL),
(6, 'Arthritis', NULL, NULL, NULL),
(7, 'Cancer', NULL, NULL, NULL),
(8, 'Stroke', NULL, NULL, NULL),
(9, 'Epilepsy', NULL, NULL, NULL),
(10, 'Mental Disorder', NULL, NULL, NULL),
(11, 'Cryptococcal Meningitis', NULL, NULL, NULL),
(12, 'Diability', NULL, NULL, NULL),
(13, 'B I', '2017-01-23 17:31:20', '2017-01-23 17:33:51', '2017-01-23 17:33:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_indication`
--

CREATE TABLE IF NOT EXISTS `tbl_indication` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `code` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_indication`
--

INSERT INTO `tbl_indication` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'indication', '123abc123z', '2017-02-09 17:44:15', '2017-02-09 17:46:57', '2017-02-09 17:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_instruction`
--

CREATE TABLE IF NOT EXISTS `tbl_instruction` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_instruction`
--

INSERT INTO `tbl_instruction` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Warning. May cause drowsiness', '2017-01-26 17:26:40', '2017-01-26 17:26:40', NULL),
(2, 'Dissolve or mix with water before taking', '2017-01-26 17:26:59', '2017-01-26 17:26:59', NULL),
(3, 'This medicine may colour the urine', '2017-01-26 17:27:11', '2017-01-26 17:27:11', NULL),
(4, 'Bs', '2017-01-26 17:27:34', '2017-01-26 17:35:54', '2017-01-26 17:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_maps`
--

CREATE TABLE IF NOT EXISTS `tbl_maps` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `status` varchar(10) NOT NULL,
  `code` enum('D-MAPS,F-MAPS') NOT NULL,
  `period_begin` date NOT NULL,
  `period_end` date NOT NULL,
  `reports_expected` int(11) NOT NULL,
  `reports_actual` int(11) NOT NULL,
  `services` text NOT NULL,
  `comments` text NOT NULL,
  `facility_id` bigint(20) NOT NULL,
  `supporter_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `code` (`code`),
  KEY `period_begin` (`period_begin`),
  KEY `period_end` (`period_end`),
  KEY `reports_expected` (`reports_expected`),
  KEY `reports_actual` (`reports_actual`),
  KEY `facility_id` (`facility_id`),
  KEY `supporter_id` (`supporter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_maps_item`
--

CREATE TABLE IF NOT EXISTS `tbl_maps_item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `total` int(11) DEFAULT NULL,
  `regimen_id` bigint(20) NOT NULL,
  `maps_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `regimen_id` (`regimen_id`),
  KEY `total` (`total`),
  KEY `maps_id` (`maps_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_maps_log`
--

CREATE TABLE IF NOT EXISTS `tbl_maps_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `status` varchar(10) NOT NULL,
  `maps_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `maps_id` (`maps_id`),
  KEY `user_id` (`user_id`),
  KEY `status` (`status`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_non_adherence_reason`
--

CREATE TABLE IF NOT EXISTS `tbl_non_adherence_reason` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_non_adherence_reason`
--

INSERT INTO `tbl_non_adherence_reason` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Toxicity/side effects', '2017-01-26 17:48:26', '2017-01-26 17:48:26', NULL),
(2, 'Share with others', '2017-01-26 17:48:44', '2017-01-26 17:48:44', NULL),
(3, 'Forgot', '2017-01-26 17:48:57', '2017-01-26 17:48:57', NULL),
(4, 'Brian non...something....reaso', '2017-01-26 17:50:43', '2017-01-26 17:52:49', '2017-01-26 17:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_password_resets`
--

CREATE TABLE IF NOT EXISTS `tbl_password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient`
--

CREATE TABLE IF NOT EXISTS `tbl_patient` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ccc_number` varchar(25) NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `other_name` varchar(15) NOT NULL,
  `phone_number` int(12) NOT NULL,
  `alternate_number` int(12) NOT NULL,
  `physical_address` text NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `birth_date` date NOT NULL,
  `initial_height` float NOT NULL,
  `initial_weight` float NOT NULL,
  `enrollment_date` date NOT NULL,
  `support_group` text NOT NULL,
  `status` enum('no partner','concordant','discordunt') NOT NULL,
  `is_pregnant` tinyint(1) NOT NULL DEFAULT '0',
  `is_tb` tinyint(1) NOT NULL DEFAULT '0',
  `is_tb_tested` tinyint(1) NOT NULL DEFAULT '0',
  `is_smoke` tinyint(1) NOT NULL DEFAULT '0',
  `is_alcohol` tinyint(1) NOT NULL DEFAULT '0',
  `is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `service_id` bigint(20) NOT NULL,
  `facility_id` bigint(20) NOT NULL,
  `supporter_id` bigint(20) NOT NULL,
  `source_id` bigint(20) NOT NULL COMMENT 'inpatient,outpatient',
  `county_sub_id` bigint(20) DEFAULT NULL COMMENT 'place of birth',
  `who_stage_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ccc_number` (`ccc_number`),
  KEY `first_name` (`first_name`),
  KEY `last_name` (`last_name`),
  KEY `other_name` (`other_name`),
  KEY `gender` (`gender`),
  KEY `birth_date` (`birth_date`),
  KEY `enrollment_date` (`enrollment_date`),
  KEY `service_id` (`service_id`),
  KEY `facility_id` (`facility_id`),
  KEY `supporter_id` (`supporter_id`),
  KEY `source_id` (`source_id`),
  KEY `county_sub_id` (`county_sub_id`),
  KEY `who_stage_id` (`who_stage_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `tbl_patient`
--

INSERT INTO `tbl_patient` (`id`, `ccc_number`, `first_name`, `last_name`, `other_name`, `phone_number`, `alternate_number`, `physical_address`, `gender`, `birth_date`, `initial_height`, `initial_weight`, `enrollment_date`, `support_group`, `status`, `is_pregnant`, `is_tb`, `is_tb_tested`, `is_smoke`, `is_alcohol`, `is_sms`, `service_id`, `facility_id`, `supporter_id`, `source_id`, `county_sub_id`, `who_stage_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'BSQNL82955', 'Christian', 'Vega', 'Jasmine', 254, 254, 'Ap #405-4940 A Rd.', 'male', '2016-01-15', 0, 0, '2016-01-15', 'et tristique pellentesque, tellus sem mollis dui, in sodales elit', 'no partner', 0, 0, 1, 0, 0, 0, 1, 3, 1, 3, 1, 1, '2017-01-16 05:23:47', '2017-01-16 05:23:47', NULL),
(10, 'ZIVQY06416', 'Lysandra', 'Sutton', 'Margaret', 254, 254, '6585 Metus Road', 'female', '2016-01-16', 0, 0, '2016-01-15', 'Cras sed leo. Cras vehicula aliquet libero. Integer in magna.', 'no partner', 0, 1, 0, 0, 0, 1, 4, 4, 2, 6, 1, 3, '2017-01-16 05:35:51', '2017-01-16 05:35:51', NULL),
(12, 'PUTZG43599', 'Lamar', 'Salinas', 'Edward', 254, 254, 'Ap #764-1082 Donec Road', 'male', '2016-01-18', 0, 0, '2016-01-16', 'non, feugiat nec, diam. Duis mi enim, condimentum eget, volutpat', 'no partner', 0, 1, 0, 0, 0, 0, 2, 5, 1, 3, 1, 1, '2017-01-16 05:37:34', '2017-01-16 05:37:34', NULL),
(13, 'SRGNJ60817', 'Olga', 'Pacheco', 'Castor', 254, 254, '9692 Lobortis Rd.', 'female', '2016-01-16', 0, 0, '2016-01-15', 'lorem, sit amet ultricies sem magna nec quam. Curabitur vel', 'no partner', 1, 1, 1, 1, 0, 1, 1, 5, 2, 12, 1, 1, '2017-01-16 05:37:49', '2017-01-16 05:37:49', NULL),
(14, 'TKRAZ34589', 'Wang', 'Bauer', 'Hiroko', 254, 254, 'P.O. Box 690, 3479 Pede Ave', 'female', '2016-01-19', 0, 0, '2016-01-16', 'justo sit amet nulla. Donec non justo. Proin non massa', 'no partner', 1, 1, 1, 1, 0, 0, 4, 6, 1, 3, 1, 2, '2017-01-18 20:28:30', '2017-01-18 20:28:30', NULL),
(17, 'TKwewewe4589', 'Brian', 'Phiri', 'Hiroko', 254, 254, 'P.O. Box 690, 3479 Pede Ave', 'female', '2016-01-19', 0, 0, '2016-01-16', 'justo sit amet nulla. Donec non justo. Proin non massa', 'no partner', 1, 1, 1, 1, 0, 0, 4, 6, 1, 3, 1, 2, '2017-01-18 21:08:44', '2017-01-18 21:08:44', NULL),
(18, 'PT12AQ13966', 'Isabelle', 'Mason', 'Hyacinth', 254, 254, '969 Id St.', 'female', '2016-01-16', 0, 0, '2016-01-15', 'sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus', 'no partner', 1, 0, 1, 0, 0, 0, 5, 7, 1, 3, 1, 2, '2017-01-19 17:13:02', '2017-01-19 17:13:02', NULL),
(19, 'PTFFQ13966', 'Isabelle', 'Mason', 'Hyacinth', 254, 254, '969 Id St.', 'female', '2016-01-16', 0, 0, '2016-01-15', 'sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus', 'no partner', 1, 0, 1, 0, 0, 0, 5, 7, 1, 3, 1, 2, '2017-01-19 17:14:05', '2017-01-19 17:14:05', NULL),
(20, 'BTAAQ13966', 'Isabelle', 'Mason', 'Hyacinth', 254, 254, '969 Id St.', 'female', '2016-01-16', 0, 0, '2016-01-15', 'sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus', 'no partner', 1, 0, 1, 0, 0, 0, 5, 7, 1, 3, 1, 2, '2017-01-19 17:14:31', '2017-01-19 17:14:31', NULL),
(21, 'ZTAAQ139er', 'Isabelle', 'Mason', 'Hyacinth', 254, 254, '969 Id St.', 'female', '2016-01-16', 0, 0, '2016-01-15', 'sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus', 'no partner', 1, 0, 1, 0, 0, 0, 5, 7, 1, 3, 1, 2, '2017-01-19 17:14:46', '2017-01-19 17:14:46', NULL),
(22, 'HTAAQ13966', 'Isabelle', 'Mason', 'Hyacinth', 254, 254, '969 Id St.', 'female', '2016-01-16', 0, 0, '2016-01-15', 'sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus', 'no partner', 1, 0, 1, 0, 0, 0, 5, 7, 1, 3, 1, 2, '2017-01-19 17:15:33', '2017-01-19 17:15:33', NULL),
(23, 'YTAAQ13966', 'Isabelle', 'Mason', 'Hyacinth', 254, 254, '969 Id St.', 'female', '2016-01-16', 0, 0, '2016-01-15', 'sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus', 'no partner', 1, 0, 1, 0, 0, 0, 5, 7, 1, 3, 1, 2, '2017-01-19 18:04:53', '2017-01-19 18:04:53', NULL),
(24, 'WTAAQ13966', 'Isabelle', 'Mason', 'Hyacinth', 254, 254, '969 Id St.', 'female', '2016-01-16', 0, 0, '2016-01-15', 'sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus', 'no partner', 1, 0, 1, 0, 0, 0, 5, 7, 1, 3, 1, 2, '2017-01-19 18:05:10', '2017-01-19 18:05:10', NULL),
(25, 'KTAAQ13966', 'Isabelle', 'Mason', 'Hyacinth', 254, 254, '969 Id St.', 'female', '2016-01-16', 0, 0, '2016-01-15', 'sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus', 'no partner', 1, 0, 1, 0, 0, 0, 5, 7, 1, 3, 1, 2, '2017-01-19 18:05:17', '2017-01-19 18:05:17', NULL),
(26, 'EOEEQ13976', 'Isabelle', 'Mason', 'Hyacinth', 254, 254, '969 Id St.', 'female', '2016-01-16', 0, 0, '2016-01-15', 'sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus', 'no partner', 1, 0, 1, 0, 0, 0, 5, 7, 1, 3, 1, 2, '2017-01-19 18:06:13', '2017-01-19 18:06:13', NULL),
(27, 'XTAWM13966', 'Isabelle', 'Mason', 'Hyacinth', 254, 254, '969 Id St.', 'female', '2016-01-16', 0, 0, '2016-01-15', 'sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus', 'no partner', 1, 0, 1, 0, 0, 0, 5, 7, 1, 3, 1, 2, '2017-01-19 18:07:11', '2017-01-19 18:07:11', NULL),
(28, 'PTAAQ13966', 'Isabelle', 'Mason', 'Hyacinth', 254, 254, '969 Id St.', 'female', '2016-01-16', 0, 0, '2016-01-15', 'sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus', 'no partner', 1, 0, 1, 0, 0, 0, 5, 7, 1, 3, 1, 2, '2017-01-19 18:08:17', '2017-01-19 18:08:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_dependant`
--

CREATE TABLE IF NOT EXISTS `tbl_patient_dependant` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) NOT NULL,
  `dependant_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `dependant_id` (`dependant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_drug_allergy`
--

CREATE TABLE IF NOT EXISTS `tbl_patient_drug_allergy` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) NOT NULL,
  `drug_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `drug_id` (`drug_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_drug_allergy_other`
--

CREATE TABLE IF NOT EXISTS `tbl_patient_drug_allergy_other` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) NOT NULL,
  `allergy_name` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_drug_other`
--

CREATE TABLE IF NOT EXISTS `tbl_patient_drug_other` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) NOT NULL,
  `drug_name` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_family_planning`
--

CREATE TABLE IF NOT EXISTS `tbl_patient_family_planning` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) NOT NULL,
  `family_planning_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `family_planning_id` (`family_planning_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_illness`
--

CREATE TABLE IF NOT EXISTS `tbl_patient_illness` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) NOT NULL,
  `illness_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `illness_id` (`illness_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_illness_other`
--

CREATE TABLE IF NOT EXISTS `tbl_patient_illness_other` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) NOT NULL,
  `other_illness` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_partner`
--

CREATE TABLE IF NOT EXISTS `tbl_patient_partner` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) NOT NULL,
  `partner_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `partner_id` (`partner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_pepreason`
--

CREATE TABLE IF NOT EXISTS `tbl_patient_pepreason` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_prophylaxis`
--

CREATE TABLE IF NOT EXISTS `tbl_patient_prophylaxis` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) NOT NULL,
  `prophylaxis_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `prohylaxis_id` (`prophylaxis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_status`
--

CREATE TABLE IF NOT EXISTS `tbl_patient_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) NOT NULL,
  `status_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_tb`
--

CREATE TABLE IF NOT EXISTS `tbl_patient_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) NOT NULL,
  `category` enum('1','2') NOT NULL,
  `phase` enum('intensive','continuation','completed') NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `INDEX` (`patient_id`),
  KEY `phase` (`phase`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pepreason`
--

CREATE TABLE IF NOT EXISTS `tbl_pepreason` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_pepreason`
--

INSERT INTO `tbl_pepreason` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Occupational', NULL, NULL, NULL),
(2, 'Sexual assault', NULL, NULL, NULL),
(3, 'Other reasons', NULL, NULL, NULL),
(4, 'Brian is always the reason', '2017-01-26 20:12:25', '2017-01-26 20:13:22', '2017-01-26 20:13:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prophylaxis`
--

CREATE TABLE IF NOT EXISTS `tbl_prophylaxis` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_prophylaxis`
--

INSERT INTO `tbl_prophylaxis` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'cotrimoxazole', NULL, NULL, NULL),
(2, 'Dapsone', NULL, NULL, NULL),
(3, 'Isoniazid', NULL, NULL, NULL),
(4, 'Fluconazole', NULL, NULL, NULL),
(5, 'BP', '2017-01-26 20:25:49', '2017-01-26 20:26:29', '2017-01-26 20:26:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purpose`
--

CREATE TABLE IF NOT EXISTS `tbl_purpose` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_purpose`
--

INSERT INTO `tbl_purpose` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Enrolment', '2017-01-26 20:38:25', '2017-01-26 20:38:25', NULL),
(2, 'Routine Refill', '2017-01-26 20:38:38', '2017-01-26 20:38:38', NULL),
(3, 'PEP Start', '2017-01-26 20:39:01', '2017-01-26 20:39:01', NULL),
(4, 'To see Dr. Brian', '2017-01-26 20:39:16', '2017-01-26 20:40:27', '2017-01-26 20:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_regimen`
--

CREATE TABLE IF NOT EXISTS `tbl_regimen` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` text NOT NULL,
  `service_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`),
  KEY `service_id` (`service_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbl_regimen`
--

INSERT INTO `tbl_regimen` (`id`, `code`, `name`, `service_id`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'AF1A', 'AZT + 3TC + NVP', 1, 1, NULL, NULL, NULL),
(2, 'AF1B', 'AZT + 3TC + EFV', 4, 2, NULL, NULL, NULL),
(3, 'AF1C', 'AZT + 3TC + ABC', 1, 1, NULL, NULL, NULL),
(4, 'AF2A', 'TDF + 3TC + NVP', 3, 3, NULL, NULL, NULL),
(5, 'AF2B', 'TDF + 3TC + EFV', 1, 7, NULL, NULL, NULL),
(6, 'AF2C', 'TDF + 3TC + AZT', 3, 7, NULL, NULL, NULL),
(7, 'AF3A', 'd4T + 3TC + NVP', 1, 7, NULL, NULL, NULL),
(8, 'AF3B', 'd4T + 3TC + EFV', 4, 3, NULL, NULL, NULL),
(9, 'AF3C', 'd4T + 3TC + ABC', 1, 2, NULL, NULL, NULL),
(10, 'AS1A', 'AZT + 3TC + LPV/r', 2, 2, NULL, NULL, NULL),
(11, 'AS1B', 'AZT + 3TC + ATV/r', 5, 5, NULL, NULL, NULL),
(12, 'AS2A', 'TDF + 3TC + LPV/r', 3, 4, NULL, NULL, NULL),
(13, 'AS2B', 'TDF + ABC + LPV/r', 2, 5, NULL, NULL, NULL),
(14, 'AS2C', 'TDF +  3TC + ATV/r', 2, 4, NULL, NULL, NULL),
(15, 'AS3A', 'ABC + 3TC + LPV/r', 5, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service`
--

CREATE TABLE IF NOT EXISTS `tbl_service` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_service`
--

INSERT INTO `tbl_service` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ART', NULL, NULL, NULL),
(2, 'PEP', NULL, NULL, NULL),
(3, 'PMTCT', NULL, NULL, NULL),
(4, 'OI Only', NULL, NULL, NULL),
(5, 'PLO', NULL, NULL, NULL),
(6, 'B s', '2017-01-23 17:49:01', '2017-01-23 17:52:06', '2017-01-23 17:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_source`
--

CREATE TABLE IF NOT EXISTS `tbl_source` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_source`
--

INSERT INTO `tbl_source` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'VCT', NULL, NULL, NULL),
(2, 'PITC', NULL, NULL, NULL),
(3, 'Transfer In', NULL, NULL, NULL),
(4, 'STI', NULL, NULL, NULL),
(5, 'TRANSIT', NULL, NULL, NULL),
(6, 'HTC', NULL, NULL, NULL),
(7, 'PMTCT', NULL, NULL, NULL),
(8, 'TB', NULL, NULL, NULL),
(9, 'OUT PATIENT', NULL, NULL, NULL),
(10, 'Other: Specify', NULL, NULL, NULL),
(11, 'INPATIENT', NULL, NULL, NULL),
(12, 'briansHospital', NULL, NULL, NULL),
(13, 'B Src', '2017-01-26 19:34:38', '2017-01-26 19:35:27', '2017-01-26 19:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE IF NOT EXISTS `tbl_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'status_one', NULL, NULL, NULL),
(2, 'status_two', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE IF NOT EXISTS `tbl_stock` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transaction_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `transaction_detail` text NOT NULL,
  `ref_number` varchar(50) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `facility_id` bigint(20) NOT NULL,
  `transaction_type_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `store_id` (`store_id`),
  KEY `facility_id` (`facility_id`),
  KEY `transaction_date` (`transaction_time`),
  KEY `transaction_type_id` (`transaction_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`id`, `transaction_time`, `transaction_detail`, `ref_number`, `user_id`, `store_id`, `facility_id`, `transaction_type_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2017-01-30 00:00:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '123456', 1, 1, 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_item`
--

CREATE TABLE IF NOT EXISTS `tbl_stock_item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `batch_number` varchar(20) NOT NULL,
  `expiry_date` date NOT NULL,
  `quantity_in` int(11) NOT NULL,
  `quantity_out` int(11) NOT NULL,
  `quantity_packs` int(11) NOT NULL,
  `balance_before` int(11) NOT NULL,
  `balance_after` int(11) NOT NULL,
  `unit_cost` double DEFAULT NULL,
  `total_cost` double DEFAULT NULL,
  `comment` text NOT NULL,
  `drug_id` bigint(20) NOT NULL,
  `stock_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_id` (`stock_id`),
  KEY `unit_cost` (`unit_cost`),
  KEY `total_cost` (`total_cost`),
  KEY `drug_id` (`drug_id`),
  KEY `expiry_date` (`expiry_date`),
  KEY `quantity_in` (`quantity_in`),
  KEY `quantity_out` (`quantity_out`),
  KEY `balance_before` (`balance_before`),
  KEY `balance_after` (`balance_after`),
  KEY `batch_number` (`batch_number`),
  KEY `quantity_packs` (`quantity_packs`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_stock_item`
--

INSERT INTO `tbl_stock_item` (`id`, `batch_number`, `expiry_date`, `quantity_in`, `quantity_out`, `quantity_packs`, `balance_before`, `balance_after`, `unit_cost`, `total_cost`, `comment`, `drug_id`, `stock_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2323d', '2017-01-03', 23, 2, 12, 2, 21, 23, 100000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 1, 1, NULL, NULL, NULL),
(2, '123ddd3', '2017-02-28', 133, 122, 12, 10, 9, 122.22, 1111111.11, 'Brian test', 2, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store`
--

CREATE TABLE IF NOT EXISTS `tbl_store` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `type` enum('store','pharmacy') NOT NULL,
  `facility_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `facility_id` (`facility_id`),
  KEY `name` (`name`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supporter`
--

CREATE TABLE IF NOT EXISTS `tbl_supporter` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_supporter`
--

INSERT INTO `tbl_supporter` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'GOK', NULL, NULL, NULL),
(2, 'PEPFAR', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction_type`
--

CREATE TABLE IF NOT EXISTS `tbl_transaction_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `effect` enum('0,1') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `effect` (`effect`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_transaction_type`
--

INSERT INTO `tbl_transaction_type` (`id`, `name`, `effect`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Received from', '0,1', NULL, NULL, NULL),
(2, 'Balance Forward', '0,1', NULL, NULL, NULL),
(3, 'Returns from (+)', '0,1', NULL, NULL, NULL),
(4, 'Ajustment (+)', '0,1', NULL, NULL, NULL),
(5, 'Dispensed to Patients', '', NULL, NULL, NULL),
(6, 'Issued To', '', NULL, NULL, NULL),
(7, 'Ajustment (-)', '', NULL, NULL, NULL),
(8, 'Returns to (-)', '', NULL, NULL, NULL),
(9, 'Losses(-)', '', NULL, NULL, NULL),
(10, 'Expired(-)', '', NULL, NULL, NULL),
(11, 'Starting Stock/Physical Count', '0,1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

CREATE TABLE IF NOT EXISTS `tbl_unit` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_unit`
--

INSERT INTO `tbl_unit` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Amp', NULL, NULL, NULL),
(2, 'Bottle', NULL, NULL, NULL),
(3, 'Capsule', NULL, NULL, NULL),
(4, 'Jar', NULL, NULL, NULL),
(5, 'Pack', NULL, NULL, NULL),
(6, 'Ppack', NULL, NULL, NULL),
(7, 'Sachet', NULL, NULL, NULL),
(8, 'Tablet', NULL, NULL, NULL),
(9, 'Tube', NULL, NULL, NULL),
(10, 'Vial', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `password` varchar(128) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_by_id` bigint(20) NOT NULL,
  `last_login_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `access_level_id` bigint(20) NOT NULL,
  `facility_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`),
  KEY `name` (`name`),
  KEY `email` (`email`),
  KEY `phone` (`phone_number`),
  KEY `facility_id` (`facility_id`),
  KEY `created_by_id` (`created_by_id`),
  KEY `access_level_id` (`access_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `email`, `phone_number`, `password`, `remember_token`, `created_by_id`, `last_login_time`, `access_level_id`, `facility_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mary', 'mary@chai.com', '', '$2y$10$TfADl8E59a8m2kBDtqLZkuhB6jQxoT.shD3gRqLYJf2xDzSic69TW', NULL, 1, '2017-01-25 10:04:23', 1, 2, NULL, NULL, NULL),
(3, 'Phiri, Brian', 'brian@dev.test', '12345633', '$2y$10$3NicPiQ1bWq92bA.2flY5e./J01y7nQ7O1ZpNYFsWwZ8fiJDNn0uW', NULL, 0, '2017-02-01 16:00:04', 1, 2, '2017-02-01 15:44:40', '2017-02-01 16:00:04', '2017-02-01 16:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_visit`
--

CREATE TABLE IF NOT EXISTS `tbl_visit` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `current_height` float NOT NULL,
  `current_weight` float NOT NULL,
  `visit_date` date NOT NULL,
  `appointment_adherence` float NOT NULL DEFAULT '0',
  `patient_id` bigint(20) NOT NULL,
  `facility_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `purpose_id` bigint(20) NOT NULL,
  `last_regimen_id` bigint(20) DEFAULT NULL,
  `current_regimen_id` bigint(20) NOT NULL,
  `change_reason_id` bigint(20) DEFAULT NULL,
  `non_adherence_reason_id` bigint(20) DEFAULT NULL,
  `appointment_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `facility_id` (`facility_id`),
  KEY `user_id` (`user_id`),
  KEY `visit_purpose_id` (`purpose_id`),
  KEY `previous_regimen_id` (`last_regimen_id`),
  KEY `current_regimen_id` (`current_regimen_id`),
  KEY `regimen_change_reason_id` (`change_reason_id`),
  KEY `current_height` (`current_height`),
  KEY `current_weight` (`current_weight`),
  KEY `dispensing_date` (`visit_date`),
  KEY `appointment_adherence` (`appointment_adherence`),
  KEY `non_adherence_reason_id` (`non_adherence_reason_id`),
  KEY `appointment_id` (`appointment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_visit_item`
--

CREATE TABLE IF NOT EXISTS `tbl_visit_item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `duration` int(11) NOT NULL COMMENT 'In days ',
  `expected_pill_count` int(11) NOT NULL DEFAULT '0',
  `actual_pill_count` int(11) NOT NULL DEFAULT '0',
  `missed_pill_count` int(11) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `visit_id` bigint(20) NOT NULL,
  `stock_item_id` bigint(20) NOT NULL,
  `dose_id` bigint(20) NOT NULL,
  `indication_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indication_id` (`dose_id`),
  KEY `duration` (`duration`),
  KEY `missed_pills` (`missed_pill_count`),
  KEY `actual_pill_count` (`actual_pill_count`),
  KEY `visit_id` (`visit_id`),
  KEY `expected_pill_count` (`expected_pill_count`),
  KEY `indication_id_2` (`indication_id`),
  KEY `stock_id` (`stock_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_who_stage`
--

CREATE TABLE IF NOT EXISTS `tbl_who_stage` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_who_stage`
--

INSERT INTO `tbl_who_stage` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'stage 1', NULL, NULL, NULL),
(2, 'stage 2', NULL, NULL, NULL),
(3, 'stage 3', NULL, NULL, NULL),
(4, 'stage 4', NULL, NULL, NULL),
(5, 'stage 5', '2017-01-26 20:51:48', '2017-01-26 20:52:50', '2017-01-26 20:52:50');

-- --------------------------------------------------------

--
-- Structure for view `patients_enrolled_in_care`
--
DROP TABLE IF EXISTS `patients_enrolled_in_care`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `patients_enrolled_in_care` AS select `tso`.`name` AS `source`,`ts`.`name` AS `service`,`tp`.`gender` AS `gender`,`tp`.`birth_date` AS `birth_date`,`tv`.`visit_date` AS `enrollment_date`,`tf`.`name` AS `facility`,`tcs`.`name` AS `subcounty`,`tc`.`name` AS `county` from ((((((`tbl_patient` `tp` join `tbl_service` `ts` on((`tp`.`service_id` = `ts`.`id`))) join `tbl_visit` `tv` on((`tv`.`patient_id` = `tp`.`id`))) join `tbl_source` `tso` on((`tp`.`source_id` = `tso`.`id`))) join `tbl_facility` `tf` on((`tf`.`id` = `tp`.`facility_id`))) join `tbl_county_sub` `tcs` on((`tcs`.`id` = `tf`.`county_sub_id`))) join `tbl_county` `tc` on((`tc`.`id` = `tcs`.`county_id`)));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  ADD CONSTRAINT `tbl_appointment_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patient` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_appointment_ibfk_3` FOREIGN KEY (`facility_id`) REFERENCES `tbl_facility` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_cdrr`
--
ALTER TABLE `tbl_cdrr`
  ADD CONSTRAINT `tbl_cdrr_ibfk_4` FOREIGN KEY (`supporter_id`) REFERENCES `tbl_supporter` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_cdrr_ibfk_5` FOREIGN KEY (`facility_id`) REFERENCES `tbl_facility` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_cdrr_item`
--
ALTER TABLE `tbl_cdrr_item`
  ADD CONSTRAINT `tbl_cdrr_item_ibfk_2` FOREIGN KEY (`drug_id`) REFERENCES `tbl_drug` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_cdrr_item_ibfk_3` FOREIGN KEY (`cdrr_id`) REFERENCES `tbl_cdrr` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_cdrr_log`
--
ALTER TABLE `tbl_cdrr_log`
  ADD CONSTRAINT `tbl_cdrr_log_ibfk_2` FOREIGN KEY (`cdrr_id`) REFERENCES `tbl_cdrr` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_cdrr_log_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_county_sub`
--
ALTER TABLE `tbl_county_sub`
  ADD CONSTRAINT `tbl_county_sub_ibfk_1` FOREIGN KEY (`county_id`) REFERENCES `tbl_county` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_drug`
--
ALTER TABLE `tbl_drug`
  ADD CONSTRAINT `tbl_drug_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `tbl_unit` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_drug_ibfk_3` FOREIGN KEY (`dose_id`) REFERENCES `tbl_dose` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_drug_ibfk_5` FOREIGN KEY (`generic_id`) REFERENCES `tbl_generic` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_drug_ibfk_6` FOREIGN KEY (`supporter_id`) REFERENCES `tbl_supporter` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_drug_instruction`
--
ALTER TABLE `tbl_drug_instruction`
  ADD CONSTRAINT `tbl_drug_instruction_ibfk_1` FOREIGN KEY (`drug_id`) REFERENCES `tbl_drug` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_drug_instruction_ibfk_2` FOREIGN KEY (`instruction_id`) REFERENCES `tbl_instruction` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_facility`
--
ALTER TABLE `tbl_facility`
  ADD CONSTRAINT `tbl_facility_ibfk_5` FOREIGN KEY (`supporter_id`) REFERENCES `tbl_supporter` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_facility_ibfk_6` FOREIGN KEY (`county_sub_id`) REFERENCES `tbl_county_sub` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_facility_ibfk_8` FOREIGN KEY (`facility_type_id`) REFERENCES `tbl_facility_type` (`id`);

--
-- Constraints for table `tbl_maps`
--
ALTER TABLE `tbl_maps`
  ADD CONSTRAINT `tbl_maps_ibfk_1` FOREIGN KEY (`facility_id`) REFERENCES `tbl_facility` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_maps_ibfk_2` FOREIGN KEY (`supporter_id`) REFERENCES `tbl_supporter` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_maps_item`
--
ALTER TABLE `tbl_maps_item`
  ADD CONSTRAINT `tbl_maps_item_ibfk_1` FOREIGN KEY (`regimen_id`) REFERENCES `tbl_regimen` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_maps_item_ibfk_3` FOREIGN KEY (`maps_id`) REFERENCES `tbl_maps` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_maps_log`
--
ALTER TABLE `tbl_maps_log`
  ADD CONSTRAINT `tbl_maps_log_ibfk_1` FOREIGN KEY (`maps_id`) REFERENCES `tbl_maps` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_maps_log_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  ADD CONSTRAINT `tbl_patient_ibfk_10` FOREIGN KEY (`source_id`) REFERENCES `tbl_source` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_patient_ibfk_11` FOREIGN KEY (`county_sub_id`) REFERENCES `tbl_county_sub` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_patient_ibfk_12` FOREIGN KEY (`who_stage_id`) REFERENCES `tbl_who_stage` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_patient_ibfk_7` FOREIGN KEY (`service_id`) REFERENCES `tbl_service` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_patient_ibfk_8` FOREIGN KEY (`facility_id`) REFERENCES `tbl_facility` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_patient_ibfk_9` FOREIGN KEY (`supporter_id`) REFERENCES `tbl_supporter` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_patient_dependant`
--
ALTER TABLE `tbl_patient_dependant`
  ADD CONSTRAINT `tbl_patient_dependant_ibfk_3` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patient` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_patient_dependant_ibfk_4` FOREIGN KEY (`dependant_id`) REFERENCES `tbl_patient` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_patient_drug_allergy`
--
ALTER TABLE `tbl_patient_drug_allergy`
  ADD CONSTRAINT `tbl_patient_drug_allergy_ibfk_3` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patient` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_patient_drug_allergy_ibfk_4` FOREIGN KEY (`drug_id`) REFERENCES `tbl_drug` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_patient_drug_allergy_other`
--
ALTER TABLE `tbl_patient_drug_allergy_other`
  ADD CONSTRAINT `tbl_patient_drug_allergy_other_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patient` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_patient_drug_other`
--
ALTER TABLE `tbl_patient_drug_other`
  ADD CONSTRAINT `tbl_patient_drug_other_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patient` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_patient_illness_other`
--
ALTER TABLE `tbl_patient_illness_other`
  ADD CONSTRAINT `fk_patient_id` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patient` (`id`);

--
-- Constraints for table `tbl_patient_status`
--
ALTER TABLE `tbl_patient_status`
  ADD CONSTRAINT `tbl_patient_status_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `tbl_status` (`id`),
  ADD CONSTRAINT `tbl_patient_status_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patient` (`id`);

--
-- Constraints for table `tbl_visit`
--
ALTER TABLE `tbl_visit`
  ADD CONSTRAINT `appointment_fk` FOREIGN KEY (`appointment_id`) REFERENCES `tbl_appointment` (`id`),
  ADD CONSTRAINT `current_regimen_fk` FOREIGN KEY (`current_regimen_id`) REFERENCES `tbl_regimen` (`id`),
  ADD CONSTRAINT `facility_fk` FOREIGN KEY (`facility_id`) REFERENCES `tbl_facility` (`id`),
  ADD CONSTRAINT `last_regimen_fk` FOREIGN KEY (`last_regimen_id`) REFERENCES `tbl_regimen` (`id`),
  ADD CONSTRAINT `nonadherence_fk` FOREIGN KEY (`non_adherence_reason_id`) REFERENCES `tbl_non_adherence_reason` (`id`),
  ADD CONSTRAINT `patient_fk` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patient` (`id`),
  ADD CONSTRAINT `purpose_fk` FOREIGN KEY (`purpose_id`) REFERENCES `tbl_purpose` (`id`),
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
 