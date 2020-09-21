-- db 4.5.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `address` text NOT NULL,
  `email_1` varchar(50) NOT NULL,
  `email_2` varchar(50) NOT NULL,
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

INSERT INTO `account` (`id`, `company_id`, `account_number`, `name`, `description`, `address`, `email_1`, `email_2`, `contact_no_1`, `contact_no_2`, `optional_contact`, `status`, `is_deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1,	1,	'ACNT000001',	'Test Account',	'test account description',	'indore',	'test@gmail.com',	'test@gmail.com',	'9876543210',	'9876543210',	'',	1,	0,	'2018-12-06 23:06:41',	1,	'0000-00-00 00:00:00',	0),
(2,	2,	'ACNT000002',	'Barmag',	'Yarn Manufacturing Machine ',	'New Mumbai',	'swapnil.v@akshay.com',	'',	'9619360835',	'',	'',	1,	0,	'2018-12-10 15:23:30',	8,	'0000-00-00 00:00:00',	0),
(3,	2,	'ACNT000003',	'Steelcraft',	'Steelcraft Hospital',	'assa',	'sq@gamail',	'',	'9876543210',	'',	'',	1,	0,	'2018-12-10 15:45:29',	8,	'2018-12-20 17:39:05',	0);

DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `activity_for_user_id` int(11) NOT NULL,
  `activity_by_user_id` int(11) NOT NULL,
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
  `email` varchar(50) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `email`, `contact`, `username`, `password`, `created_on`, `status`) VALUES
(1,	'admin',	'user',	'',	'',	'admin',	'827ccb0eea8a706c4c34a16891f84e7b',	'2018-08-27 22:07:43',	1);

DROP TABLE IF EXISTS `calls`;
CREATE TABLE `calls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `lead_type` enum('CONTACT','LEAD','OPPORTUNITY') NOT NULL,
  `account_id` int(11) NOT NULL,
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
  `alert_before_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `calls` (`id`, `company_id`, `lead_id`, `lead_type`, `account_id`, `reason`, `callback_time`, `users_ids`, `status_type`, `status`, `is_deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`, `alert_before_datetime`) VALUES
(1,	2,	5,	'OPPORTUNITY',	2,	'Test',	'2018-12-12 18:10:00',	'2',	'PLANED',	1,	0,	'2018-12-10 17:14:32',	7,	'2018-12-10 17:14:32',	0,	'2018-12-12 18:11:00'),
(2,	2,	4,	'OPPORTUNITY',	2,	'Test',	'2018-12-11 17:10:00',	'1',	'PLANED',	1,	0,	'2018-12-10 17:14:55',	8,	'2018-12-10 17:14:55',	0,	'2018-12-11 17:11:00'),
(3,	2,	5,	'OPPORTUNITY',	2,	'Test',	'2018-12-12 17:30:00',	'2',	'PLANED',	1,	0,	'2018-12-10 17:15:41',	7,	'2018-12-10 17:15:41',	0,	'2018-12-12 17:31:00');

DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `company_prefix` varchar(50) NOT NULL,
  `company_code_start` varchar(10) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `subscription` int(11) NOT NULL,
  `email_1` varchar(100) NOT NULL,
  `email_2` varchar(100) NOT NULL,
  `contact_1` varchar(50) NOT NULL,
  `contact_2` varchar(50) NOT NULL,
  `pan_no` varchar(50) NOT NULL,
  `gstin_no` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `about_company` text NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `subscription` (`subscription`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `companies` (`id`, `company_name`, `company_prefix`, `company_code_start`, `logo`, `subscription`, `email_1`, `email_2`, `contact_1`, `contact_2`, `pan_no`, `gstin_no`, `address`, `about_company`, `created_date`, `updated_date`, `status`, `is_deleted`) VALUES
(1,	'Pro web it solution',	'PWI',	'0001',	'uploads/images/company/Bd5bX5MLZ5-1544115367.png',	1,	'prowebit@gmail.com',	'j.meenesh@gmail.com',	'9993755651',	'9993755651',	'2018-12-06',	'2018-12-06',	'indore',	'we are it service provider',	'2018-12-06 22:28:15',	'2018-12-06 22:28:15',	1,	0),
(2,	'RTUL',	'RTL',	'0001',	'uploads/images/company/kVuokzQMzR-1544767647.png',	1,	'lokesh@akshay.com',	'swapnil.v@akshay.com',	'888889888',	'8989898989',	'2018-12-10',	'2018-12-10',	'Navi Mumbai',	'Software company',	'2018-12-10 14:32:02',	'2018-12-14 11:37:31',	1,	0);

DROP TABLE IF EXISTS `company_email_templates`;
CREATE TABLE `company_email_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `template_key` varchar(200) NOT NULL,
  `subject` text NOT NULL,
  `body` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `company_email_templates` (`id`, `company_id`, `template_key`, `subject`, `body`, `status`, `is_deleted`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1,	1,	'company_employee_registration',	'Company Registration & Access',	'Thank you for registering with us \r\nHere is your details to login into {{app_name_short}} \r\n\r\nURL - {{base_url}}\r\n\r\nName - {{user_full_name}}\r\nUser Name - {{user_name}}\r\nPassword - {{password}}\r\n\r\nRegards, \r\n{{app_name_full}}\r\n',	1,	0,	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(2,	1,	'password_changed_success',	'{{company_name}} Employee Password changed',	'Thank you for registering with us \r\nHere is your new password\r\n\r\nURL - {{base_url}}\r\n\r\nName - {{user_full_name}}\r\nNew Password - {{password}}\r\n\r\nNote : Please delete this mail, after keeping your password in a safe place. \r\n\r\nRegards, \r\n{{company_name}}\r\n',	1,	0,	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(3,	1,	'sales_order_generated',	'{{company_name}} Sales Order Generated',	'Hello Admin,\r\n\r\nYour employee {{employee_name}} has generated a sales order, \r\n\r\nReview your employees sales order at - \r\n\r\nURL - {{base_url}}\r\n\r\nThanks & Regards, \r\n{{company_name}}\r\n',	1,	0,	0,	'2018-10-19 16:00:53',	0,	'2018-10-19 16:00:53'),
(4,	2,	'company_employee_registration',	'Company Registration & Access',	'Thank you for registering with us \r\nHere is your details to login into {{app_name_short}} \r\n\r\nURL - {{base_url}}\r\n\r\nName - {{user_full_name}}\r\nUser Name - {{user_name}}\r\nPassword - {{password}}\r\n\r\nRegards, \r\n{{app_name_full}}\r\n',	1,	0,	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(5,	2,	'password_changed_success',	'{{company_name}} Employee Password changed',	'Thank you for registering with us \r\nHere is your new password\r\n\r\nURL - {{base_url}}\r\n\r\nName - {{user_full_name}}\r\nNew Password - {{password}}\r\n\r\nNote : Please delete this mail, after keeping your password in a safe place. \r\n\r\nRegards, \r\n{{company_name}}\r\n',	1,	0,	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(6,	2,	'sales_order_generated',	'{{company_name}} Sales Order Generated',	'Hello Admin,\r\n\r\nYour employee {{employee_name}} has generated a sales order, \r\n\r\nReview your employees sales order at - \r\n\r\nURL - {{base_url}}\r\n\r\nThanks & Regards, \r\n{{company_name}}\r\n',	1,	0,	0,	'2018-10-19 16:00:53',	0,	'2018-10-19 16:00:53');

DROP TABLE IF EXISTS `contact_lead`;
CREATE TABLE `contact_lead` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL COMMENT 'Employee id who handle this lead/contact/opp',
  `is_type` tinyint(4) NOT NULL COMMENT '0-Contact | 1-Lead | 2-Opportunity',
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `other_contact` varchar(15) NOT NULL,
  `email_1` varchar(50) NOT NULL,
  `email_2` varchar(50) NOT NULL,
  `other_email` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `website_url` varchar(50) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `primary_address` text NOT NULL,
  `primary_city` varchar(50) NOT NULL,
  `primary_state` varchar(50) NOT NULL,
  `primary_pincode` varchar(10) NOT NULL,
  `primary_country` varchar(50) NOT NULL,
  `secondary_address` text NOT NULL,
  `secondary_city` varchar(50) NOT NULL,
  `secondary_state` varchar(50) NOT NULL,
  `secondary_pincode` varchar(10) NOT NULL,
  `secondary_country` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `assign_date` datetime NOT NULL COMMENT 'When assign to user',
  `opp_currency` tinyint(4) NOT NULL,
  `opp_close_date` datetime NOT NULL,
  `opp_amount` double NOT NULL,
  `opp_type` tinyint(4) NOT NULL,
  `opp_sales_stage` tinyint(4) NOT NULL,
  `opp_probability` double NOT NULL,
  `opp_lead_source` int(11) NOT NULL,
  `opp_next_step` varchar(200) NOT NULL,
  `opp_description` tinytext NOT NULL,
  `convert_oppr_date` datetime NOT NULL COMMENT 'convert from lead to opportunity date',
  `convert_lead_date` datetime NOT NULL COMMENT 'convert from contact to lead date',
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `contact_lead` (`id`, `company_id`, `account_id`, `owner_id`, `is_type`, `first_name`, `last_name`, `mobile`, `other_contact`, `email_1`, `email_2`, `other_email`, `fax`, `title`, `department`, `website_url`, `account_name`, `primary_address`, `primary_city`, `primary_state`, `primary_pincode`, `primary_country`, `secondary_address`, `secondary_city`, `secondary_state`, `secondary_pincode`, `secondary_country`, `description`, `assign_date`, `opp_currency`, `opp_close_date`, `opp_amount`, `opp_type`, `opp_sales_stage`, `opp_probability`, `opp_lead_source`, `opp_next_step`, `opp_description`, `convert_oppr_date`, `convert_lead_date`, `created_date`, `created_by`, `status`, `updated_date`, `updated_by`, `is_deleted`) VALUES
(1,	1,	1,	2,	2,	'Contact',	'first',	'9876543210',	'9876543210',	'testcont1@gmail.com',	'',	'testcont2@gmail.com',	'ABC123',	'test',	'IT',	'http://prowebitsolution.com/',	'',	'indore',	'indore',	'MP',	'452001',	'India',	'indore',	'indore',	'MP',	'452001',	'India',	'test contact',	'2018-12-06 23:13:24',	0,	'2018-12-07 00:00:00',	1000,	1,	3,	20,	3,	'test',	'this is test ',	'2018-12-06 23:14:25',	'2018-12-06 23:13:24',	'2018-12-06 23:09:58',	1,	1,	'2018-12-06 23:14:25',	1,	0),
(2,	1,	1,	1,	0,	'test contact2',	'',	'9876543211',	'',	'testcontact2@gmail.com',	'',	'',	'',	'',	'',	'',	'',	'a',	'b',	'c',	'd',	'e',	'a',	'b',	'c',	'd',	'e',	'fdf',	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00',	0,	0,	0,	0,	0,	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'2018-12-06 23:25:36',	1,	1,	'0000-00-00 00:00:00',	0,	0),
(3,	2,	2,	8,	0,	'Munna',	'968898981818',	'918191819181',	'',	'swapnil.v@akshay.com',	'',	'',	'',	'',	'',	'',	'',	'Mumabi',	'Navi Mumbai',	'Maharashtra',	'410206',	'India',	'',	'',	'',	'',	'',	'GM',	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00',	0,	0,	0,	0,	0,	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'2018-12-10 15:39:07',	8,	1,	'0000-00-00 00:00:00',	0,	0),
(4,	2,	2,	8,	2,	'Raj',	'Stivan',	'8978675645',	'',	'swapnil.v@akshay,com',	'',	'',	'',	'',	'',	'',	'',	'Navi Mumbai',	'Navi Mumbai',	'Maharashtra',	'410207',	'India',	'',	'',	'',	'',	'',	'1st Order',	'0000-00-00 00:00:00',	0,	'2018-12-17 00:00:00',	120000,	2,	1,	5,	6,	'Sales Quotation',	'Need Sample with Sales Quotation',	'2018-12-10 15:54:26',	'0000-00-00 00:00:00',	'2018-12-10 15:52:28',	8,	1,	'2018-12-10 15:54:26',	8,	0),
(5,	2,	2,	7,	2,	'Ram',	'',	'123456789',	'',	'asset@gmail.com',	'',	'',	'',	'',	'',	'',	'',	'Navi Mumbai',	'Navi Mumbai',	'Maharastra',	'410206',	'India',	'',	'',	'',	'',	'',	'Test',	'0000-00-00 00:00:00',	0,	'2018-12-31 00:00:00',	12000,	2,	1,	5,	2,	'Quotation',	'Test',	'2018-12-10 17:13:37',	'0000-00-00 00:00:00',	'2018-12-10 17:12:01',	7,	1,	'2018-12-10 17:13:37',	7,	0),
(6,	2,	2,	3,	2,	'Swapnil',	'Vichare',	'45454588',	'544521',	'swapnil.v@akshay.com',	'',	'',	'',	'head',	'SAP',	'',	'',	'Navi  Mumbai',	'Navi Mumbai',	'MH',	'452016',	'India',	'Navi  Mumbai',	'Navi Mumbai',	'MH',	'452016',	'India',	'Lead for 12,000,000',	'0000-00-00 00:00:00',	0,	'2018-12-18 00:00:00',	15000000,	1,	3,	20,	1,	'Call',	'Do call',	'2018-12-14 12:22:39',	'0000-00-00 00:00:00',	'2018-12-14 12:21:43',	3,	1,	'2018-12-14 12:22:39',	3,	0);

DROP TABLE IF EXISTS `email_template`;
CREATE TABLE `email_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_key` varchar(200) NOT NULL,
  `subject` text NOT NULL,
  `body` longtext NOT NULL,
  `is_global` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `email_template` (`id`, `template_key`, `subject`, `body`, `is_global`, `status`, `is_deleted`, `created_date`, `updated_date`) VALUES
(1,	'new_company_registration',	'New Company Registration ',	'Thank you for registering with us \r\nHere is your details to login into {{app_name_short}} \r\n\r\nURL - {{base_url}}\r\n\r\nName - {{user_full_name}}\r\nUser Name - {{user_name}}\r\nPassword - {{password}}\r\n\r\nRegards, \r\n{{app_name_full}}\r\n',	1,	1,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(2,	'company_employee_registration',	'Company Registration & Access',	'Thank you for registering with us \r\nHere is your details to login into {{app_name_short}} \r\n\r\nURL - {{base_url}}\r\n\r\nName - {{user_full_name}}\r\nUser Name - {{user_name}}\r\nPassword - {{password}}\r\n\r\nRegards, \r\n{{app_name_full}}\r\n',	0,	1,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(3,	'password_changed_success',	'{{company_name}} Employee Password changed',	'Thank you for registering with us \r\nHere is your new password\r\n\r\nURL - {{base_url}}\r\n\r\nName - {{user_full_name}}\r\nNew Password - {{password}}\r\n\r\nNote : Please delete this mail, after keeping your password in a safe place. \r\n\r\nRegards, \r\n{{company_name}}\r\n',	0,	1,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(4,	'sales_order_generated',	'{{company_name}} Sales Order Generated',	'Hello Admin,\r\n\r\nYour employee {{employee_name}} has generated a sales order, \r\n\r\nReview your employees sales order at - \r\n\r\nURL - {{base_url}}\r\n\r\nThanks & Regards, \r\n{{company_name}}\r\n',	0,	1,	0,	'2018-10-19 16:00:53',	'2018-10-19 16:00:53');

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `code` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `group_type` enum('SERVICE','INVENTORY') NOT NULL,
  `type` enum('SERIAL','BATCH','NONE') NOT NULL,
  `unit` varchar(50) NOT NULL,
  `is_gst` tinyint(4) NOT NULL,
  `gst_tax_rate` double NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `items` (`id`, `company_id`, `logo`, `code`, `name`, `description`, `group_type`, `type`, `unit`, `is_gst`, `gst_tax_rate`, `status`, `is_deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1,	2,	'uploads/images/items/FpLMLKB24I-1544438225.png',	0,	'Printer',	'Branded Printer',	'INVENTORY',	'NONE',	'kg',	1,	5,	1,	0,	'2018-12-10 16:06:33',	0,	'2018-12-10 17:28:56',	0),
(2,	2,	'uploads/images/items/dbE0wjM50t-1544438352.jpg',	0,	'Hitachi Cut Off Machine',	'Cutter',	'INVENTORY',	'SERIAL',	'kg',	1,	18,	1,	0,	'2018-12-10 16:09:23',	0,	'0000-00-00 00:00:00',	0);

DROP TABLE IF EXISTS `items_price_list`;
CREATE TABLE `items_price_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price1` double NOT NULL,
  `price2` double NOT NULL,
  `price3` double NOT NULL,
  `price4` double NOT NULL,
  `price5` double NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `items_price_list` (`id`, `company_id`, `item_id`, `price1`, `price2`, `price3`, `price4`, `price5`, `status`, `is_deleted`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1,	2,	1,	12000,	15000,	0,	0,	0,	1,	0,	0,	'2018-12-10 16:06:33',	0,	'2018-12-10 17:28:56'),
(2,	2,	2,	45000,	28000,	0,	0,	0,	1,	0,	0,	'2018-12-10 16:09:23',	0,	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `item_service_call`;
CREATE TABLE `item_service_call` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `item_service_contract_id` int(11) NOT NULL,
  `item_service_contract_serial_number` varchar(200) NOT NULL,
  `account_id` int(11) NOT NULL,
  `account_name` varchar(250) NOT NULL,
  `contact_person_id` int(11) NOT NULL,
  `contact_person_name` varchar(250) NOT NULL,
  `contact_person_number` varchar(100) NOT NULL,
  `sales_employee_id` int(11) NOT NULL,
  `sales_employee` varchar(250) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `remark` varchar(200) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_code` varchar(200) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `item_group` varchar(200) NOT NULL,
  `call_status` varchar(200) NOT NULL,
  `priority` enum('low','medium','high') NOT NULL,
  `planned_call_date` date NOT NULL,
  `tentative_call_date` date NOT NULL,
  `approved_call_date` date NOT NULL,
  `rejected_call_date` date NOT NULL,
  `subject` text NOT NULL,
  `description` text NOT NULL,
  `problem_origin` varchar(200) NOT NULL,
  `problem_type` varchar(200) NOT NULL,
  `problem_subtype` varchar(200) NOT NULL,
  `call_type` varchar(200) NOT NULL,
  `technical` varchar(100) NOT NULL,
  `technical_type` varchar(250) NOT NULL,
  `technician` varchar(250) NOT NULL,
  `given_by` varchar(250) NOT NULL,
  `given_to` varchar(250) NOT NULL,
  `job_description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `item_service_call` (`id`, `company_id`, `item_service_contract_id`, `item_service_contract_serial_number`, `account_id`, `account_name`, `contact_person_id`, `contact_person_name`, `contact_person_number`, `sales_employee_id`, `sales_employee`, `start_date`, `end_date`, `remark`, `item_id`, `item_code`, `item_name`, `item_group`, `call_status`, `priority`, `planned_call_date`, `tentative_call_date`, `approved_call_date`, `rejected_call_date`, `subject`, `description`, `problem_origin`, `problem_type`, `problem_subtype`, `call_type`, `technical`, `technical_type`, `technician`, `given_by`, `given_to`, `job_description`, `status`, `is_deleted`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1,	2,	1,	'SR00001',	2,	'Barmag',	4,	'Raj Stivan',	'8978675645',	8,	'Freya valkyrie',	'2018-12-01',	'2019-11-30',	'Brand',	1,	'',	'Printer',	'',	'approved',	'medium',	'0000-00-00',	'0000-00-00',	'0000-00-00',	'0000-00-00',	'Printer Setup',	'',	'hardware',	'1',	'1',	'1',	'',	'',	'',	'',	'',	'',	1,	0,	8,	'2018-12-10 16:51:09',	8,	'2018-12-10 17:04:17');

DROP TABLE IF EXISTS `item_service_contract`;
CREATE TABLE `item_service_contract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `account_name` varchar(200) NOT NULL,
  `contact_person_id` int(11) NOT NULL,
  `contact_person_name` varchar(200) NOT NULL,
  `contact_person_number` varchar(200) NOT NULL,
  `sales_employee_id` int(11) NOT NULL,
  `sales_employee` varchar(200) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `response_duration_type` enum('days','hours') NOT NULL,
  `response_time` varchar(50) NOT NULL,
  `resolution_duration_type` enum('days','hours') NOT NULL,
  `resolution_time` varchar(50) NOT NULL,
  `stage` varchar(50) NOT NULL COMMENT 'similar as quotation ',
  `serial_number` varchar(250) NOT NULL COMMENT 'auto generate and unique',
  `item_id` int(11) NOT NULL,
  `item_code` varchar(250) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `remark` text NOT NULL,
  `free_services` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `item_service_contract` (`id`, `company_id`, `account_id`, `account_name`, `contact_person_id`, `contact_person_name`, `contact_person_number`, `sales_employee_id`, `sales_employee`, `start_date`, `end_date`, `response_duration_type`, `response_time`, `resolution_duration_type`, `resolution_time`, `stage`, `serial_number`, `item_id`, `item_code`, `item_name`, `remark`, `free_services`, `status`, `is_deleted`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1,	2,	2,	'Barmag',	4,	'Raj Stivan',	'8978675645',	8,	'Freya valkyrie',	'2018-12-01',	'2019-11-30',	'days',	'1',	'days',	'2',	'draft',	'SR00001',	1,	'',	'Printer',	'Brand',	1,	1,	0,	8,	'2018-12-10 16:48:57',	0,	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `meeting`;
CREATE TABLE `meeting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
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
  `alert_before_datetime` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `meeting` (`id`, `company_id`, `subject`, `description`, `start_datetime`, `end_datetime`, `user_ids`, `status_type`, `created_date`, `created_by`, `updated_date`, `updated_by`, `alert_before_datetime`, `status`, `is_deleted`) VALUES
(1,	1,	'test meeting',	'test meeting related description',	'2018-12-07 14:00:00',	'2018-12-07 14:30:00',	'2,5',	'PLANED',	'2018-12-06 23:19:58',	1,	'2018-12-06 23:19:58',	0,	'2018-12-07 14:10:00',	1,	0);

DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `related_to` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `color` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `notes` (`id`, `company_id`, `user_id`, `related_to`, `subject`, `message`, `color`, `status`, `is_deleted`, `created_date`, `updated_date`) VALUES
(1,	1,	1,	0,	'Test Notes',	'test notes fdsjfsadlfj',	'm--bg-primary',	0,	0,	'2018-12-06 23:18:15',	'2018-12-09 20:52:25'),
(2,	0,	1,	0,	'Test',	'test',	'm--bg-black',	0,	0,	'2018-12-28 23:45:36',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `sales_order`;
CREATE TABLE `sales_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('ORDER','QUOTATION') NOT NULL,
  `company_id` int(11) NOT NULL,
  `sales_quote_ref_id` int(11) NOT NULL,
  `revision_id` varchar(150) NOT NULL,
  `account_id` int(11) NOT NULL,
  `account_name` varchar(200) NOT NULL,
  `contact_person_id` int(11) NOT NULL,
  `contact_person_name` varchar(200) NOT NULL,
  `contact_person_number` varchar(200) NOT NULL,
  `sales_employee_id` int(11) NOT NULL,
  `sales_employee` varchar(200) NOT NULL,
  `doc_no` varchar(100) NOT NULL,
  `doc_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `valid_till` date NOT NULL,
  `remarks` text NOT NULL,
  `pan_card_no` varchar(50) NOT NULL,
  `pay_terms` text NOT NULL,
  `delivery_address` text NOT NULL,
  `gst_no` varchar(50) NOT NULL,
  `total_amount` varchar(50) NOT NULL,
  `other_charges` varchar(50) NOT NULL,
  `total_tax` varchar(50) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `actual_total` varchar(50) NOT NULL,
  `stages` varchar(50) NOT NULL,
  `cancel_reason` varchar(50) NOT NULL,
  `revision_number` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sales_order` (`id`, `type`, `company_id`, `sales_quote_ref_id`, `revision_id`, `account_id`, `account_name`, `contact_person_id`, `contact_person_name`, `contact_person_number`, `sales_employee_id`, `sales_employee`, `doc_no`, `doc_date`, `delivery_date`, `valid_till`, `remarks`, `pan_card_no`, `pay_terms`, `delivery_address`, `gst_no`, `total_amount`, `other_charges`, `total_tax`, `discount`, `actual_total`, `stages`, `cancel_reason`, `revision_number`, `status`, `is_deleted`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1,	'QUOTATION',	2,	0,	'',	2,	'Barmag',	4,	'Raj Stivan',	'8978675645',	8,	'Freya valkyrie',	'DOC20020180001',	'2018-12-10',	'2018-12-17',	'2018-12-05',	'Need Sample with Quotation',	'PAN87876514141',	'50%vance',	'Nariman Point, Mumbai',	'GST787654154',	'72486.00',	'1200',	'8566',	'10',	'5747065.88',	'draft',	'',	'0',	1,	0,	8,	'2018-12-10 16:40:30',	8,	'2018-12-10 16:43:33'),
(2,	'ORDER',	2,	1,	'',	2,	'Barmag',	4,	'Raj Stivan',	'8978675645',	8,	'Freya valkyrie',	'DOC20020180001',	'2018-12-10',	'2018-12-17',	'2018-12-05',	'Need Sample with Quotation',	'PAN87876514141',	'50%vance',	'Nariman Point, Mumbai',	'GST787654154',	'120276.00',	'1200',	'8566',	'10',	'9474399.14',	'draft',	'',	'',	1,	0,	8,	'2018-12-10 16:42:04',	0,	'0000-00-00 00:00:00'),
(3,	'QUOTATION',	2,	0,	'',	2,	'Barmag',	5,	'Ram ',	'123456789',	7,	'Heimdall The Keeper',	'DOC20020180003',	'2018-12-10',	'2018-12-10',	'2018-12-10',	'',	'',	'Test % Test\' Test\" Test,',	'Mumbai',	'',	'12600.00',	'1200',	'3',	'5',	'13503.30',	'draft',	'',	'0',	1,	0,	7,	'2018-12-10 17:23:10',	7,	'2018-12-10 17:24:53'),
(4,	'ORDER',	2,	3,	'',	2,	'Barmag',	5,	'Ram ',	'123456789',	7,	'Heimd',	'DOC20020180003',	'2018-12-10',	'2018-12-10',	'2018-12-10',	'',	'',	'Test % Test\' Test\" Test,',	'Mumbai',	'',	'12600.00',	'1200',	'3',	'5',	'13503.30',	'draft',	'',	'0',	1,	0,	7,	'2018-12-10 17:25:55',	7,	'2018-12-10 17:26:43');

DROP TABLE IF EXISTS `sales_order_details`;
CREATE TABLE `sales_order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `sales_order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_code` varchar(100) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `discount` varchar(20) NOT NULL,
  `after_discount` varchar(20) NOT NULL,
  `tax_code` varchar(50) NOT NULL,
  `tax_amount` varchar(20) NOT NULL,
  `total` varchar(50) NOT NULL,
  `delivery_date` datetime NOT NULL,
  `remark` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sales_order_details` (`id`, `company_id`, `sales_order_id`, `item_id`, `item_code`, `item_name`, `quantity`, `price`, `discount`, `after_discount`, `tax_code`, `tax_amount`, `total`, `delivery_date`, `remark`, `status`, `is_deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1,	2,	1,	1,	'0',	'Printer',	2,	12000,	'2',	'',	'',	'5',	'24696.00',	'0000-00-00 00:00:00',	'1st Order',	1,	0,	'2018-12-10 16:40:30',	8,	'2018-12-10 16:43:33',	8),
(2,	2,	1,	2,	'0',	'Hitachi Cut Off Machine',	1,	45000,	'10',	'',	'',	'18',	'47790.00',	'0000-00-00 00:00:00',	'1st Order',	1,	0,	'2018-12-10 16:40:30',	8,	'2018-12-10 16:43:33',	8),
(3,	2,	2,	1,	'0',	'Printer',	2,	12000,	'2',	'',	'',	'5',	'24696.00',	'0000-00-00 00:00:00',	'1st Order',	1,	0,	'2018-12-10 16:42:04',	8,	'0000-00-00 00:00:00',	0),
(4,	2,	2,	2,	'0',	'Hitachi Cut Off Machine',	2,	45000,	'10',	'',	'',	'18',	'95580.00',	'0000-00-00 00:00:00',	'1st Order',	1,	0,	'2018-12-10 16:42:04',	8,	'0000-00-00 00:00:00',	0),
(5,	2,	3,	1,	'0',	'Printer',	1,	12000,	'',	'',	'',	'5',	'12600.00',	'0000-00-00 00:00:00',	'',	1,	0,	'2018-12-10 17:23:10',	7,	'2018-12-10 17:24:53',	7),
(6,	2,	4,	1,	'0',	'Printer',	1,	12000,	'',	'',	'',	'5',	'12600.00',	'0000-00-00 00:00:00',	'',	1,	0,	'2018-12-10 17:25:55',	7,	'2018-12-10 17:26:43',	7);

DROP TABLE IF EXISTS `sales_order_revisions`;
CREATE TABLE `sales_order_revisions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_order_id` int(11) NOT NULL,
  `revision_no` int(11) NOT NULL,
  `revision_amount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
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

INSERT INTO `sales_stages` (`id`, `name`, `description`, `probability`, `status`, `is_deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1,	'Only Inquiry',	'',	5,	1,	0,	'2018-08-24 22:38:19',	0,	'2018-08-24 22:38:19',	0),
(2,	'Prospecting',	'',	10,	1,	0,	'2018-08-24 22:38:19',	0,	'2018-08-24 22:38:19',	0),
(3,	'Qualification',	'',	20,	1,	0,	'2018-08-24 22:38:19',	0,	'2018-08-24 22:38:19',	0),
(4,	'Need Analysis',	'',	10,	1,	0,	'2018-08-24 22:38:19',	0,	'2018-08-24 22:38:19',	0),
(5,	'Value Proposition',	'',	5,	1,	0,	'2018-08-24 22:38:19',	0,	'2018-08-24 22:38:19',	0),
(6,	'Perception Analysis',	'',	10,	1,	0,	'2018-08-24 22:38:19',	0,	'2018-08-24 22:38:19',	0),
(7,	'On Hold',	'',	25,	1,	0,	'2018-08-24 22:38:19',	0,	'2018-08-24 22:38:19',	0),
(8,	'Closed Won',	'',	10,	1,	0,	'2018-08-24 22:38:19',	0,	'2018-08-24 22:38:19',	0),
(9,	'Closed Lost',	'',	13,	1,	0,	'2018-08-24 22:38:19',	0,	'2018-08-24 22:38:19',	0);

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


DROP TABLE IF EXISTS `subscription_plan`;
CREATE TABLE `subscription_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `min_value` tinyint(4) NOT NULL,
  `max_value` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `subscription_plan` (`id`, `name`, `min_value`, `max_value`, `status`, `is_deleted`, `created_date`, `updated_date`) VALUES
(1,	'1-10 users',	1,	10,	1,	0,	'2018-08-29 00:00:52',	'2018-08-29 00:00:52'),
(2,	'11-30 users',	11,	30,	1,	0,	'2018-08-29 00:01:08',	'2018-08-29 00:01:08'),
(3,	'30-50 users',	30,	50,	1,	0,	'2018-08-29 00:01:52',	'2018-08-29 00:01:52'),
(4,	'50+ users ',	50,	0,	1,	0,	'2018-08-29 00:02:08',	'2018-08-29 00:02:08');

DROP TABLE IF EXISTS `system_settings`;
CREATE TABLE `system_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `sys_value` longtext NOT NULL,
  `sys_group` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `system_settings` (`id`, `name`, `sys_value`, `sys_group`, `status`, `is_deleted`, `created_date`, `updated_date`) VALUES
(1,	'default_currency',	'INR',	'currency ',	1,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(2,	'system_email',	'info@akshaycrm.com',	'email',	1,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(3,	'default_theme',	'purple_red',	'look_feel',	1,	0,	'2018-11-09 12:17:49',	'0000-00-00 00:00:00'),
(4,	'available_theme',	'[{\"name\":\"purple_red\",\"title\":\"Purple Red\"},{\"name\":\"pitch_black\",\"title\":\"Pitch Black\"},{\"name\":\"just_white\",\"title\":\"Just White\"},{\"name\":\"soft_metal\",\"title\":\"Soft Metal\"},{\"name\":\"grape_fruit\",\"title\":\"Grape Fruit\"},{\"name\":\"blue_jeans\",\"title\":\"Blue Jeans\"},{\"name\":\"grass\",\"title\":\"Grass\"},{\"name\":\"pink_rose\",\"title\":\"Pink Rose\"}]',	'look_feel',	1,	0,	'2018-11-09 15:48:06',	'2018-11-09 15:48:06');

DROP TABLE IF EXISTS `targets`;
CREATE TABLE `targets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assign_to_user_id` int(11) NOT NULL,
  `report_to_user_id` int(11) NOT NULL,
  `target_title` varchar(200) NOT NULL,
  `company_id` int(11) NOT NULL,
  `target_duration_id` int(11) NOT NULL,
  `target_type` enum('amount','product') NOT NULL,
  `amount` int(11) NOT NULL COMMENT 'will delete ',
  `product` int(11) NOT NULL COMMENT 'will delete',
  `target` int(11) NOT NULL,
  `target_left` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `target_duration_id` (`target_duration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `targets` (`id`, `assign_to_user_id`, `report_to_user_id`, `target_title`, `company_id`, `target_duration_id`, `target_type`, `amount`, `product`, `target`, `target_left`, `description`, `status`, `is_deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1,	4,	3,	'Monthly target',	2,	3,	'amount',	0,	0,	150000,	0,	'',	1,	0,	'2018-12-14 16:19:06',	3,	'0000-00-00 00:00:00',	0),
(2,	5,	4,	'Monthly-Dec',	2,	3,	'amount',	0,	0,	50000,	20000,	'',	1,	0,	'2018-12-14 17:00:40',	4,	'0000-00-00 00:00:00',	0),
(3,	6,	4,	'Monthly-Dec',	2,	3,	'amount',	0,	0,	100000,	0,	'',	1,	0,	'2018-12-14 17:00:40',	4,	'0000-00-00 00:00:00',	0),
(4,	7,	5,	'Monthly-Dec',	2,	3,	'amount',	0,	0,	30000,	0,	'',	1,	0,	'2018-12-14 17:02:15',	5,	'0000-00-00 00:00:00',	0);

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

DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` tinytext NOT NULL,
  `complete` int(11) NOT NULL COMMENT '0 - Running | 1 - Done',
  `created_date` datetime NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `task` (`id`, `company_id`, `title`, `description`, `complete`, `created_date`, `created_by`, `updated_date`, `updated_by`, `status`, `is_deleted`) VALUES
(1,	1,	'test task',	'this is testing task',	0,	'2018-12-06 23:20:26',	1,	'2018-12-06 23:20:36',	0,	1,	0);

DROP TABLE IF EXISTS `uom`;
CREATE TABLE `uom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `length` double NOT NULL,
  `width` double NOT NULL,
  `height` double NOT NULL,
  `volumne` double NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` datetime NOT NULL,
  `updated_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `uom` (`id`, `company_id`, `code`, `name`, `length`, `width`, `height`, `volumne`, `status`, `is_deleted`, `created_date`, `created_by`, `updated_by`, `updated_date`) VALUES
(1,	0,	'kg',	'Kilogram',	0,	0,	0,	0,	1,	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00',	2018),
(2,	0,	'grm',	'Gram',	0,	0,	0,	0,	1,	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00',	2018),
(3,	0,	'nos',	'Number',	0,	0,	0,	0,	1,	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00',	2018);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `reports_to_user_id` int(11) NOT NULL COMMENT 'team lead or RM or admin ID ',
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `profile_pic` varchar(500) NOT NULL,
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

INSERT INTO `users` (`id`, `user_role_id`, `company_id`, `reports_to_user_id`, `email`, `username`, `password`, `profile_pic`, `first_name`, `last_name`, `mobile_no`, `landline`, `address`, `designation`, `dob`, `doj`, `status`, `is_deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1,	1,	1,	0,	'j.meenesh@gmail.com',	'PWI0001',	'827ccb0eea8a706c4c34a16891f84e7b',	'',	'Meenesh',	'Jain',	'9993755651',	'',	'',	'',	'2018-12-06',	'2018-12-06',	1,	0,	'2018-12-06 22:28:15',	1,	'0000-00-00 00:00:00',	0),
(2,	2,	1,	1,	'manishcrpntr2@gmail.com',	'PWI0002',	'827ccb0eea8a706c4c34a16891f84e7b',	'uploads/images/company/LXdD2ypVUL-1544115739.jpg',	'Manish',	'Carpenter',	'9754545409',	'9876543210',	'dewas',	'Mr.',	'1990-03-10',	'2018-12-06',	1,	0,	'2018-12-06 22:32:36',	1,	'2018-12-06 22:32:36',	0),
(3,	1,	2,	0,	'lokesh@akshay.com',	'RTL0001',	'81dc9bdb52d04dc20036dbd8313ed055',	'uploads/images/company/Qm7d2JyI9r-1544434875.jpg',	'Odin',	'All Father',	'1234567897',	'455454',	'Navi Mumbai',	'Admin',	'2018-12-10',	'2018-12-10',	1,	0,	'2018-12-10 14:32:02',	1,	'2018-12-10 15:11:30',	3),
(4,	2,	2,	3,	'lokesh@akshay.com',	'RTL0002',	'81dc9bdb52d04dc20036dbd8313ed055',	'uploads/images/company/y74OB9kTfU-1544433863.jpg',	'RMLoki',	'Odinson',	'78787878787',	'7878787',	'Asguard',	'RM',	'1991-09-27',	'2015-12-15',	1,	0,	'2018-12-10 14:54:26',	3,	'2018-12-10 14:54:26',	0),
(5,	3,	2,	4,	'lokesh@akshay.com',	'RTL0003',	'81dc9bdb52d04dc20036dbd8313ed055',	'uploads/images/company/ap90MMrE7B-1544434069.jpg',	'TLThor',	'Odinson',	'45454875487',	'7787887',	'Navi Mumbai',	'Team Leader',	'1991-09-27',	'2010-09-29',	1,	0,	'2018-12-10 14:57:57',	3,	'2018-12-10 14:57:57',	0),
(6,	3,	2,	4,	'lokesh@akshay.com',	'RTL0004',	'81dc9bdb52d04dc20036dbd8313ed055',	'uploads/images/company/DUNCA1FrT0-1544434237.jpg',	'TLHela',	'Odinson',	'54567487545',	'89789',	'Navi Mumbai',	'Team leader',	'1991-09-27',	'2010-09-30',	1,	0,	'2018-12-10 15:00:53',	3,	'2018-12-10 15:00:53',	0),
(7,	4,	2,	5,	'lokesh@akshay.com',	'RTL0005',	'81dc9bdb52d04dc20036dbd8313ed055',	'uploads/images/company/U8T0z4RNS3-1544434557.jpg',	'Heimdall',	'The Keeper',	'789465487',	'54564',	'navi Mumbai',	'User',	'1991-09-27',	'2010-11-17',	1,	0,	'2018-12-10 15:06:34',	3,	'2018-12-10 15:06:34',	0),
(8,	4,	2,	6,	'lokesh@akshay.com',	'RTL0006',	'81dc9bdb52d04dc20036dbd8313ed055',	'uploads/images/company/Z2D2mRJ682-1544434663.jpg',	'Freya',	'valkyrie',	'78797987987',	'5454',	'navi Mumbai',	'User',	'1991-09-27',	'2010-11-17',	1,	0,	'2018-12-10 15:07:56',	3,	'2018-12-10 15:07:56',	0);

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
(1,	'r1',	'admin',	'full',	'full',	1,	0,	'2018-08-27 21:47:05',	'2018-08-27 21:47:05'),
(2,	'r2',	'Regional Manager',	'full',	'full',	1,	0,	'2018-08-27 21:47:05',	'2018-08-27 21:47:05'),
(3,	'r2',	'Team Leader',	'full',	'full',	1,	0,	'2018-08-27 21:47:05',	'2018-08-27 21:47:05'),
(4,	'r2',	'User',	'full',	'full',	1,	0,	'2018-08-27 21:47:05',	'2018-08-27 21:47:05');

-- 2019-01-19 17:18:01
