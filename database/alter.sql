-- USERS TABLE ALTER ON 17-12-2018

DROP TABLE IF EXISTS `chat_history`;
CREATE TABLE `chat_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `messege` text NOT NULL,
  `document` varchar(100) NOT NULL,
  `document_type` enum('JPG','JPEG','PNG','GIF','PDF','XLS','XLXS','DOC','MP3','MP4') DEFAULT NULL,
  `send_at` datetime NOT NULL,
  `deliver_at` datetime NOT NULL,
  `is_sent` int(11) NOT NULL,
  `is_read` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_delete` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `users`
ADD `is_login` int(11) NOT NULL;

-- ADMIN TABLE ALTER ON 09-12-2018

ALTER TABLE `admin`
ADD `email` varchar(50) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `last_name`,
ADD `contact` varchar(15) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `email`;

-- MANISH 21-10-2018

ALTER TABLE `calls`
ADD `lead_type` enum('CONTACT','LEAD','OPPORTUNITY') NOT NULL AFTER `lead_id`,
DROP `contact_id`;

ALTER TABLE `calls`
CHANGE `alert_before_minute` `alert_before_datetime` datetime NOT NULL AFTER `updated_by`;


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


-- MANISH 29-08-2018

SET foreign_key_checks = 0;

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

ALTER TABLE `task`
CHANGE `is_delete` `is_deleted` tinyint(4) NOT NULL AFTER `status`;

-- 14-09-2018

ALTER TABLE `users`
ADD `reports_to_user_id` int(11) NOT NULL COMMENT 'team lead or RM or admin ID ' AFTER `company_id`;

-- 15-09-2018

ALTER TABLE `activity_logs`
ADD `activity_for_user_id` int(11) NOT NULL AFTER `company_id`,
ADD `activity_by_user_i` int(11) NOT NULL AFTER `activity_for_user_id`

-- 16-08-2018

ALTER TABLE `companies`
CHANGE `company_name` `company_name` varchar(100) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `id`,
ADD `company_prefix` varchar(50) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `company_name`,
ADD `company_code_start` int NOT NULL AFTER `company_prefix`;

ALTER TABLE `companies`
CHANGE `company_code_start` `company_code_start` varchar(10) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `company_prefix`;

ALTER TABLE `companies`
ADD `logo` varchar(250) NOT NULL AFTER `id`;

ALTER TABLE `users`
ADD `profile_pic` varchar(500) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `password`;

ALTER TABLE `companies`
CHANGE `company_name` `company_name` varchar(100) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `id`,
ADD `company_prefix` varchar(50) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `company_name`,
ADD `company_code_start` int NOT NULL AFTER `company_prefix`;

ALTER TABLE `companies`
CHANGE `company_code_start` `company_code_start` varchar(10) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `company_prefix`;

ALTER TABLE `companies`
ADD `logo` varchar(250) NOT NULL AFTER `id`;

-- 22 - 09 - 2018

CREATE TABLE `sales_order_quote` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `company_id` int NOT NULL,
  `sales_quotation_id` int NOT NULL,
  `revision_id` varchar(150) NOT NULL,
  `account_id` int NOT NULL,
  `account_name` varchar(200) NOT NULL,
  `doc_no` varchar(100) NOT NULL,
  `doc_date` datetime NOT NULL,
  `delivery_date` datetime NOT NULL,
  `valid_till` datetime NOT NULL,
  `remarks` text NOT NULL,
  `pan_card_no` varchar(50) NOT NULL,
  `pay_terms` text NOT NULL,
  `delivery_address` text NOT NULL,
  `gst_no.` varchar(50) NOT NULL,
  `total_amount` varchar(50) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `actual_total` varchar(50) NOT NULL,
  `stages` varchar(50) NOT NULL,
  `status` tinyint NOT NULL,
  `is_deleted` tinyint NOT NULL,
  `created_by` int NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int NOT NULL,
  `updated_date` datetime NOT NULL
);

--
ALTER TABLE `sales_order_quote`
RENAME TO `sales_order`;



CREATE TABLE `sales_quotation` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `company_id` int NOT NULL,
  `revision_id` varchar(150) NOT NULL,
  `account_id` int NOT NULL,
  `account_name` varchar(200) NOT NULL,
  `doc_no` varchar(100) NOT NULL,
  `doc_date` datetime NOT NULL,
  `delivery_date` datetime NOT NULL,
  `valid_till` datetime NOT NULL,
  `remarks` text NOT NULL,
  `pan_card_no` varchar(50) NOT NULL,
  `pay_terms` text NOT NULL,
  `delivery_address` text NOT NULL,
  `gst_no.` varchar(50) NOT NULL,
  `total_amount` varchar(50) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `actual_total` varchar(50) NOT NULL,
  `stages` varchar(50) NOT NULL,
  `status` tinyint NOT NULL,
  `is_deleted` tinyint NOT NULL,
  `created_by` int NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int NOT NULL,
  `updated_date` datetime NOT NULL
);

CREATE TABLE `sales_quotation_revisions` (
  `id` int NOT NULL,
  `sales_quotation_id` int(11) NOT NULL,
  `revision_no` int NOT NULL,
  `revision_amount` int NOT NULL,
  `status` int NOT NULL,
  `is_deleted` int NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int NOT NULL,
  FOREIGN KEY (`sales_quotation_id`) REFERENCES `sales_quotation` (`id`)
);

CREATE TABLE `sales_quotation_details` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `company_id` int NOT NULL,
  `sales_quotation_id` int NOT NULL,
  `item_id` int NOT NULL,
  `item_code` varchar(100) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `quantity` int NOT NULL,
  `price` double NOT NULL,
  `discount` varchar(20) NOT NULL,
  `after_discount` varchar(20) NOT NULL,
  `tax_code` varchar(50) NOT NULL,
  `tax_amount` varchar(20) NOT NULL,
  `total` varchar(50) NOT NULL,
  `delivery_date` datetime NOT NULL,
  `remark` text NOT NULL,
  `status` tinyint NOT NULL,
  `is_deleted` tinyint NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int NOT NULL
);

CREATE TABLE `sales_order_details` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `company_id` int NOT NULL,
  `sales_order_id` int NOT NULL,
  `item_id` int NOT NULL,
  `item_code` varchar(100) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `quantity` int NOT NULL,
  `price` double NOT NULL,
  `discount` varchar(20) NOT NULL,
  `after_discount` varchar(20) NOT NULL,
  `tax_code` varchar(50) NOT NULL,
  `tax_amount` varchar(20) NOT NULL,
  `total` varchar(50) NOT NULL,
  `delivery_date` datetime NOT NULL,
  `remark` text NOT NULL,
  `status` tinyint NOT NULL,
  `is_deleted` tinyint NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int NOT NULL
);

ALTER TABLE `account`
CHANGE `code` `account_number` varchar(50) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `company_id`;

ALTER TABLE `account`
ADD `email_1` varchar(50) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `address`,
ADD `email_2` varchar(50) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `email_1`;

ALTER TABLE `account`
CHANGE `code` `account_number` varchar(50) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `company_id`;

ALTER TABLE `sales_order`
ADD `contact_person_id` varchar(200) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `account_name`,
ADD `contact_person_number` varchar(200) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `contact_person_id`,
ADD `sales_employee` varchar(200) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `contact_person_number`;

ALTER TABLE `sales_order`
CHANGE `gst_no.` `gst_no` varchar(50) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `delivery_address`;

ALTER TABLE `sales_order`
ADD `contact_person_name` varchar(200) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `contact_person_id`;


ALTER TABLE `sales_order`
ADD `other_charges` varchar(50) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `total_amount`;
ADD `total_tax` varchar(50) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `other_charges`;


/*  NEW TABLE FOR CONTACT/LEAD */
CREATE TABLE `contact_lead` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `company_id` int NOT NULL,
  `account_id` int NOT NULL,
  `owner_id` int NOT NULL COMMENT 'Employee id who handle this lead/contact/opp',
  `is_type` tinyint NOT NULL COMMENT '0-Contact | 1-Lead | 2-Opportunity',
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `office_contact` varchar(15) NOT NULL,
  `email_address` varchar(50) NOT NULL COMMENT 'multiple concat with ***',
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
  `convert_oppr_date` datetime NOT NULL COMMENT 'convert from lead to opportunity date',
  `convert_lead_date` datetime NOT NULL COMMENT 'convert from contact to lead date',
  `created_date` datetime NOT NULL,
  `created_by` int NOT NULL,
  `status` int NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int NOT NULL,
  `is_deleted` int NOT NULL
);


ALTER TABLE `contact_lead`
CHANGE `office_contact` `other_contact` varchar(15) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `mobile`,
CHANGE `email_address` `email_1` varchar(50) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `other_contact`,
ADD `email_2` varchar(50) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `email_1`,
ADD `other_email` varchar(50) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `email_2`;


ALTER TABLE `sales_quotation_revisions`
RENAME TO `sales_order_revisions`;

ALTER TABLE `sales_order_revisions`
CHANGE `sales_quotation_id` `sales_order_id` int NOT NULL AFTER `id`;

DROP TABLE IF EXISTS `sales_order_revisions`;
CREATE TABLE `sales_order_revisions` (
  `id` int(11) NOT NULL,
  `sales_order_id` int(11) NOT NULL,
  `revision_no` int(11) NOT NULL,
  `revision_amount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `sales_order_revisions`
CHANGE `id` `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;


ALTER TABLE `sales_order`
ADD `cancel_reason` varchar(50) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `stages`,
ADD `revision_number` varchar(50) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `cancel_reason`;


--after deployment 14-10-2018

ALTER TABLE `sales_order`
CHANGE `doc_date` `doc_date` date NOT NULL AFTER `doc_no`,
CHANGE `delivery_date` `delivery_date` date NOT NULL AFTER `doc_date`,
CHANGE `valid_till` `valid_till` date NOT NULL AFTER `delivery_date`;

CREATE TABLE `email_template` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `template_key` int NOT NULL,
  `subject` text NOT NULL,
  `body` longtext NOT NULL,
  `status` tinyint NOT NULL,
  `is_deleted` tinyint NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
);

ALTER TABLE `email_template`
ADD `is_global` tinyint NOT NULL DEFAULT '0' AFTER `body`;

CREATE TABLE `company_email_templates` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `company_id` int NOT NULL,
  `subject` text NOT NULL,
  `body` text NOT NULL,
  `status` tinyint NOT NULL,
  `is_deleted` tinyint NOT NULL,
  `created_by` int NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int NOT NULL,
  `updated_date` datetime NOT NULL
);


ALTER TABLE `email_template`
CHANGE `template_key` `template_key` varchar(200) NOT NULL AFTER `id`;

ALTER TABLE `company_email_templates`
ADD `template_key` varchar(200) NOT NULL AFTER `company_id`;

ALTER TABLE `targets`
ADD `company_id` int(11) NOT NULL AFTER `id`;

ALTER TABLE `targets`
ADD `target_type` enum('amount','product') NOT NULL AFTER `target_duration_id`;

ALTER TABLE `sales_order`
ADD `sales_employee_id` varchar(200) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `contact_person_number`;

ALTER TABLE `sales_order`
CHANGE `contact_person_id` `contact_person_id` int NOT NULL AFTER `account_name`,
CHANGE `sales_employee_id` `sales_employee_id` int NOT NULL AFTER `contact_person_number`;


CREATE TABLE `item_service_contract` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `company_id` int NOT NULL,
  `account_id` int NOT NULL,
  `account_name` varchar(200) NOT NULL,
  `contact_person_id` int NOT NULL,
  `contact_person_name` varchar(200) NOT NULL,
  `contact_person_number` varchar(200) NOT NULL,
  `sales_employee_id` int NOT NULL,
  `sales_employee` varchar(200) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `response_duration_type` enum('days','hours') NOT NULL,
  `response_time` varchar(50) NOT NULL,
  `resolution_duration_type` enum('days','hours') NOT NULL,
  `resolution_time` varchar(50) NOT NULL,
  `stage` varchar(50) NOT NULL COMMENT 'similar as quotation ',
  `serial_number` varchar(250) NOT NULL COMMENT 'auto generate and unique',
  `item_id` int NOT NULL,
  `item_code` varchar(250) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `remark` text NOT NULL,
  `status` tinyint NOT NULL,
  `is_deleted` tinyint NOT NULL,
  `created_by` int NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int NOT NULL,
  `updated_date` datetime NOT NULL
);



DROP TABLE IF EXISTS `item_service_call`;
CREATE TABLE `item_service_call` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `item_service_contract_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `account_name` varchar(250) NOT NULL,
  `contact_person_id` int(11) NOT NULL,
  `contact_person_name` varchar(250) NOT NULL,
  `contact_person_number` varchar(100) NOT NULL,
  `sales_employee_id` int(11) NOT NULL,
  `sales_employee` varchar(250) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_code` varchar(200) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `item_group` varchar(200) NOT NULL,
  `call_status` varchar(200) NOT NULL,
  `priority` enum('low','medium','high') NOT NULL,
  `call_open_date` datetime NOT NULL,
  `call_closing_date` datetime NOT NULL,
  `call_working_date` datetime NOT NULL,
  `call_progress_date` datetime NOT NULL,
  `subject` text NOT NULL,
  `description` text NOT NULL,
  `problem_origin` varchar(200) NOT NULL,
  `problem_type` varchar(200) NOT NULL,
  `problem_subtype` varchar(200) NOT NULL,
  `call_type` varchar(200) NOT NULL,
  `technical` varchar(100) NOT NULL,
  `technical_type` varchar(250) NOT NULL,
  `given_by_id` int(11) NOT NULL,
  `given_to_id` int(11) NOT NULL,
  `job_description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `item_service_contract`
ADD `free_services` tinyint NOT NULL AFTER `remark`

ALTER TABLE `item_service_call`
ADD `item_service_contract_serial_number` int NOT NULL AFTER `item_service_contract_id`;

ALTER TABLE `item_service_call`
ADD `remark` tinyint NOT NULL AFTER `end_date`

ALTER TABLE `item_service_call`
CHANGE `call_open_date` `planned_call_date` datetime NOT NULL AFTER `priority`,
CHANGE `call_closing_date` `tentative_call_date` datetime NOT NULL AFTER `planned_call_date`,
CHANGE `call_working_date` `approved_call_date` datetime NOT NULL AFTER `tentative_call_date`,
CHANGE `call_progress_date` `rejected_call_date` datetime NOT NULL AFTER `approved_call_date`;

ALTER TABLE `item_service_call`
ADD `technician` varchar(250) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `technical_type`;

ALTER TABLE `item_service_call`
CHANGE `given_by_id` `given_by` int(11) NOT NULL AFTER `technician`,
CHANGE `given_to_id` `given_to` int(11) NOT NULL AFTER `given_by`;

ALTER TABLE `item_service_call`
CHANGE `given_by` `given_by` varchar(250) NOT NULL AFTER `technician`,
CHANGE `given_to` `given_to` varchar(250) NOT NULL AFTER `given_by`;

ALTER TABLE `item_service_call`
CHANGE `remark` `remark` varchar(200) NOT NULL AFTER `end_date`;

ALTER TABLE `item_service_call`
CHANGE `planned_call_date` `planned_call_date` date NOT NULL AFTER `priority`,
CHANGE `tentative_call_date` `tentative_call_date` date NOT NULL AFTER `planned_call_date`,
CHANGE `approved_call_date` `approved_call_date` date NOT NULL AFTER `tentative_call_date`,
CHANGE `rejected_call_date` `rejected_call_date` date NOT NULL AFTER `approved_call_date`;

ALTER TABLE `item_service_call`
CHANGE `item_service_contract_serial_number` `item_service_contract_serial_number` varchar(200) NOT NULL AFTER `item_service_contract_id`;

INSERT INTO `system_settings` (`name`, `sys_value`, `sys_group`, `status`, `is_deleted`, `created_date`, `updated_date`)
VALUES ('default_theme', 'purple_red', 'look_feel', '1', '0', now(), '');

ALTER TABLE `system_settings`
CHANGE `updated_date` `updated_date` datetime NOT NULL AFTER `created_date`;

INSERT INTO `system_settings` (`name`, `sys_value`, `sys_group`, `status`, `is_deleted`, `created_date`, `updated_date`)
VALUES ('available_theme', '[{\"name\":\"purple_red\",\"title\":\"Purple Red\"},{\"name\":\"pitch_black\",\"title\":\"Pitch Black\"},{\"name\":\"just_white\",\"title\":\"Just White\"},{\"name\":\"soft_metal\",\"title\":\"Soft Metal\"},{\"name\":\"grape_fruit\",\"title\":\"Grape Fruit\"},{\"name\":\"blue_jeans\",\"title\":\"Blue Jeans\"},{\"name\":\"grass\",\"title\":\"Grass\"},{\"name\":\"pink_rose\",\"title\":\"Pink Rose\"}]', 'look_feel', '1', '0', now(), now());


-- truncate table for deployment 
truncate table account;
truncate table activity_logs;
truncate table contact_lead;
truncate table companies;
truncate table company_email_templates;
truncate table items;
truncate table items_price_list;
truncate table item_service_call;
truncate table item_service_contract;
truncate table company_email_templates;
truncate table meeting;
truncate table `notes`;
truncate table sales_order;
truncate table sales_order_details;
truncate table sales_order_revisions;
truncate table task;
truncate table  targets;
truncate table users;

-- queries after 2nd release


-- manish region start 

-- manish region end


-- meenesh region start 

ALTER TABLE `admin`
ADD `email` varchar(50) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `last_name`,
ADD `contact` varchar(15) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `email`;

-- meenesh region end