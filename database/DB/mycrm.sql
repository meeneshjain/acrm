-- Adminer 4.5.0 MySQL dump

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
(1,	1,	'ACNT000001',	'Meenesh Jain',	'Test',	'194-B Clerk Colony Indore M.P',	'j.meenesh@gmail.com',	'12345678',	'123456789',	'123456789',	'',	1,	0,	'2018-10-01 13:47:49',	1,	'0000-00-00 00:00:00',	0),
(2,	2,	'ACNT000002',	'HDFC',	'hdfc',	'Mi 6 head quaters, plot no 77, scheme no 114, Vijay Nagar',	'admin@hdfc.com',	'admin2@hdfc.com',	'1234567890',	'0987654321',	'',	1,	0,	'2018-10-01 14:41:31',	2,	'0000-00-00 00:00:00',	0);

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
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `username`, `password`, `created_on`, `status`) VALUES
(1,	'admin',	'user',	'admin',	'202cb962ac59075b964b07152d234b70',	'2018-08-27 22:07:43',	1);

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `categoryname` varchar(500) NOT NULL,
  `CategoryImage` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `categories` (`id`, `company_id`, `categoryname`, `CategoryImage`) VALUES
(1,	0,	'Tiendas',	''),
(2,	0,	'Ubicación',	'http://projects.quinoid.com/Chandini/Trendsbook/CategoryImages/Ubicacion.png'),
(3,	0,	'Estilo',	'http://projects.quinoid.com/Chandini/Trendsbook/CategoryImages/03.jpg'),
(4,	0,	'Servicios',	'http://projects.quinoid.com/Chandini/Trendsbook/CategoryImages/04.jpg'),
(5,	0,	'Descuentos',	'http://projects.quinoid.com/Chandini/Trendsbook/CategoryImages/05.jpg'),
(6,	0,	'Tendencias',	'http://projects.quinoid.com/Chandini/Trendsbook/CategoryImages/06.jpg'),
(57,	0,	'trends',	'http://fxbytes.com/Client/trendbooks/CategoryImages/trend2.jpg');

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
(1,	'furniture company ltd',	'FUR',	'0001',	'uploads/images/company/dIoskrF67A-1538378653.jpg',	3,	'j.meenesh@gmail.com',	'j.meenesh@gmail.com',	'098765432',	'090876543221',	'2018-10-01',	'2018-10-01',	'194-B Clerk Colony Indore M.P',	'Test',	'2018-10-01 12:54:59',	'2018-10-01 12:56:20',	1,	0),
(2,	'Akshay Software',	'AST',	'0001',	'uploads/images/company/q3oYMt7kJ9-1538384500.PNG',	3,	'contact@akshay.com',	'admin@email.com',	'1234567890',	'1234567890',	'2018-10-01',	'2018-10-01',	'Mumbai',	'mumbai SAP',	'2018-10-01 14:34:18',	'2018-10-01 14:34:18',	1,	0);

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
(1,	1,	'company_employee_registration',	'Company Registration & Access',	'<p>Hello User, </p><p>Thank you for registering with us. </p><p>Here is your details to login into {{app_name_short}}.<br></p><p><br></p><p><b>URL -</b> {{base_url}}</p><p><b>Name -</b> {{user_full_name}} <br></p><p><b>User Name -</b> {{user_name}}</p><p><b>Password -</b> {{password}}</p><p><br></p><p><b>Regards & Thanks,</b></p><p><b>{{app_name_full}}</b></p><p><b><br></b></p>',	1,	0,	0,	'0000-00-00 00:00:00',	0,	'2018-10-20 18:20:03'),
(2,	1,	'password_changed_success',	'{{company_name}} Employee Password changed',	'Thank you for registering with us \r\nHere is your new password\r\n\r\nURL - {{base_url}}\r\n\r\nName - {{user_full_name}}\r\nNew Password - {{password}}\r\n\r\nNote : Please delete this mail, after keeping your password in a safe place. \r\n\r\nRegards, \r\n{{company_name}}\r\n',	1,	0,	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00'),
(3,	1,	'sales_order_generated',	'{{company_name}} Sales Order Generated',	'Hello Admin,\r\n\r\nYour employee {{employee_name}} has generated a sales order, \r\n\r\nReview your employees sales order at - \r\n\r\nURL - {{base_url}}\r\n\r\nThanks & Regards, \r\n{{company_name}}\r\n',	1,	0,	0,	'2018-10-19 16:00:53',	0,	'2018-10-19 16:00:53'),
(4,	2,	'company_employee_registration',	'Company Registration & Access',	'<p>Hello User, </p><p>Thank you for registering with us. </p><p>Here is your details to login into {{app_name_short}}.<br></p><p><br></p><p><b>URL -</b> {{base_url}}</p><p><b>Name -</b> {{user_full_name}} <br></p><p><b>User Name -</b> {{user_name}}</p><p><b>Password -</b> {{password}}</p><p><br></p><p><b>Regards,</b></p><p><b>{{app_name_full}}</b></p>',	1,	0,	0,	'0000-00-00 00:00:00',	0,	'2018-10-20 17:49:51'),
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
(1,	1,	1,	1,	0,	'Manish',	'Carpenter',	'9754545409',	'',	'maniscrpntr2@gmail.com',	'',	'',	'',	'',	'',	'',	'',	'10/4, pardesipura',	'Indore',	'MP',	'452001',	'India',	'10/4, pardesipura',	'Indore',	'MP',	'',	'India',	'this is first account 123',	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00',	0,	0,	0,	0,	0,	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'2018-09-30 18:27:08',	1,	1,	'2018-09-30 21:00:34',	1,	0),
(2,	1,	1,	1,	0,	'Meenesh ',	'Jain',	'9993755651',	'0731-215935',	'j.meenesh@gmail.com',	'',	'other@gmail.com',	'12345',	'title text',	'IT',	'12345',	'',	'192 B, clerk colony ',	'Indore',	'MP',	'452001',	'India',	'192 B, clerk colony ',	'Indore',	'MP',	'452001',	'India',	'test account second',	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00',	0,	0,	0,	0,	0,	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'2018-09-30 18:55:55',	1,	1,	'2018-09-30 21:00:34',	1,	0),
(3,	1,	1,	1,	0,	'Meenesh',	'Jain',	'09993755651',	'',	'j.meenesh@gmail.com',	'',	'',	'',	'title',	'IT',	'prowebitsolution.com',	'',	'indore',	'indore',	'mp',	'452001',	'India',	'',	'indore',	'uttar p radesh',	'452010',	'India',	'Test  123',	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00',	0,	0,	0,	0,	0,	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'2018-10-01 00:49:56',	5,	1,	'2018-10-01 01:00:57',	5,	0),
(4,	1,	1,	1,	0,	'Meenesh',	'Jain',	'09993755651',	'123456',	'j.meenesh@gmail.com',	'',	'j.meenesh@gmail.com',	'123456789',	'Test',	'IT',	'www.google.com',	'',	'194-B Clerk Colony Indore M.P',	'Indore',	'MADHYA PRADESH',	'452010',	'India',	'194-B Clerk Colony Indore M.P',	'Indore',	'MADHYA PRADESH',	'452010',	'India',	'Test',	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00',	0,	0,	0,	0,	0,	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'2018-10-01 13:49:41',	1,	1,	'0000-00-00 00:00:00',	0,	0),
(5,	2,	2,	2,	0,	'contact',	'one',	'1234567890',	'1234567890',	'admin1@hdfc.com',	'',	'admin2@hdfc.com',	'1233454566',	'bank',	'sales dept ',	'www.hdfc.com',	'',	'hdfc indore',	'indore',	'MP',	'452001',	'india',	'hdfc indore',	'indore',	'MP',	'452001',	'india',	'test',	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00',	0,	0,	0,	0,	0,	'',	'',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'2018-10-01 14:44:45',	2,	1,	'2018-10-01 14:44:59',	2,	0);

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
(1,	1,	'uploads/images/items/umfq71OYmf-1538382222.jpg',	101,	'computer table',	'computer table computer table computer table',	'SERVICE',	'SERIAL',	'kg',	1,	18,	1,	0,	'2018-10-01 13:54:48',	0,	'0000-00-00 00:00:00',	0),
(2,	2,	'uploads/images/items/8d8XFr0aRv-1538385416.jpeg',	10001,	'Software Services',	'CRM setup and installation',	'SERVICE',	'SERIAL',	'kg',	1,	18,	1,	0,	'2018-10-01 14:46:37',	0,	'2018-10-01 14:47:13',	0),
(3,	1,	'assets/images/no.jpg',	123456,	'meeting',	'Test',	'SERVICE',	'SERIAL',	'kg',	1,	18,	1,	0,	'2018-10-21 19:32:28',	0,	'0000-00-00 00:00:00',	0),
(4,	1,	'assets/images/no.jpg',	2147483647,	'BOX',	'BOX carboard ',	'INVENTORY',	'SERIAL',	'kg',	1,	28,	1,	0,	'2018-10-21 19:36:43',	0,	'0000-00-00 00:00:00',	0);

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
(1,	1,	1,	12000,	18000,	20000,	0,	0,	1,	0,	0,	'2018-10-01 13:54:48',	0,	'0000-00-00 00:00:00'),
(2,	2,	2,	25000,	50000,	2000000,	0,	0,	1,	0,	0,	'2018-10-01 14:46:37',	0,	'2018-10-01 14:47:13'),
(3,	1,	3,	20000,	0,	0,	0,	0,	1,	0,	0,	'2018-10-21 19:32:28',	0,	'0000-00-00 00:00:00'),
(4,	1,	4,	134,	0,	0,	0,	0,	1,	0,	0,	'2018-10-21 19:36:43',	0,	'0000-00-00 00:00:00');

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
(1,	1,	0,	'0',	1,	'Meenesh Jain',	1,	'Manish Carpenter',	'9754545409',	1,	'Meenesh Jain',	'2018-11-05',	'2018-11-15',	'0',	4,	'',	'BOX',	'',	'approved',	'low',	'2018-11-05',	'0000-00-00',	'0000-00-00',	'2018-11-13',	'Mobile Damage',	'Broken Screen',	'software',	'1',	'2',	'4',	'',	'',	'Tech Savy',	'Meenesh',	'Ashish',	'Test',	1,	0,	1,	'2018-11-04 18:05:54',	1,	'2018-11-04 23:58:54'),
(2,	1,	3,	'SER-1211123',	1,	'Meenesh Jain',	1,	'Manish Carpenter',	'9754545409',	1,	'Meenesh Jain',	'2018-11-04',	'2018-11-04',	'',	2,	'',	'Software Services',	'',	'planned',	'high',	'0000-00-00',	'0000-00-00',	'0000-00-00',	'0000-00-00',	'MObile hardware ',	'Mobile Mother board change',	'hardware',	'2',	'4',	'3',	'',	'',	'Meenesh',	'Admin',	'RM',	'Fix related problem',	1,	0,	1,	'2018-11-05 00:00:12',	1,	'2018-11-05 22:37:59'),
(3,	1,	3,	'SER-1211123',	1,	'Meenesh Jain',	1,	'Manish Carpenter',	'9754545409',	1,	'Meenesh Jain',	'2018-11-04',	'2018-11-04',	'Updated with remark',	2,	'',	'Software Services',	'',	'planned',	'medium',	'2018-11-14',	'0000-00-00',	'0000-00-00',	'0000-00-00',	'Test',	'Desc',	'software',	'1',	'2',	'2',	'',	'',	'tech ',	'Meenesh',	'Ashish',	'SWB work ',	1,	0,	1,	'2018-11-05 22:31:44',	1,	'2018-11-05 22:37:47');

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
(1,	1,	2,	'HDFC',	5,	'contact one',	'1234567890',	1,	'Meenesh Jain',	'2018-11-03',	'2018-11-04',	'hours',	'5',	'days',	'4',	'approved',	'SER-121111',	2,	'',	'Software Services',	'Update with remark ',	3,	0,	1,	0,	'0000-00-00 00:00:00',	1,	'2018-11-04 02:34:26'),
(2,	1,	2,	'HDFC',	5,	'contact one',	'1234567890',	1,	'Meenesh Jain',	'2018-11-03',	'2018-11-03',	'hours',	'2',	'days',	'2',	'draft',	'SER-121111',	1,	'',	'computer table',	'',	3,	1,	0,	0,	'0000-00-00 00:00:00',	1,	'2018-11-04 03:06:58'),
(3,	1,	1,	'Meenesh Jain',	1,	'Manish Carpenter',	'9754545409',	1,	'Meenesh Jain',	'2018-11-04',	'2018-11-04',	'hours',	'2222',	'hours',	'2222',	'draft',	'SER-1211123',	2,	'',	'Software Services',	'Updated with remark',	0,	1,	0,	1,	'2018-11-04 02:42:02',	1,	'2018-11-04 02:42:34'),
(4,	1,	1,	'Meenesh Jain',	1,	'Manish Carpenter',	'9754545409',	1,	'Meenesh Jain',	'2018-11-04',	'2018-11-04',	'hours',	'1',	'hours',	'7',	'approved',	'SER-Man-123455',	3,	'',	'meeting',	'',	3,	1,	0,	1,	'2018-11-04 03:10:26',	0,	'0000-00-00 00:00:00');

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
(1,	0,	'demo 2nd 1 month comploetion',	'demo 2nd 1 month comploetion',	'2018-10-01 13:55:00',	'2018-10-01 15:55:00',	'1,2,3',	'PLANED',	'2018-10-01 12:51:17',	1,	'2018-10-01 12:51:17',	0,	'2018-10-01 13:05:00',	1,	0),
(2,	0,	'meeting for demo on 1st oct',	'meeting for demo on 1st oct',	'2018-10-01 14:20:00',	'2018-10-01 15:55:00',	'1,2,3',	'PLANED',	'2018-10-01 14:29:18',	1,	'2018-10-01 14:29:18',	0,	'2018-10-01 13:20:00',	1,	0);

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
(2,	0,	1,	0,	'New notes 2 ',	'New notes 12 ',	'm--bg-black',	0,	0,	'2018-10-01 14:28:14',	'2018-10-01 14:28:27'),
(3,	1,	1,	0,	'Test notes 3',	'Test notes 3 Test notes 3 Test notes 3 Test notes 3 Test notes 3 Test notes 3 Test notes 3 Test notes 3 Test notes 3 Test notes 3 ',	'm--bg-primary',	0,	0,	'2018-10-14 14:09:29',	'2018-11-12 23:57:43');

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
(1,	'QUOTATION',	1,	0,	'',	1,	'Meenesh Jain',	4,	'Meenesh Jain',	'09993755651',	0,	'Meenesh Jain',	'DOC0020180001',	'2018-10-01',	'2018-10-01',	'2018-10-01',	'urgent ',	'',	'COD ',	'Test Delivery address',	'gst2002',	'67260.00',	'20000',	'5',	'5',	'87041.85',	'draft',	'',	'',	1,	0,	0,	'2018-10-01 13:58:12',	0,	'2018-10-01 13:59:19'),
(2,	'QUOTATION',	2,	0,	'',	2,	'HDFC',	5,	'contact one',	'1234567890',	0,	'user1 user 1',	'DOC0020180001',	'2018-10-01',	'2018-10-01',	'2018-10-01',	'urgent needed',	'pan123',	'only cash',	'Plot no 1, Scheme no 78 Vijay nagar',	'gst123',	'216589.00',	'2000',	'12',	'10',	'220337.71',	'draft',	'',	'',	1,	0,	0,	'2018-10-01 14:49:54',	0,	'2018-10-01 14:50:19'),
(3,	'ORDER',	1,	0,	'',	1,	'Meenesh Jain',	1,	'Manish Carpenter',	'9754545409',	0,	'Meenesh Jain',	'DOC10020180002',	'2018-10-10',	'2018-10-10',	'2018-10-10',	'Test ',	'PAN52000',	'Test',	'194-B Clerk Colony Indore M.P',	'GST52000',	'28320.00',	'',	'',	'',	'28320.00',	'negotiation',	'',	'2',	1,	0,	0,	'2018-10-10 23:08:14',	0,	'2018-10-11 00:19:58'),
(4,	'ORDER',	1,	0,	'',	2,	'HDFC',	5,	'contact one',	'1234567890',	0,	'user1 user 1',	'DOC0020180001',	'2018-10-01',	'2018-10-01',	'2018-10-01',	'urgent needed',	'pan123',	'only cash',	'Plot no 1, Scheme no 78 Vijay nagar',	'gst123',	'216589.00',	'2000',	'12',	'10',	'220337.71',	'draft',	'',	'',	1,	0,	0,	'2018-10-11 23:27:46',	0,	'0000-00-00 00:00:00'),
(5,	'ORDER',	1,	1,	'',	1,	'Meenesh Jain',	4,	'Meenesh Jain',	'09993755651',	0,	'Meenesh Jain',	'DOC0020180001',	'2018-10-01',	'2018-10-01',	'2018-10-01',	'urgent ',	'',	'COD ',	'Test Delivery address',	'gst2002',	'67260.00',	'20000',	'5',	'5',	'87041.85',	'draft',	'',	'',	1,	0,	0,	'2018-10-11 23:49:15',	0,	'2018-10-12 00:14:10'),
(6,	'QUOTATION',	1,	0,	'',	1,	'Meenesh Jain',	1,	'Manish Carpenter',	'9754545409',	1,	'Meenesh Jain',	'DOC10020180005',	'2018-10-24',	'2018-10-24',	'2018-10-24',	'',	'tt222222',	'',	'Test',	't1234',	'57348.00',	'1245',	'4',	'4',	'58499.25',	'draft',	'',	'0',	1,	0,	1,	'2018-10-24 22:52:22',	0,	'0000-00-00 00:00:00');

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
(1,	1,	1,	1,	'101',	'computer table',	5,	12000,	'5',	'',	'',	'18',	'67260.00',	'0000-00-00 00:00:00',	'',	1,	0,	'2018-10-01 13:58:12',	0,	'2018-10-01 13:59:19',	0),
(2,	2,	2,	2,	'10001',	'Software Services',	6,	12000,	'10',	'',	'',	'18',	'76464.00',	'0000-00-00 00:00:00',	'Test',	1,	0,	'2018-10-01 14:49:54',	0,	'2018-10-01 14:50:19',	0),
(3,	2,	2,	1,	'101',	'computer table',	5,	25000,	'5',	'',	'',	'18',	'140125.00',	'0000-00-00 00:00:00',	'quick delivery by air ',	1,	0,	'2018-10-01 14:49:54',	0,	'2018-10-01 14:50:19',	0),
(4,	1,	3,	1,	'101',	'computer table',	2,	12000,	'',	'',	'',	'18',	'28320.00',	'0000-00-00 00:00:00',	'',	1,	0,	'2018-10-10 23:08:14',	0,	'2018-10-11 00:19:58',	0),
(5,	1,	4,	2,	'10001',	'Software Services',	6,	12000,	'10',	'',	'',	'18',	'76464.00',	'0000-00-00 00:00:00',	'Test',	1,	0,	'2018-10-11 23:27:46',	0,	'0000-00-00 00:00:00',	0),
(6,	1,	4,	1,	'101',	'computer table',	5,	25000,	'5',	'',	'',	'18',	'140125.00',	'0000-00-00 00:00:00',	'quick delivery by air ',	1,	0,	'2018-10-11 23:27:46',	0,	'0000-00-00 00:00:00',	0),
(7,	1,	5,	1,	'101',	'computer table',	5,	12000,	'5',	'',	'',	'18',	'67260.00',	'0000-00-00 00:00:00',	'',	1,	0,	'2018-10-11 23:49:15',	0,	'2018-10-12 00:14:10',	0),
(8,	1,	6,	1,	'101',	'computer table',	3,	18000,	'10',	'',	'',	'18',	'57348.00',	'0000-00-00 00:00:00',	'',	1,	0,	'2018-10-24 22:52:22',	1,	'0000-00-00 00:00:00',	0);

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

INSERT INTO `sales_order_revisions` (`id`, `sales_order_id`, `revision_no`, `revision_amount`, `status`, `is_deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1,	3,	1,	14160,	1,	0,	'2018-10-10 23:59:56',	0,	'0000-00-00 00:00:00',	0),
(2,	3,	2,	14160,	1,	0,	'2018-10-11 00:19:36',	0,	'0000-00-00 00:00:00',	0);

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
(3,	'default_theme',	'pitch_black',	'look_feel',	1,	0,	'2018-11-09 12:17:49',	'0000-00-00 00:00:00'),
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
(1,	0,	'no padding css work ',	'no padding css work ',	0,	'2018-10-01 12:52:44',	1,	'2018-10-01 12:53:25',	0,	1,	0),
(2,	0,	'call lokesh',	'ask lokesh for demo ',	0,	'2018-10-01 14:30:28',	1,	'2018-10-01 14:30:42',	0,	1,	0);

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
(3,	0,	'each',	'Each',	0,	0,	0,	0,	1,	0,	'0000-00-00 00:00:00',	0,	'0000-00-00 00:00:00',	2018);

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
(1,	1,	1,	0,	'j.meenesh@gmail.com',	'FUR0001',	'202cb962ac59075b964b07152d234b70',	'',	'Meenesh',	'Jain',	'9993755651',	'',	'',	'',	'2018-10-01',	'2018-10-01',	1,	0,	'2018-10-01 12:54:59',	1,	'0000-00-00 00:00:00',	0),
(2,	1,	2,	0,	'',	'AST0001',	'202cb962ac59075b964b07152d234b70',	'',	'user1',	'user 1',	'0987654321',	'',	'',	'',	'2018-10-01',	'2018-10-01',	1,	0,	'2018-10-01 14:34:18',	1,	'0000-00-00 00:00:00',	0),
(3,	2,	2,	0,	'user@akhay.com',	'AST0001',	'test',	'assets/images/no.png',	'user2',	'user 2 ',	'9993755651',	'09993755651',	'194-B Clerk Colony Indore M.P',	'RM',	'2018-10-01',	'2018-10-01',	1,	0,	'2018-10-01 14:36:20',	0,	'2018-10-01 14:36:20',	0);

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

-- 2018-12-06 16:06:47
