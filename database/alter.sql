-- MANISH 29-08-2018


DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(250) NOT NULL,
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



-- 2018-08-29 18:18:07

-- 31-09-2018

INSERT INTO `user_roles` (`id`, `code`, `name`, `permission`, `comments`, `status`, `is_deleted`, `created_date`, `updated_date`) VALUES
(2,	'r2',	'Regional Manager',	'full',	'full',	1,	0,	'2018-08-27 21:47:05',	'2018-08-27 21:47:05'),
(3,	'r2',	'Team Leader',	'full',	'full',	1,	0,	'2018-08-27 21:47:05',	'2018-08-27 21:47:05'),
(4,	'r2',	'Users',	'full',	'full',	1,	0,	'2018-08-27 21:47:05',	'2018-08-27 21:47:05');

--  notes tabe 
DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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

INSERT INTO `notes` (`id`, `user_id`, `related_to`, `subject`, `message`, `color`, `status`, `is_deleted`, `created_date`, `updated_date`) VALUES
(1,	0,	0,	'test ',	'test notes',	'm--bg-metal',	0,	0,	'2018-09-01 18:02:40',	'0000-00-00 00:00:00'),
(2,	0,	0,	'test1',	'test1 notes',	'm--bg-info',	0,	0,	'2018-09-01 18:28:02',	'0000-00-00 00:00:00'),
(3,	0,	0,	'test2',	'test2 notes',	'm--bg-primary',	0,	0,	'2018-09-01 18:28:18',	'0000-00-00 00:00:00'),
(4,	0,	0,	'test purple',	'test purple color notes',	'm--bg-brand',	0,	0,	'2018-09-01 18:49:21',	'0000-00-00 00:00:00'),
(5,	0,	0,	'Test Black ',	'Black Missing',	'm--bg-danger',	0,	0,	'2018-09-02 01:00:00',	'0000-00-00 00:00:00');

UPDATE `user_roles` SET `name` = 'User' WHERE `id` = '4';

-- 09-08-2018

CREATE TABLE `uom` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `code` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `length` double NOT NULL,
  `width` double NOT NULL,
  `height` double NOT NULL,
  `volumne` double NOT NULL,
  `status` tinyint NOT NULL,
  `is_deleted` tinyint NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int NOT NULL,
  `updated_by` datetime NOT NULL,
  `updated_date` int NOT NULL
);

CREATE TABLE `items_price_list` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `company_id` int NOT NULL,
  `item_id` int NOT NULL,
  `price1` double NOT NULL,
  `price2` double NOT NULL,
  `price3` double NOT NULL,
  `price4` double NOT NULL,
  `price5` double NOT NULL,
  `status` tinyint NOT NULL,
  `is_deleted` tinyint NOT NULL,
  `created_by` int NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int NOT NULL,
  `updated_date` datetime NOT NULL
);


ALTER TABLE `items`
ADD `gst_tax_rate` double NOT NULL AFTER `is_gst`;


CREATE TABLE `system_settings` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(200) NOT NULL,
  `sys_value` longtext NOT NULL,
  `sys_group` varchar(20) NOT NULL,
  `status` tinyint NOT NULL,
  `is_deleted` tinyint NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` int NOT NULL
);

INSERT INTO `system_settings` (`name`, `sys_value`, `sys_group`, `status`, `is_deleted`, `created_date`, `updated_date`)
VALUES ('default_currency', 'INR', 'currency ', '', '', '', '');

INSERT INTO `system_settings` (`name`, `sys_value`, `sys_group`, `status`, `is_deleted`, `created_date`, `updated_date`)
VALUES ('system_email', 'info@akshaycrm.com', 'email', '', '', '', '');


ALTER TABLE `contact` ADD `company_id` int(11) NOT NULL AFTER `id`;

ALTER TABLE `items` ADD `company_id` int(11) NOT NULL AFTER `id`;
ALTER TABLE `categories` ADD `company_id` int(11) NOT NULL AFTER `id`;
ALTER TABLE `meeting` ADD `company_id` int(11) NOT NULL AFTER `id`;
ALTER TABLE `notes` ADD `company_id` int(11) NOT NULL AFTER `id`;
ALTER TABLE `subscription` ADD `company_id` int(11) NOT NULL AFTER `id`;
ALTER TABLE `task` ADD `company_id` int(11) NOT NULL AFTER `id`;
ALTER TABLE `uom` ADD `company_id` int(11) NOT NULL AFTER `id`;
ALTER TABLE `activity_logs` ADD `company_id` int(11) NOT NULL AFTER `id`;
ALTER TABLE `account` ADD `company_id` int(11) NOT NULL AFTER `id`;


/* ----  */
ALTER TABLE `items`
CHANGE `group_id` `group_type` int(11) NOT NULL AFTER `description`,
DROP `price_id`

ALTER TABLE `items`
CHANGE `unit` `unit` varchar(50) NOT NULL AFTER `type`;

ALTER TABLE `items`
CHANGE `group_type` `group_type` enum('SERVICE','INVENTORY') NOT NULL AFTER `description`;

ALTER TABLE `companies`
CHANGE `company_name` `company_name` varchar(100) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `id`,
ADD `company_prefix` varchar(50) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `company_name`,
ADD `company_code_start` int NOT NULL AFTER `company_prefix`;

ALTER TABLE `companies`
CHANGE `company_code_start` `company_code_start` varchar(10) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `company_prefix`;

ALTER TABLE `companies`
ADD `logo` varchar(250) NOT NULL AFTER `id`;