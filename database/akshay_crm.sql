-- Adminer 4.5.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `address` text NOT NULL,
  `contact_no_1` varchar(50) NOT NULL,
  `contact_no_2` varchar(50) NOT NULL,
  `optional_contact` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT 'active | inactive | pending | blocked ',
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('CONFLICT') NOT NULL,
  `title` varchar(200) NOT NULL,
  `log_msg` longtext NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `username`, `password`, `created_on`, `status`) VALUES
(1,	'admin',	'user',	'admin',	'202cb962ac59075b964b07152d234b70',	'2018-08-27 22:07:43',	1);

DROP TABLE IF EXISTS `calls`;
CREATE TABLE `calls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `callback_time` datetime NOT NULL,
  `users_ids` tinytext NOT NULL,
  `status_type` enum('PLANED','TENTATIVE','APPROVED','REJECT') NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `alert_before_minute` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`),
  KEY `contact_id` (`contact_id`),
  CONSTRAINT `calls_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `calls_ibfk_2` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(500) NOT NULL,
  `CategoryImage` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `categories` (`id`, `categoryname`, `CategoryImage`) VALUES
(1,	'Tiendas',	''),
(2,	'Ubicación',	'http://projects.quinoid.com/Chandini/Trendsbook/CategoryImages/Ubicacion.png'),
(3,	'Estilo',	'http://projects.quinoid.com/Chandini/Trendsbook/CategoryImages/03.jpg'),
(4,	'Servicios',	'http://projects.quinoid.com/Chandini/Trendsbook/CategoryImages/04.jpg'),
(5,	'Descuentos',	'http://projects.quinoid.com/Chandini/Trendsbook/CategoryImages/05.jpg'),
(6,	'Tendencias',	'http://projects.quinoid.com/Chandini/Trendsbook/CategoryImages/06.jpg'),
(57,	'trends',	'http://fxbytes.com/Client/trendbooks/CategoryImages/trend2.jpg');

DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no1` varchar(50) NOT NULL,
  `contact_no2` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`),
  CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(200) NOT NULL,
  `code` int(11) NOT NULL,
  `description` text NOT NULL,
  `group_id` int(11) NOT NULL,
  `price_id` int(11) NOT NULL,
  `type` enum('SERIAL','BATCH','NONE') NOT NULL,
  `unit` int(11) NOT NULL,
  `is_gst` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `login_history`;
CREATE TABLE `login_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `login_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `meeting`;
CREATE TABLE `meeting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(2500) NOT NULL,
  `description` text NOT NULL COMMENT 'related to text',
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `user_ids` text NOT NULL COMMENT 'Invitees',
  `status_type` enum('PLANED','TENTATIVE','APPROVED','REJECT') NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `alert_before_minute` time NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `related_to` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `color` enum('red','blue','green','yellow','grey','black','pink','purple') NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `sales_stages`;
CREATE TABLE `sales_stages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `probability` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `subscription`;
CREATE TABLE `subscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `type` enum('ONETIME','MONTHLY','QUARTERLY','HALFYEARLY','YEARLY') NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `payment_mode` enum('CASH','WALLET','ONLINE','CHEQUE') NOT NULL,
  `payment_description` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `targets`;
CREATE TABLE `targets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `target_duration_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `users_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0' COMMENT 'product based target (optional)',
  `target` int(11) NOT NULL COMMENT 'amount or win opportunity ',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `target_duration_id` (`target_duration_id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `targets_ibfk_1` FOREIGN KEY (`target_duration_id`) REFERENCES `target_duration` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `targets_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `target_duration`;
CREATE TABLE `target_duration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `in_days` int(11) NOT NULL,
  `priority` tinyint(4) NOT NULL COMMENT 'sequence number will be used  for ordering',
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `target_duration` (`id`, `code`, `name`, `in_days`, `priority`, `status`, `is_deleted`, `created_date`, `updated_date`) VALUES
(1,	'',	'weekly',	7,	0,	1,	0,	'2018-08-22 00:47:03',	'2018-08-22 00:47:03'),
(2,	'',	'15 days',	15,	1,	1,	0,	'2018-08-22 00:47:03',	'2018-08-22 00:47:03'),
(3,	'',	'monthly',	30,	2,	1,	0,	'2018-08-22 00:47:03',	'2018-08-22 00:47:03'),
(4,	'',	'quaterly',	90,	3,	1,	0,	'2018-08-22 00:47:03',	'2018-08-22 00:47:03'),
(5,	'',	'Half yearly',	180,	4,	1,	0,	'2018-08-22 00:47:03',	'2018-08-22 00:47:03'),
(6,	'',	'Yearly',	360,	5,	1,	0,	'2018-08-22 00:47:03',	'2018-08-22 00:47:03');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `mobile_no` varchar(100) NOT NULL,
  `landline` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `doj` date NOT NULL COMMENT 'date of joining',
  `status` tinyint(4) NOT NULL COMMENT '1 - active |  0 - inactive',
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_role_id` (`user_role_id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `user_role_id`, `company_id`, `email`, `username`, `password`, `first_name`, `last_name`, `mobile_no`, `landline`, `address`, `designation`, `dob`, `doj`, `status`, `is_deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(3,	1,	0,	'admin@example.com',	'admin',	'202cb962ac59075b964b07152d234b70',	'admin',	'user',	'1234567890',	'1234567890',	'Indore',	'System Super Admin ',	'0000-00-00',	'0000-00-00',	1,	0,	'2018-08-27 21:56:29',	1,	'2018-08-27 21:56:29',	1);

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `permission` longtext NOT NULL,
  `comments` text NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1 - active | 0 - inactive',
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user_roles` (`id`, `code`, `name`, `permission`, `comments`, `status`, `is_deleted`, `created_date`, `updated_date`) VALUES
(1,	'r1',	'admin',	'full',	'full',	1,	0,	'2018-08-27 21:47:05',	'2018-08-27 21:47:05');

-- 2018-08-28 17:14:29
