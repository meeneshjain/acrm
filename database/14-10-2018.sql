-- Adminer 4.5.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `sales_order`;
CREATE TABLE `sales_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('ORDER','QUOTATION') NOT NULL,
  `company_id` int(11) NOT NULL,
  `sales_quote_ref_id` int(11) NOT NULL,
  `revision_id` varchar(150) NOT NULL,
  `account_id` int(11) NOT NULL,
  `account_name` varchar(200) NOT NULL,
  `contact_person_id` varchar(200) NOT NULL,
  `contact_person_name` varchar(200) NOT NULL,
  `contact_person_number` varchar(200) NOT NULL,
  `sales_employee` varchar(200) NOT NULL,
  `doc_no` varchar(100) NOT NULL,
  `doc_date` datetime NOT NULL,
  `delivery_date` datetime NOT NULL,
  `valid_till` datetime NOT NULL,
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
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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


-- 2018-10-01 07:14:26
