-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 09, 2020 at 04:56 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akshay_crm`
--
CREATE DATABASE IF NOT EXISTS `akshay_crm` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `akshay_crm`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
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
  `gst_no` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT 'active | inactive | pending | blocked ',
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `company_id`, `account_number`, `name`, `description`, `address`, `email_1`, `email_2`, `contact_no_1`, `contact_no_2`, `optional_contact`, `gst_no`, `status`, `is_deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 1, 'ACNT000001', 'Meenesh Jain', 'Test', '194-B Clerk Colony Indore M.P', 'j.meenesh@gmail.com', '12345678', '123456789', '123456789', '', '', 1, 0, '2018-10-01 13:47:49', 1, '0000-00-00 00:00:00', 0),
(2, 2, 'ACNT000002', 'HDFC', 'hdfc', 'Mi 6 head quaters, plot no 77, scheme no 114, Vijay Nagar', 'admin@hdfc.com', 'admin2@hdfc.com', '1234567890', '0987654321', '', '', 1, 0, '2018-10-01 14:41:31', 2, '0000-00-00 00:00:00', 0),
(3, 1, 'ACNT000003', 'ICICI', 'test', 'account description', 'test12345@gail.com', '', '121234333', '1234567877', '', '123456622', 1, 0, '2019-05-20 16:14:02', 1, '2019-05-20 16:16:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE IF NOT EXISTS `activity_logs` (
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

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `email`, `contact`, `username`, `password`, `created_on`, `status`) VALUES
(1, 'admin', 'user', '', '', 'admin', '202cb962ac59075b964b07152d234b70', '2018-08-27 22:07:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `calls`
--

DROP TABLE IF EXISTS `calls`;
CREATE TABLE IF NOT EXISTS `calls` (
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

-- --------------------------------------------------------

--
-- Table structure for table `chat_history`
--

DROP TABLE IF EXISTS `chat_history`;
CREATE TABLE IF NOT EXISTS `chat_history` (
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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_history`
--

INSERT INTO `chat_history` (`id`, `from_id`, `to_id`, `messege`, `document`, `document_type`, `send_at`, `deliver_at`, `is_sent`, `is_read`, `status`, `is_delete`) VALUES
(1, 1, 4, 'hi', '', NULL, '2018-12-30 09:46:13', '0000-00-00 00:00:00', 0, 1, 0, 0),
(2, 1, 4, 'Test', '', NULL, '2018-12-30 09:46:47', '0000-00-00 00:00:00', 0, 1, 0, 0),
(3, 1, 4, 'hi', '', NULL, '2018-12-30 09:47:23', '0000-00-00 00:00:00', 0, 1, 0, 0),
(4, 4, 1, 'Hi sir ', '', NULL, '2018-12-30 09:49:18', '0000-00-00 00:00:00', 0, 1, 0, 0),
(5, 1, 4, 'Helllo', '', NULL, '2018-12-30 09:50:18', '0000-00-00 00:00:00', 0, 1, 0, 0),
(6, 4, 1, 'hi', '', NULL, '2018-12-30 09:50:28', '0000-00-00 00:00:00', 0, 1, 0, 0),
(7, 4, 1, 'how are you ?', '', NULL, '2018-12-30 10:03:44', '0000-00-00 00:00:00', 0, 1, 0, 0),
(8, 1, 4, 'I am good, how are you ?', '', NULL, '2018-12-30 10:04:06', '0000-00-00 00:00:00', 0, 1, 0, 0),
(9, 1, 4, 'where are you ', '', NULL, '2018-12-30 10:04:14', '0000-00-00 00:00:00', 0, 1, 0, 0),
(10, 1, 4, 'I heard you left indore and went to dewas to work ', '', NULL, '2018-12-30 10:04:26', '0000-00-00 00:00:00', 0, 1, 0, 0),
(11, 4, 1, 'ha yar kya batau ', '', NULL, '2018-12-30 10:04:34', '0000-00-00 00:00:00', 0, 1, 0, 0),
(12, 4, 1, 'life ke L lag gye ', '', NULL, '2018-12-30 10:04:43', '0000-00-00 00:00:00', 0, 1, 0, 0),
(13, 1, 4, 'kya baat kr rha h q ?', '', NULL, '2018-12-30 10:05:09', '0000-00-00 00:00:00', 0, 1, 0, 0),
(14, 1, 4, 'or kaise chal rhe h life dewas me ', '', NULL, '2018-12-30 10:20:32', '0000-00-00 00:00:00', 0, 1, 0, 0),
(15, 1, 4, 'maza aa rha h ke ni ?', '', NULL, '2018-12-30 10:20:36', '0000-00-00 00:00:00', 0, 1, 0, 0),
(16, 4, 1, 'Ghanta maza ni aa rha h life ke lode laga de BC', '', NULL, '2018-12-30 10:20:52', '0000-00-00 00:00:00', 0, 1, 0, 0),
(17, 4, 1, 'Hello', '', NULL, '2018-12-30 10:22:20', '0000-00-00 00:00:00', 0, 1, 0, 0),
(18, 1, 4, 'Ypopo', '', NULL, '2018-12-30 10:23:10', '0000-00-00 00:00:00', 0, 1, 0, 0),
(19, 4, 1, 'dekhte h msg ', '', NULL, '2018-12-30 10:24:48', '0000-00-00 00:00:00', 0, 1, 0, 0),
(20, 1, 4, 'sahi design lag rhe h ', '', NULL, '2018-12-30 10:24:57', '0000-00-00 00:00:00', 0, 1, 0, 0),
(21, 4, 1, 'haa ', '', NULL, '2018-12-30 10:25:01', '0000-00-00 00:00:00', 0, 1, 0, 0),
(22, 4, 1, 'refresh mat karna ', '', NULL, '2018-12-30 10:25:07', '0000-00-00 00:00:00', 0, 1, 0, 0),
(23, 1, 4, 'ha ni kar rha ', '', NULL, '2018-12-30 10:25:10', '0000-00-00 00:00:00', 0, 1, 0, 0),
(24, 1, 4, 'kya kar lega ', '', NULL, '2018-12-30 10:25:15', '0000-00-00 00:00:00', 0, 1, 0, 0),
(25, 4, 1, 'BMERPMOB] BMLIC_ApplicationType=3 BMLIC_ProductKey=CNF BMLIC_ProdRegKey=OptiProSuite LicenseSrvr=Provider=SQLOLEDB.1;Driver=SQL Server;Server=OPTI-QAPP;uid=sa;pwd=sql2k14@opti;Database=OptiProLicenseManager', '', NULL, '2018-12-30 10:25:33', '0000-00-00 00:00:00', 0, 1, 0, 0),
(26, 4, 1, '<add key=\"DatabaseLanguage\" value=\"ln_English\"/>     <add key=\"LicenceServer\" value=\"172.16.6.134\" />     <add key=\"Port\" value=\"30000\" />     <add key=\"PrinterServerIP\" value=\"172.16.6.134\"/>     <add key=\"SuperUserId\" value=\"manager\" />     <add key=\"SAPLicenseServer\" value=\"172.16.6.134\"/>     <add key=\"LogOutIdleTime\" value =\"480\"/>     </appSettings>   </configuration>', '', NULL, '2018-12-30 10:25:48', '0000-00-00 00:00:00', 0, 1, 0, 0),
(27, 4, 1, 'Select \"price_list\".\"ListName\",ISNULL(\"feature_head\".\"OPTM_FEATURECODE\",\'\')  as \"feature_code\",ISNULL(\"model_code\".\"OPTM_FEATURECODE\",\'\') as \"child_code\", \"feature_detail\".* FROM OPCONFIG_MBOMDTL as \"feature_detail\" LEFT JOIN \"OPConfig_PriceList\" as \"price_list\" ON \"feature_detail\".\"OPTM_PRICESOURCE\" = \"price_list\".\"PriceListID\" AND \"price_list\".\"ItemCode\" = \"feature_detail\".\"OPTM_ITEMKEY\" LEFT JOIN \"OPCONFIG_FEATUREHDR\" as \"feature_head\" ON \"feature_detail\".\"OPTM_FEATUREID\" = \"feature_head\".\"OPTM_FEATUREID\" LEFT JOIN \"OPCONFIG_FEATUREHDR\" as \"model_code\" ON \"feature_detail\".OPTM_CHILDMODELID = \"model_code\".\"OPTM_FEATUREID\"  WHERE \"feature_detail\".\"OPTM_MODELID\"=24 ORDER BY \"feature_detail\".\"OPTM_LINEN', '', NULL, '2018-12-30 10:26:24', '0000-00-00 00:00:00', 0, 1, 0, 0),
(28, 1, 4, 'kya baat kr rha h q ? 30 Dec 2018 @ 10:05:09 AM or kaise chal rhe h life dewas me 30 Dec 2018 @ 10:20:32 AM maza aa rha h ke ni ? 30 Dec 2018 @ 10:20:36 AM', '', NULL, '2018-12-30 10:30:16', '0000-00-00 00:00:00', 0, 1, 0, 0),
(29, 1, 4, 'Hello SBI,   I am writing this email, as i was charged a fine on my current bill payment. This bill was generated 17-11-2018 for Rs. 23805 and i paid Rs 12811 on  30-11-2018 and due date was 7th Dec 2018, i wasn\'t able to make payment till due date and I made the remaining bill  payment of Rs. 10994 on 10th Dec 2018,   Because of this i was charged a fine of Rs 1460,  due to some financial problem i got late in payment by 3 days and i cleared out the complete bill on 10th Dec 2018, if you can check the statement please check it.  This happened for the first time, you can check my credit card transactions and its history, it has never happened in the past and i assure you that it wont happen in future.   Please remove the fine from my bill, i will be really grateful for this support as i try to pay the bill before date and i also care about my cbill score which impacts due to these issues.   Thank You in advance  Hope to hear from you ', '', NULL, '2018-12-30 10:30:40', '0000-00-00 00:00:00', 0, 1, 0, 0),
(30, 4, 1, 'fdfdf', '', NULL, '2019-01-19 09:40:56', '0000-00-00 00:00:00', 0, 1, 0, 0),
(31, 1, 4, 'fsdjdfsdf', '', NULL, '2019-01-19 09:41:00', '0000-00-00 00:00:00', 0, 1, 0, 0),
(32, 4, 1, 'fdfdlfjsadfj', '', NULL, '2019-01-19 09:41:04', '0000-00-00 00:00:00', 0, 1, 0, 0),
(33, 1, 4, 'fklsafjklsadf', '', NULL, '2019-01-19 09:41:08', '0000-00-00 00:00:00', 0, 1, 0, 0),
(34, 4, 1, 'Hello guys,   Visited the place, the place is in the heart of vijay nagar and near two famous stops of vijay nagar that are vijayshree amd tinkuz.  Well its just like every other burger point like a quick bite place, limited amount of sitting but it has a quiet big menu to choose from in burger, rolls and as well as momos.   well i went to try burgers, so i tried my fav. new york burger, mexican burger and paneer hotdog, well the new york burger was good as it should be. but in mexican burger i found mexican sause too less to be called as mexican burger overall it was good too. Hot dog was the good i was expecting more stuffing as how they described it but expectation vs reality was different though i liked it .   Overall i liked the place, price to quantity ratio is perfect, pocket friendly place, service is self but service is fast, as it should be at a burger place.  overall i will be revisting them for roll and momos and new york burger is recommended.', '', NULL, '2019-01-19 09:41:26', '0000-00-00 00:00:00', 0, 1, 0, 0),
(35, 1, 4, 'Hi guys,   Visited the place so many times, its one of those places in sarafa sinces decades, i used to go their for khichdi when i was a boy and till now i go their for khichdi, it gives a good khichdi.   Unlike other khichdi now a days which are sweet, thry still serve a spicy version of khichdi which tastes perfectly indori, the way people used to eat before.   Overall Recommended. ', '', NULL, '2019-01-19 09:41:36', '0000-00-00 00:00:00', 0, 1, 0, 0),
(36, 4, 1, 'dsfsdfs', '', NULL, '2019-01-19 09:41:53', '0000-00-00 00:00:00', 0, 1, 0, 0),
(37, 1, 4, 'fdsffffdsf', '', NULL, '2019-01-19 09:41:59', '0000-00-00 00:00:00', 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `company_prefix`, `company_code_start`, `logo`, `subscription`, `email_1`, `email_2`, `contact_1`, `contact_2`, `pan_no`, `gstin_no`, `address`, `about_company`, `created_date`, `updated_date`, `status`, `is_deleted`) VALUES
(1, 'furniture company ltd', 'FUR', '0001', 'uploads/images/company/dIoskrF67A-1538378653.jpg', 3, 'j.meenesh@gmail.com', 'j.meenesh@gmail.com', '098765432', '090876543221', '2018-10-01', '2018-10-01', '194-B Clerk Colony Indore M.P', 'Test', '2018-10-01 12:54:59', '2018-10-01 12:56:20', 1, 0),
(2, 'Akshay Software', 'AST', '0001', 'uploads/images/company/q3oYMt7kJ9-1538384500.PNG', 3, 'contact@akshay.com', 'admin@email.com', '1234567890', '1234567890', '2018-10-01', '2018-10-01', 'Mumbai', 'mumbai SAP', '2018-10-01 14:34:18', '2018-10-01 14:34:18', 1, 0),
(3, 'Test Company', 'HOM', '0001', 'assets/images/no.jpg', 4, 'j.meenesh@gmail.com', 'j.meenesh@gmail.com', '123456789', '2345678', '2018-12-31', '2018-12-31', '194-B Clerk Colony Indore M.P', 'test', '2018-12-31 18:54:03', '2018-12-31 18:54:03', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `company_email_smtp`
--

DROP TABLE IF EXISTS `company_email_smtp`;
CREATE TABLE IF NOT EXISTS `company_email_smtp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `host` varchar(200) NOT NULL,
  `port` varchar(200) NOT NULL,
  `from_name` varchar(200) NOT NULL COMMENT 'smtp user name ',
  `from_email` varchar(200) NOT NULL COMMENT 'smtp email account',
  `from_password` varchar(200) NOT NULL COMMENT 'smtp account password',
  `is_configured` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_email_smtp`
--

INSERT INTO `company_email_smtp` (`id`, `company_id`, `host`, `port`, `from_name`, `from_email`, `from_password`, `is_configured`, `status`, `is_deleted`, `created_date`, `updated_date`) VALUES
(1, 1, 'prowebitsolution.com', '25', 'Pro web it solution', 'contact@prowebitsolution.com', 'contact@#123', 0, 1, 0, '2019-01-27 18:24:08', '0000-00-00 00:00:00'),
(2, 2, 'prowebitsolution.com', '25', 'Pro web it solution', 'contact@prowebitsolution.com', 'contact@#123', 0, 1, 0, '2019-01-27 18:24:08', '0000-00-00 00:00:00'),
(3, 3, 'prowebitsolution.com', '25', 'Pro web it solution', 'contact@prowebitsolution.com', 'contact@#123', 0, 1, 0, '2019-01-27 18:24:08', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `company_email_templates`
--

DROP TABLE IF EXISTS `company_email_templates`;
CREATE TABLE IF NOT EXISTS `company_email_templates` (
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_email_templates`
--

INSERT INTO `company_email_templates` (`id`, `company_id`, `template_key`, `subject`, `body`, `status`, `is_deleted`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 1, 'company_employee_registration', 'Company Registration & Access', '<p>Hello User, </p><p>Thank you for registering with us. </p><p>Here is your details to login into {{app_name_short}}.<br></p><p><br></p><p><b>URL -</b> {{base_url}}</p><p><b>Name -</b> {{user_full_name}} <br></p><p><b>User Name -</b> {{user_name}}</p><p><b>Password -</b> {{password}}</p><p><br></p><p><b>Regards & Thanks,</b></p><p><b>{{app_name_full}}</b></p><p><b><br></b></p>', 1, 0, 0, '0000-00-00 00:00:00', 0, '2018-10-20 18:20:03'),
(2, 1, 'password_changed_success', '{{company_name}} Employee Password changed', 'Thank you for registering with us \r\nHere is your new password\r\n\r\nURL - {{base_url}}\r\n\r\nName - {{user_full_name}}\r\nNew Password - {{password}}\r\n\r\nNote : Please delete this mail, after keeping your password in a safe place. \r\n\r\nRegards, \r\n{{company_name}}\r\n', 1, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 1, 'sales_order_generated', '{{company_name}} Sales Order Generated', 'Hello Admin,\r\n\r\nYour employee {{employee_name}} has generated a sales order, \r\n\r\nReview your employees sales order at - \r\n\r\nURL - {{base_url}}\r\n\r\nThanks & Regards, \r\n{{company_name}}\r\n', 1, 0, 0, '2018-10-19 16:00:53', 0, '2018-10-19 16:00:53'),
(4, 2, 'company_employee_registration', 'Company Registration & Access', '<p>Hello User, </p><p>Thank you for registering with us. </p><p>Here is your details to login into {{app_name_short}}.<br></p><p><br></p><p><b>URL -</b> {{base_url}}</p><p><b>Name -</b> {{user_full_name}} <br></p><p><b>User Name -</b> {{user_name}}</p><p><b>Password -</b> {{password}}</p><p><br></p><p><b>Regards,</b></p><p><b>{{app_name_full}}</b></p>', 1, 0, 0, '0000-00-00 00:00:00', 0, '2018-10-20 17:49:51'),
(5, 2, 'password_changed_success', '{{company_name}} Employee Password changed', 'Thank you for registering with us \r\nHere is your new password\r\n\r\nURL - {{base_url}}\r\n\r\nName - {{user_full_name}}\r\nNew Password - {{password}}\r\n\r\nNote : Please delete this mail, after keeping your password in a safe place. \r\n\r\nRegards, \r\n{{company_name}}\r\n', 1, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, 2, 'sales_order_generated', '{{company_name}} Sales Order Generated', 'Hello Admin,\r\n\r\nYour employee {{employee_name}} has generated a sales order, \r\n\r\nReview your employees sales order at - \r\n\r\nURL - {{base_url}}\r\n\r\nThanks & Regards, \r\n{{company_name}}\r\n', 1, 0, 0, '2018-10-19 16:00:53', 0, '2018-10-19 16:00:53'),
(7, 3, 'company_employee_registration', 'Company Registration & Access', 'Thank you for registering with us \r\nHere is your details to login into {{app_name_short}} \r\n\r\nURL - {{base_url}}\r\n\r\nName - {{user_full_name}}\r\nUser Name - {{user_name}}\r\nPassword - {{password}}\r\n\r\nRegards, \r\n{{app_name_full}}\r\n', 1, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, 3, 'password_changed_success', '{{company_name}} Employee Password changed', 'Thank you for registering with us \r\nHere is your new password\r\n\r\nURL - {{base_url}}\r\n\r\nName - {{user_full_name}}\r\nNew Password - {{password}}\r\n\r\nNote : Please delete this mail, after keeping your password in a safe place. \r\n\r\nRegards, \r\n{{company_name}}\r\n', 1, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 3, 'sales_order_generated', '{{company_name}} Sales Order Generated', 'Hello Admin,\r\n\r\nYour employee {{employee_name}} has generated a sales order, \r\n\r\nReview your employees sales order at - \r\n\r\nURL - {{base_url}}\r\n\r\nThanks & Regards, \r\n{{company_name}}\r\n', 1, 0, 0, '2018-10-19 16:00:53', 0, '2018-10-19 16:00:53');

-- --------------------------------------------------------

--
-- Table structure for table `company_urole_permission`
--

DROP TABLE IF EXISTS `company_urole_permission`;
CREATE TABLE IF NOT EXISTS `company_urole_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `value` longtext NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_urole_permission`
--

INSERT INTO `company_urole_permission` (`id`, `company_id`, `user_role_id`, `value`, `status`, `is_deleted`, `created_date`, `updated_date`) VALUES
(1, 1, 1, 'comp_v,comp_a,comp_e,comp_d,user_v,user_a,user_e,user_d,trgt_v,trgt_a,trgt_e,trgt_d,acnt_v,acnt_a,acnt_e,acnt_d,cntct_v,cntct_a,cntct_e,cntct_d,cntct_call,cntct_con2lead,lead_v,lead_a,lead_e,lead_d,lead_call,lead_lead2opp,oprt_v,oprt_call,squtn_v,squtn_a,squtn_e,squtn_d,sordr_v,sordr_a,sordr_e,sordr_d,invitm_v,invitm_a,invitm_e,invitm_d,seritm_v,seritm_a,seritm_e,seritm_d,sercon_v,sercon_a,sercon_e,sercon_d,sercall_v,sercall_a,sercall_e,sercall_d,sdnts_v,sdnts_a,sdnts_e,sdnts_d,sdmtng_v,sdmtng_a,sdmtng_e,sdmtng_d,sdtsk_v,sdtsk_a,sdtsk_e,sdtsk_d,sdcalls_v,sdcalls_a,sdcalls_e,sdcalls_d', 1, 0, '2019-01-26 00:25:46', '2019-01-27 18:02:06'),
(2, 1, 2, 'comp_v,comp_a,comp_e,comp_d,user_v,user_a,user_e,user_d,trgt_v,trgt_a,trgt_e,trgt_d,acnt_v,acnt_a,acnt_e,acnt_d,cntct_v,cntct_a,cntct_e,cntct_d,cntct_call,cntct_con2lead,lead_v,lead_a,lead_e,lead_d,lead_call,lead_lead2opp,oprt_v,oprt_call,squtn_v,squtn_a,squtn_e,squtn_d,sordr_v,sordr_a,sordr_e,sordr_d,invitm_v,invitm_a,invitm_e,invitm_d,seritm_v,seritm_a,seritm_e,seritm_d,sercon_v,sercon_a,sercon_e,sercon_d,sercall_v,sercall_a,sercall_e,sercall_d,sdnts_v,sdnts_a,sdnts_e,sdnts_d,sdmtng_v,sdmtng_a,sdmtng_e,sdmtng_d,sdtsk_v,sdtsk_a,sdtsk_e,sdtsk_d,sdcalls_v,sdcalls_a,sdcalls_e,sdcalls_d', 1, 0, '2019-01-26 00:25:46', '0000-00-00 00:00:00'),
(3, 1, 3, 'comp_v,comp_a,comp_e,comp_d,user_v,user_a,user_e,user_d,trgt_v,trgt_a,trgt_e,trgt_d,acnt_v,acnt_a,acnt_e,acnt_d,cntct_v,cntct_a,cntct_e,cntct_d,cntct_call,cntct_con2lead,lead_v,lead_a,lead_e,lead_d,lead_call,lead_lead2opp,oprt_v,oprt_call,squtn_v,squtn_a,squtn_e,squtn_d,sordr_v,sordr_a,sordr_e,sordr_d,invitm_v,invitm_a,invitm_e,invitm_d,seritm_v,seritm_a,seritm_e,seritm_d,sercon_v,sercon_a,sercon_e,sercon_d,sercall_v,sercall_a,sercall_e,sercall_d,sdnts_v,sdnts_a,sdnts_e,sdnts_d,sdmtng_v,sdmtng_a,sdmtng_e,sdmtng_d,sdtsk_v,sdtsk_a,sdtsk_e,sdtsk_d,sdcalls_v,sdcalls_a,sdcalls_e,sdcalls_d', 1, 0, '2019-01-26 00:25:46', '0000-00-00 00:00:00'),
(4, 1, 4, 'comp_v,comp_a,comp_e,comp_d,user_v,user_a,user_e,user_d,trgt_v,trgt_a,trgt_e,trgt_d,acnt_v,acnt_a,acnt_e,acnt_d,cntct_v,cntct_a,cntct_e,cntct_d,cntct_call,cntct_con2lead,lead_v,lead_a,lead_e,lead_d,lead_call,lead_lead2opp,oprt_v,oprt_call,squtn_v,squtn_a,squtn_e,squtn_d,sordr_v,sordr_a,sordr_e,sordr_d,invitm_v,invitm_a,invitm_e,invitm_d,seritm_v,seritm_a,seritm_e,seritm_d,sercon_v,sercon_a,sercon_e,sercon_d,sercall_v,sercall_a,sercall_e,sercall_d,sdnts_v,sdnts_a,sdnts_e,sdnts_d,sdmtng_v,sdmtng_a,sdmtng_e,sdmtng_d,sdtsk_v,sdtsk_a,sdtsk_e,sdtsk_d,sdcalls_v,sdcalls_a,sdcalls_e,sdcalls_d', 1, 0, '2019-01-26 00:25:46', '0000-00-00 00:00:00'),
(5, 2, 1, 'comp_v,comp_a,comp_e,comp_d,user_v,user_a,user_e,user_d,trgt_v,trgt_a,trgt_e,trgt_d,acnt_v,acnt_a,acnt_e,acnt_d,cntct_v,cntct_a,cntct_e,cntct_d,cntct_call,cntct_con2lead,lead_v,lead_a,lead_e,lead_d,lead_call,lead_lead2opp,oprt_v,oprt_call,squtn_v,squtn_a,squtn_e,squtn_d,sordr_v,sordr_a,sordr_e,sordr_d,invitm_v,invitm_a,invitm_e,invitm_d,seritm_v,seritm_a,seritm_e,seritm_d,sercon_v,sercon_a,sercon_e,sercon_d,sercall_v,sercall_a,sercall_e,sercall_d,sdnts_v,sdnts_a,sdnts_e,sdnts_d,sdmtng_v,sdmtng_a,sdmtng_e,sdmtng_d,sdtsk_v,sdtsk_a,sdtsk_e,sdtsk_d,sdcalls_v,sdcalls_a,sdcalls_e,sdcalls_d', 1, 0, '2019-01-26 00:25:46', '0000-00-00 00:00:00'),
(6, 2, 2, 'comp_v,comp_a,comp_e,comp_d,user_v,user_a,user_e,user_d,trgt_v,trgt_a,trgt_e,trgt_d,acnt_v,acnt_a,acnt_e,acnt_d,cntct_v,cntct_a,cntct_e,cntct_d,cntct_call,cntct_con2lead,lead_v,lead_a,lead_e,lead_d,lead_call,lead_lead2opp,oprt_v,oprt_call,squtn_v,squtn_a,squtn_e,squtn_d,sordr_v,sordr_a,sordr_e,sordr_d,invitm_v,invitm_a,invitm_e,invitm_d,seritm_v,seritm_a,seritm_e,seritm_d,sercon_v,sercon_a,sercon_e,sercon_d,sercall_v,sercall_a,sercall_e,sercall_d,sdnts_v,sdnts_a,sdnts_e,sdnts_d,sdmtng_v,sdmtng_a,sdmtng_e,sdmtng_d,sdtsk_v,sdtsk_a,sdtsk_e,sdtsk_d,sdcalls_v,sdcalls_a,sdcalls_e,sdcalls_d', 1, 0, '2019-01-26 00:25:46', '0000-00-00 00:00:00'),
(7, 2, 3, 'comp_v,comp_a,comp_e,comp_d,user_v,user_a,user_e,user_d,trgt_v,trgt_a,trgt_e,trgt_d,acnt_v,acnt_a,acnt_e,acnt_d,cntct_v,cntct_a,cntct_e,cntct_d,cntct_call,cntct_con2lead,lead_v,lead_a,lead_e,lead_d,lead_call,lead_lead2opp,oprt_v,oprt_call,squtn_v,squtn_a,squtn_e,squtn_d,sordr_v,sordr_a,sordr_e,sordr_d,invitm_v,invitm_a,invitm_e,invitm_d,seritm_v,seritm_a,seritm_e,seritm_d,sercon_v,sercon_a,sercon_e,sercon_d,sercall_v,sercall_a,sercall_e,sercall_d,sdnts_v,sdnts_a,sdnts_e,sdnts_d,sdmtng_v,sdmtng_a,sdmtng_e,sdmtng_d,sdtsk_v,sdtsk_a,sdtsk_e,sdtsk_d,sdcalls_v,sdcalls_a,sdcalls_e,sdcalls_d', 1, 0, '2019-01-26 00:25:46', '0000-00-00 00:00:00'),
(8, 2, 4, 'comp_v,comp_a,comp_e,comp_d,user_v,user_a,user_e,user_d,trgt_v,trgt_a,trgt_e,trgt_d,acnt_v,acnt_a,acnt_e,acnt_d,cntct_v,cntct_a,cntct_e,cntct_d,cntct_call,cntct_con2lead,lead_v,lead_a,lead_e,lead_d,lead_call,lead_lead2opp,oprt_v,oprt_call,squtn_v,squtn_a,squtn_e,squtn_d,sordr_v,sordr_a,sordr_e,sordr_d,invitm_v,invitm_a,invitm_e,invitm_d,seritm_v,seritm_a,seritm_e,seritm_d,sercon_v,sercon_a,sercon_e,sercon_d,sercall_v,sercall_a,sercall_e,sercall_d,sdnts_v,sdnts_a,sdnts_e,sdnts_d,sdmtng_v,sdmtng_a,sdmtng_e,sdmtng_d,sdtsk_v,sdtsk_a,sdtsk_e,sdtsk_d,sdcalls_v,sdcalls_a,sdcalls_e,sdcalls_d', 1, 0, '2019-01-26 00:25:46', '0000-00-00 00:00:00'),
(9, 3, 1, 'comp_v,comp_a,comp_e,comp_d,user_v,user_a,user_e,user_d,trgt_v,trgt_a,trgt_e,trgt_d,acnt_v,acnt_a,acnt_e,acnt_d,cntct_v,cntct_a,cntct_e,cntct_d,cntct_call,cntct_con2lead,lead_v,lead_a,lead_e,lead_d,lead_call,lead_lead2opp,oprt_v,oprt_call,squtn_v,squtn_a,squtn_e,squtn_d,sordr_v,sordr_a,sordr_e,sordr_d,invitm_v,invitm_a,invitm_e,invitm_d,seritm_v,seritm_a,seritm_e,seritm_d,sercon_v,sercon_a,sercon_e,sercon_d,sercall_v,sercall_a,sercall_e,sercall_d,sdnts_v,sdnts_a,sdnts_e,sdnts_d,sdmtng_v,sdmtng_a,sdmtng_e,sdmtng_d,sdtsk_v,sdtsk_a,sdtsk_e,sdtsk_d,sdcalls_v,sdcalls_a,sdcalls_e,sdcalls_d', 1, 0, '2019-01-26 00:25:46', '0000-00-00 00:00:00'),
(10, 3, 2, 'comp_v,comp_a,comp_e,comp_d,user_v,user_a,user_e,user_d,trgt_v,trgt_a,trgt_e,trgt_d,acnt_v,acnt_a,acnt_e,acnt_d,cntct_v,cntct_a,cntct_e,cntct_d,cntct_call,cntct_con2lead,lead_v,lead_a,lead_e,lead_d,lead_call,lead_lead2opp,oprt_v,oprt_call,squtn_v,squtn_a,squtn_e,squtn_d,sordr_v,sordr_a,sordr_e,sordr_d,invitm_v,invitm_a,invitm_e,invitm_d,seritm_v,seritm_a,seritm_e,seritm_d,sercon_v,sercon_a,sercon_e,sercon_d,sercall_v,sercall_a,sercall_e,sercall_d,sdnts_v,sdnts_a,sdnts_e,sdnts_d,sdmtng_v,sdmtng_a,sdmtng_e,sdmtng_d,sdtsk_v,sdtsk_a,sdtsk_e,sdtsk_d,sdcalls_v,sdcalls_a,sdcalls_e,sdcalls_d', 1, 0, '2019-01-26 00:25:46', '0000-00-00 00:00:00'),
(11, 3, 3, 'comp_v,comp_a,comp_e,comp_d,user_v,user_a,user_e,user_d,trgt_v,trgt_a,trgt_e,trgt_d,acnt_v,acnt_a,acnt_e,acnt_d,cntct_v,cntct_a,cntct_e,cntct_d,cntct_call,cntct_con2lead,lead_v,lead_a,lead_e,lead_d,lead_call,lead_lead2opp,oprt_v,oprt_call,squtn_v,squtn_a,squtn_e,squtn_d,sordr_v,sordr_a,sordr_e,sordr_d,invitm_v,invitm_a,invitm_e,invitm_d,seritm_v,seritm_a,seritm_e,seritm_d,sercon_v,sercon_a,sercon_e,sercon_d,sercall_v,sercall_a,sercall_e,sercall_d,sdnts_v,sdnts_a,sdnts_e,sdnts_d,sdmtng_v,sdmtng_a,sdmtng_e,sdmtng_d,sdtsk_v,sdtsk_a,sdtsk_e,sdtsk_d,sdcalls_v,sdcalls_a,sdcalls_e,sdcalls_d', 1, 0, '2019-01-26 00:25:47', '0000-00-00 00:00:00'),
(12, 3, 4, 'comp_v,comp_a,comp_e,comp_d,user_v,user_a,user_e,user_d,trgt_v,trgt_a,trgt_e,trgt_d,acnt_v,acnt_a,acnt_e,acnt_d,cntct_v,cntct_a,cntct_e,cntct_d,cntct_call,cntct_con2lead,lead_v,lead_a,lead_e,lead_d,lead_call,lead_lead2opp,oprt_v,oprt_call,squtn_v,squtn_a,squtn_e,squtn_d,sordr_v,sordr_a,sordr_e,sordr_d,invitm_v,invitm_a,invitm_e,invitm_d,seritm_v,seritm_a,seritm_e,seritm_d,sercon_v,sercon_a,sercon_e,sercon_d,sercall_v,sercall_a,sercall_e,sercall_d,sdnts_v,sdnts_a,sdnts_e,sdnts_d,sdmtng_v,sdmtng_a,sdmtng_e,sdmtng_d,sdtsk_v,sdtsk_a,sdtsk_e,sdtsk_d,sdcalls_v,sdcalls_a,sdcalls_e,sdcalls_d', 1, 0, '2019-01-26 00:25:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `contact_lead`
--

DROP TABLE IF EXISTS `contact_lead`;
CREATE TABLE IF NOT EXISTS `contact_lead` (
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
  `pan_no` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_lead`
--

INSERT INTO `contact_lead` (`id`, `company_id`, `account_id`, `owner_id`, `is_type`, `first_name`, `last_name`, `mobile`, `other_contact`, `email_1`, `email_2`, `other_email`, `fax`, `title`, `department`, `website_url`, `account_name`, `primary_address`, `primary_city`, `primary_state`, `primary_pincode`, `primary_country`, `secondary_address`, `secondary_city`, `secondary_state`, `secondary_pincode`, `secondary_country`, `description`, `assign_date`, `opp_currency`, `opp_close_date`, `opp_amount`, `opp_type`, `opp_sales_stage`, `opp_probability`, `opp_lead_source`, `opp_next_step`, `opp_description`, `convert_oppr_date`, `convert_lead_date`, `pan_no`, `created_date`, `created_by`, `status`, `updated_date`, `updated_by`, `is_deleted`) VALUES
(1, 1, 1, 1, 0, 'Manish', 'Carpenter', '9754545409', '', 'maniscrpntr2@gmail.com', '', '', '', '', '', '', '', '10/4, pardesipura', 'Indore', 'MP', '452001', 'India', '10/4, pardesipura', 'Indore', 'MP', '', 'India', 'this is first account 123', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2018-09-30 18:27:08', 1, 1, '2018-09-30 21:00:34', 1, 0),
(2, 1, 1, 1, 0, 'Meenesh ', 'Jain', '9993755651', '0731-215935', 'j.meenesh@gmail.com', '', 'other@gmail.com', '12345', 'title text', 'IT', '12345', '', '192 B, clerk colony ', 'Indore', 'MP', '452001', 'India', '192 B, clerk colony ', 'Indore', 'MP', '452001', 'India', 'test account second', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2018-09-30 18:55:55', 1, 1, '2018-09-30 21:00:34', 1, 0),
(3, 1, 1, 1, 0, 'Meenesh', 'Jain', '09993755651', '', 'j.meenesh@gmail.com', '', '', '', 'title', 'IT', 'prowebitsolution.com', '', 'indore', 'indore', 'mp', '452001', 'India', '', 'indore', 'uttar p radesh', '452010', 'India', 'Test  123', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2018-10-01 00:49:56', 5, 1, '2018-10-01 01:00:57', 5, 0),
(4, 1, 1, 1, 0, 'Meenesh', 'Jain', '09993755651', '123456', 'j.meenesh@gmail.com', '', 'j.meenesh@gmail.com', '123456789', 'Test', 'IT', 'www.google.com', '', '194-B Clerk Colony Indore M.P', 'Indore', 'MADHYA PRADESH', '452010', 'India', '194-B Clerk Colony Indore M.P', 'Indore', 'MADHYA PRADESH', '452010', 'India', 'Test', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2018-10-01 13:49:41', 1, 1, '0000-00-00 00:00:00', 0, 0),
(5, 2, 2, 2, 0, 'contact', 'one', '1234567890', '1234567890', 'admin1@hdfc.com', '', 'admin2@hdfc.com', '1233454566', 'bank', 'sales dept ', 'www.hdfc.com', '', 'hdfc indore', 'indore', 'MP', '452001', 'india', 'hdfc indore', 'indore', 'MP', '452001', 'india', 'test', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2018-10-01 14:44:45', 2, 1, '2018-10-01 14:44:59', 2, 0),
(6, 1, 1, 4, 2, 'Meenesh', 'Jain', '88877722211', 'test', '8888@gmail.com', '', 'test@gmail.com', '12345', 'test', 'test', 'www.website.com', '', 'sdasdasd', 'asdasd', 'asdasdasdas', '134567', 'india', '', '', '', '', '', 'description', '2019-05-20 14:40:23', 0, '2019-05-20 00:00:00', 1000, 1, 1, 5, 2, 'killed myself', '', '2019-05-20 19:49:20', '2019-05-20 14:40:23', '', '2019-05-20 14:06:05', 1, 1, '2019-05-20 19:49:20', 1, 0),
(7, 1, 3, 8, 1, 'icicic', 'one', '13133131313', 'icicic account', 'icicic@icicic.com', '', 'iciciccc@account.com', 'icicici', 'icicic', 'icicic finance', 'htttp://www.icicic.com', '', '194-B Clerk Colony Indore M.P', 'Indore', 'MADHYA PRADESH', '452001', 'India', '194-B Clerk Colony Indore M.P', 'Indore', 'MADHYA PRADESH', '452001', 'India', 'test', '2019-05-20 20:03:08', 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 0, '', '', '0000-00-00 00:00:00', '2019-05-20 20:03:08', 'icici0023911xxtt', '2019-05-20 16:21:18', 1, 1, '2019-05-20 16:22:02', 1, 0),
(8, 1, 7, 1, 1, 'test', 'tet', 't123456789', '0987654321', 'j.meenesh222@gmail.com', '', 'j.meenesh222@gmail.com', '125678', 'test', 'test', 'test.com', '', 'test', 'test', 'test', 'test', 'test', '', '', '', '', '', 'test', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2019-05-20 20:05:04', 1, 1, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

DROP TABLE IF EXISTS `email_template`;
CREATE TABLE IF NOT EXISTS `email_template` (
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`id`, `template_key`, `subject`, `body`, `is_global`, `status`, `is_deleted`, `created_date`, `updated_date`) VALUES
(1, 'new_company_registration', 'New Company Registration ', 'Thank you for registering with us \r\nHere is your details to login into {{app_name_short}} \r\n\r\nURL - {{base_url}}\r\n\r\nName - {{user_full_name}}\r\nUser Name - {{user_name}}\r\nPassword - {{password}}\r\n\r\nRegards, \r\n{{app_name_full}}\r\n', 1, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'company_employee_registration', 'Company Registration & Access', 'Thank you for registering with us \r\nHere is your details to login into {{app_name_short}} \r\n\r\nURL - {{base_url}}\r\n\r\nName - {{user_full_name}}\r\nUser Name - {{user_name}}\r\nPassword - {{password}}\r\n\r\nRegards, \r\n{{app_name_full}}\r\n', 0, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'password_changed_success', '{{company_name}} Employee Password changed', 'Thank you for registering with us \r\nHere is your new password\r\n\r\nURL - {{base_url}}\r\n\r\nName - {{user_full_name}}\r\nNew Password - {{password}}\r\n\r\nNote : Please delete this mail, after keeping your password in a safe place. \r\n\r\nRegards, \r\n{{company_name}}\r\n', 0, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'sales_order_generated', '{{company_name}} Sales Order Generated', 'Hello Admin,\r\n\r\nYour employee {{employee_name}} has generated a sales order, \r\n\r\nReview your employees sales order at - \r\n\r\nURL - {{base_url}}\r\n\r\nThanks & Regards, \r\n{{company_name}}\r\n', 0, 1, 0, '2018-10-19 16:00:53', '2018-10-19 16:00:53');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_form`
--

DROP TABLE IF EXISTS `enquiry_form`;
CREATE TABLE IF NOT EXISTS `enquiry_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `organization_short_name` varchar(50) NOT NULL,
  `account_manager` varchar(100) NOT NULL,
  `initiated_by` varchar(100) NOT NULL,
  `address` varchar(250) NOT NULL,
  `state` int(11) NOT NULL,
  `web_address` varchar(100) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `order_expected` date NOT NULL,
  `enquiry_items` longtext NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `company_id`, `logo`, `code`, `name`, `description`, `group_type`, `type`, `unit`, `is_gst`, `gst_tax_rate`, `status`, `is_deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 1, 'uploads/images/items/umfq71OYmf-1538382222.jpg', '101', 'computer table', 'computer table computer table computer table', 'SERVICE', 'SERIAL', 'kg', 1, 18, 1, 0, '2018-10-01 13:54:48', 0, '0000-00-00 00:00:00', 0),
(2, 2, 'uploads/images/items/8d8XFr0aRv-1538385416.jpeg', '10001', 'Software Services', 'CRM setup and installation', 'SERVICE', 'SERIAL', 'kg', 1, 18, 1, 0, '2018-10-01 14:46:37', 0, '2018-10-01 14:47:13', 0),
(3, 1, 'assets/images/no.jpg', '123456', 'meeting', 'Test', 'SERVICE', 'SERIAL', 'kg', 1, 18, 1, 0, '2018-10-21 19:32:28', 0, '0000-00-00 00:00:00', 0),
(4, 1, 'assets/images/no.jpg', '2147483647', 'BOX BOX', 'BOX carboard ', 'INVENTORY', 'SERIAL', 'kg', 1, 28, 1, 0, '2018-10-21 19:36:43', 0, '2019-05-20 01:02:06', 0),
(5, 1, 'assets/images/no.jpg', '10001', '10001', '123', 'INVENTORY', 'SERIAL', 'kg', 1, 1234, 1, 0, '2019-05-20 01:00:05', 0, '0000-00-00 00:00:00', 0),
(6, 1, 'assets/images/no.jpg', '1234565', '123456', 'test', 'INVENTORY', 'SERIAL', 'kg', 1, 12, 1, 0, '2019-05-20 01:01:55', 0, '0000-00-00 00:00:00', 0),
(13, 2, '', 'test0101', 'Test 0101', 'Test 0101', 'SERVICE', 'SERIAL', 'kg', 0, 18, 1, 0, '2019-05-22 23:31:54', 0, '2019-05-22 23:31:54', 0),
(14, 2, '', 'ind001', 'Ind 1001', 'Ind 1001', 'INVENTORY', 'BATCH', 'kg', 0, 18, 1, 0, '2019-05-22 23:31:54', 0, '2019-05-22 23:31:54', 0),
(15, 2, '', 'res009', 'Res 090', 'Res 090', 'INVENTORY', 'NONE', 'kg', 0, 18, 1, 0, '2019-05-22 23:31:54', 0, '2019-05-22 23:31:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `items_price_list`
--

DROP TABLE IF EXISTS `items_price_list`;
CREATE TABLE IF NOT EXISTS `items_price_list` (
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items_price_list`
--

INSERT INTO `items_price_list` (`id`, `company_id`, `item_id`, `price1`, `price2`, `price3`, `price4`, `price5`, `status`, `is_deleted`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 1, 1, 12000, 18000, 20000, 0, 0, 1, 0, 0, '2018-10-01 13:54:48', 0, '0000-00-00 00:00:00'),
(2, 2, 2, 25000, 50000, 2000000, 0, 0, 1, 0, 0, '2018-10-01 14:46:37', 0, '2018-10-01 14:47:13'),
(3, 1, 3, 20000, 0, 0, 0, 0, 1, 0, 0, '2018-10-21 19:32:28', 0, '0000-00-00 00:00:00'),
(4, 1, 4, 134, 0, 0, 0, 0, 1, 0, 0, '2018-10-21 19:36:43', 0, '2019-05-20 01:02:06'),
(5, 1, 5, 12345678, 0, 0, 0, 0, 1, 0, 0, '2019-05-20 01:00:05', 0, '0000-00-00 00:00:00'),
(6, 1, 6, 6532, 0, 0, 0, 0, 1, 0, 0, '2019-05-20 01:01:55', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `item_service_call`
--

DROP TABLE IF EXISTS `item_service_call`;
CREATE TABLE IF NOT EXISTS `item_service_call` (
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_service_call`
--

INSERT INTO `item_service_call` (`id`, `company_id`, `item_service_contract_id`, `item_service_contract_serial_number`, `account_id`, `account_name`, `contact_person_id`, `contact_person_name`, `contact_person_number`, `sales_employee_id`, `sales_employee`, `start_date`, `end_date`, `remark`, `item_id`, `item_code`, `item_name`, `item_group`, `call_status`, `priority`, `planned_call_date`, `tentative_call_date`, `approved_call_date`, `rejected_call_date`, `subject`, `description`, `problem_origin`, `problem_type`, `problem_subtype`, `call_type`, `technical`, `technical_type`, `technician`, `given_by`, `given_to`, `job_description`, `status`, `is_deleted`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 1, 0, '0', 1, 'Meenesh Jain', 1, 'Manish Carpenter', '9754545409', 1, 'Meenesh Jain', '2018-11-05', '2018-11-15', '0', 4, '', 'BOX', '', 'approved', 'low', '2018-11-05', '0000-00-00', '0000-00-00', '2018-11-13', 'Mobile Damage', 'Broken Screen', 'software', '1', '2', '4', '', '', 'Tech Savy', 'Meenesh', 'Ashish', 'Test', 1, 0, 1, '2018-11-04 18:05:54', 1, '2018-11-04 23:58:54'),
(2, 1, 3, 'SER-1211123', 1, 'Meenesh Jain', 1, 'Manish Carpenter', '9754545409', 1, 'Meenesh Jain', '2018-11-04', '2018-11-04', '', 2, '', 'Software Services', '', 'planned', 'high', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'MObile hardware ', 'Mobile Mother board change', 'hardware', '2', '4', '3', '', '', 'Meenesh', 'Admin', 'RM', 'Fix related problem', 1, 0, 1, '2018-11-05 00:00:12', 1, '2018-11-05 22:37:59'),
(3, 1, 3, 'SER-1211123', 1, 'Meenesh Jain', 1, 'Manish Carpenter', '9754545409', 1, 'Meenesh Jain', '2018-11-04', '2018-11-04', 'Updated with remark', 2, '', 'Software Services', '', 'planned', 'medium', '2018-11-14', '0000-00-00', '0000-00-00', '0000-00-00', 'Test', 'Desc', 'software', '1', '2', '2', '', '', 'tech ', 'Meenesh', 'Ashish', 'SWB work ', 1, 0, 1, '2018-11-05 22:31:44', 1, '2018-11-05 22:37:47'),
(4, 1, 3, 'SER-1211123', 1, 'Meenesh Jain', 1, 'Manish Carpenter', '9754545409', 1, 'Meenesh Jain', '2018-11-04', '2018-11-04', 'Updated with remark', 2, '', 'Software Services', '', 'planned', 'low', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '', 'software', '1', '', '', '', '', '', '', '', '', 1, 0, 1, '2019-05-19 16:13:59', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `item_service_contract`
--

DROP TABLE IF EXISTS `item_service_contract`;
CREATE TABLE IF NOT EXISTS `item_service_contract` (
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_service_contract`
--

INSERT INTO `item_service_contract` (`id`, `company_id`, `account_id`, `account_name`, `contact_person_id`, `contact_person_name`, `contact_person_number`, `sales_employee_id`, `sales_employee`, `start_date`, `end_date`, `response_duration_type`, `response_time`, `resolution_duration_type`, `resolution_time`, `stage`, `serial_number`, `item_id`, `item_code`, `item_name`, `remark`, `free_services`, `status`, `is_deleted`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 1, 2, 'HDFC', 5, 'contact one', '1234567890', 1, 'Meenesh Jain', '2018-11-03', '2018-11-04', 'hours', '5', 'days', '4', 'approved', 'SER-121111', 2, '', 'Software Services', 'Update with remark ', 3, 0, 1, 0, '0000-00-00 00:00:00', 1, '2018-11-04 02:34:26'),
(2, 1, 2, 'HDFC', 5, 'contact one', '1234567890', 1, 'Meenesh Jain', '2018-11-03', '2018-11-03', 'hours', '2', 'days', '2', 'draft', 'SER-121111', 1, '', 'computer table', '', 3, 1, 0, 0, '0000-00-00 00:00:00', 1, '2018-11-04 03:06:58'),
(3, 1, 1, 'Meenesh Jain', 1, 'Manish Carpenter', '9754545409', 1, 'Meenesh Jain', '2018-11-04', '2018-11-04', 'hours', '2222', 'hours', '2222', 'draft', 'SER-1211123', 2, '', 'Software Services', 'Updated with remark', 0, 1, 0, 1, '2018-11-04 02:42:02', 1, '2018-11-04 02:42:34'),
(4, 1, 1, 'Meenesh Jain', 1, 'Manish Carpenter', '9754545409', 1, 'Meenesh Jain', '2018-11-04', '2018-11-04', 'hours', '1', 'hours', '7', 'approved', 'SER-Man-123455', 3, '', 'meeting', '', 3, 1, 0, 1, '2018-11-04 03:10:26', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

DROP TABLE IF EXISTS `meeting`;
CREATE TABLE IF NOT EXISTS `meeting` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`id`, `company_id`, `subject`, `description`, `start_datetime`, `end_datetime`, `user_ids`, `status_type`, `created_date`, `created_by`, `updated_date`, `updated_by`, `alert_before_datetime`, `status`, `is_deleted`) VALUES
(1, 0, 'demo 2nd 1 month comploetion', 'demo 2nd 1 month comploetion', '2018-10-01 13:55:00', '2018-10-01 15:55:00', '1,2,3', 'PLANED', '2018-10-01 12:51:17', 1, '2018-10-01 12:51:17', 0, '2018-10-01 13:05:00', 1, 0),
(2, 0, 'meeting for demo on 1st oct', 'meeting for demo on 1st oct', '2018-10-01 14:20:00', '2018-10-01 15:55:00', '1,2,3', 'PLANED', '2018-10-01 14:29:18', 1, '2018-10-01 14:29:18', 0, '2018-10-01 13:20:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `company_id`, `user_id`, `related_to`, `subject`, `message`, `color`, `status`, `is_deleted`, `created_date`, `updated_date`) VALUES
(2, 0, 1, 0, 'New notes 2 ', 'New notes 12 ', 'm--bg-black', 0, 0, '2018-10-01 14:28:14', '2018-10-01 14:28:27'),
(3, 1, 1, 0, 'Test notes 3', 'Test notes 3 Test notes 3 Test notes 3 Test notes 3 Test notes 3 Test notes 3 Test notes 3 Test notes 3 Test notes 3 Test notes 3 ', 'm--bg-primary', 0, 0, '2018-10-14 14:09:29', '2018-11-12 23:57:43');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `related_id` int(11) NOT NULL,
  `type` enum('MEETING','CHAT','ACCOUNT','CONTACT','LEAD','OPPORTUNITY','TARGET','ITEM') NOT NULL,
  `title` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_for` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `is_read` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

DROP TABLE IF EXISTS `sales_order`;
CREATE TABLE IF NOT EXISTS `sales_order` (
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
  `pay_terms` text CHARACTER SET utf8 NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`id`, `type`, `company_id`, `sales_quote_ref_id`, `revision_id`, `account_id`, `account_name`, `contact_person_id`, `contact_person_name`, `contact_person_number`, `sales_employee_id`, `sales_employee`, `doc_no`, `doc_date`, `delivery_date`, `valid_till`, `remarks`, `pan_card_no`, `pay_terms`, `delivery_address`, `gst_no`, `total_amount`, `other_charges`, `total_tax`, `discount`, `actual_total`, `stages`, `cancel_reason`, `revision_number`, `status`, `is_deleted`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'QUOTATION', 1, 0, '', 1, 'Meenesh Jain', 4, 'Meenesh Jain', '09993755651', 0, 'Meenesh Jain', 'DOC0020180001', '2018-10-01', '2018-10-01', '2018-10-01', 'COD ', '', 'COD  ', 'Test Delivery address', 'gst2002', '28257.87', '20000', '5', '5', '46794.98', 'approved', '', '0', 1, 0, 0, '2018-10-01 13:58:12', 1, '2019-05-20 18:02:26'),
(2, 'QUOTATION', 2, 0, '', 2, 'HDFC', 5, 'contact one', '1234567890', 0, 'user1 user 1', 'DOC0020180001', '2018-10-01', '2018-10-01', '2018-10-01', 'urgent needed', 'pan123', 'only cash', 'Plot no 1, Scheme no 78 Vijay nagar', 'gst123', '216589.00', '2000', '12', '10', '220337.71', 'draft', '', '', 1, 0, 0, '2018-10-01 14:49:54', 0, '2018-10-01 14:50:19'),
(3, 'ORDER', 1, 0, '', 1, 'Meenesh Jain', 1, 'Manish Carpenter', '9754545409', 0, 'Meenesh Jain', 'DOC10020180002', '2018-10-10', '2018-10-10', '2018-10-10', 'Test ', '', 'Test', '194-B Clerk Colony Indore M.P', 'GST52000', '38232.00', '', '', '', '38232.00', 'negotiation', '', '2', 1, 0, 0, '2018-10-10 23:08:14', 1, '2019-05-20 17:43:49'),
(4, 'ORDER', 2, 0, '', 0, 'HDFC', 5, 'contact one', '1234567890', 0, 'user1 user 1', 'DOC0020180001', '2018-10-01', '2018-10-01', '2018-10-01', 'urgent needed', '', 'only cash', 'Plot no 1, Scheme no 78 Vijay nagar', 'gst123', '43660.00', '0', '0', '0', '43660.00', 'draft', '', '2', 0, 1, 0, '2018-10-11 23:27:46', 1, '2019-05-20 18:18:43'),
(5, 'ORDER', 1, 1, '', 1, 'Meenesh Jain', 4, 'Meenesh Jain', '09993755651', 0, 'Meenesh Jain', 'DOC0020180001', '2018-10-01', '2018-10-01', '2018-10-01', 'urgent ', '', 'COD ', 'Test Delivery address', 'gst2002', '67260.00', '20000', '5', '5', '87041.85', 'close', '', '0', 1, 0, 0, '2018-10-11 23:49:15', 1, '2019-05-20 18:19:01'),
(6, 'QUOTATION', 1, 0, '', 1, 'Meenesh Jain', 1, 'Manish Carpenter', '9754545409', 1, 'Meenesh Jain', 'DOC10020180005', '2018-10-24', '2018-10-24', '2018-10-24', '', 'tt222222', '', 'Test', 't1234', '57348.00', '1245', '4', '4', '58499.25', 'draft', '', '0', 1, 0, 1, '2018-10-24 22:52:22', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_details`
--

DROP TABLE IF EXISTS `sales_order_details`;
CREATE TABLE IF NOT EXISTS `sales_order_details` (
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_order_details`
--

INSERT INTO `sales_order_details` (`id`, `company_id`, `sales_order_id`, `item_id`, `item_code`, `item_name`, `quantity`, `price`, `discount`, `after_discount`, `tax_code`, `tax_amount`, `total`, `delivery_date`, `remark`, `status`, `is_deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 1, 1, 1, '101', 'computer table', 2, 12000, '2', '', '', '18', '27753.60', '0000-00-00 00:00:00', '', 1, 0, '2018-10-01 13:58:12', 0, '2019-05-20 18:02:26', 1),
(2, 2, 2, 2, '10001', 'Software Services', 6, 12000, '10', '', '', '18', '76464.00', '0000-00-00 00:00:00', 'Test', 1, 0, '2018-10-01 14:49:54', 0, '2018-10-01 14:50:19', 0),
(3, 2, 2, 1, '101', 'computer table', 5, 25000, '5', '', '', '18', '140125.00', '0000-00-00 00:00:00', 'quick delivery by air ', 1, 0, '2018-10-01 14:49:54', 0, '2018-10-01 14:50:19', 0),
(4, 1, 3, 1, '101', 'computer table', 2, 18000, '10', '', '', '18', '38232.00', '0000-00-00 00:00:00', '', 1, 0, '2018-10-10 23:08:14', 0, '2019-05-20 17:43:49', 1),
(5, 1, 4, 3, '123456', 'meeting', 1, 20000, '10', '', '', '18', '21240.00', '0000-00-00 00:00:00', 'Test', 0, 1, '2018-10-11 23:27:46', 0, '2019-05-20 18:18:43', 1),
(6, 1, 4, 1, '101', 'computer table', 1, 20000, '5', '', '', '18', '22420.00', '0000-00-00 00:00:00', 'quick delivery by air ', 0, 1, '2018-10-11 23:27:46', 0, '2019-05-20 18:18:43', 1),
(7, 1, 5, 1, '101', 'computer table', 5, 12000, '5', '', '', '18', '67260.00', '0000-00-00 00:00:00', '', 1, 0, '2018-10-11 23:49:15', 0, '2019-05-20 18:19:01', 1),
(8, 1, 6, 1, '101', 'computer table', 3, 18000, '10', '', '', '18', '57348.00', '0000-00-00 00:00:00', '', 1, 0, '2018-10-24 22:52:22', 1, '0000-00-00 00:00:00', 0),
(9, 1, 1, 4, '2147483647', 'BOX BOX', 3, 134, '2', '', '', '28', '504.27', '0000-00-00 00:00:00', '', 1, 0, '2019-05-20 17:49:01', 0, '2019-05-20 18:02:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_revisions`
--

DROP TABLE IF EXISTS `sales_order_revisions`;
CREATE TABLE IF NOT EXISTS `sales_order_revisions` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_order_revisions`
--

INSERT INTO `sales_order_revisions` (`id`, `sales_order_id`, `revision_no`, `revision_amount`, `status`, `is_deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 3, 1, 14160, 1, 0, '2018-10-10 23:59:56', 0, '0000-00-00 00:00:00', 0),
(2, 3, 2, 14160, 1, 0, '2018-10-11 00:19:36', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales_stages`
--

DROP TABLE IF EXISTS `sales_stages`;
CREATE TABLE IF NOT EXISTS `sales_stages` (
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_stages`
--

INSERT INTO `sales_stages` (`id`, `name`, `description`, `probability`, `status`, `is_deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'Only Inquiry', '', 5, 1, 0, '2018-08-24 22:38:19', 0, '2018-08-24 22:38:19', 0),
(2, 'Prospecting', '', 10, 1, 0, '2018-08-24 22:38:19', 0, '2018-08-24 22:38:19', 0),
(3, 'Qualification', '', 20, 1, 0, '2018-08-24 22:38:19', 0, '2018-08-24 22:38:19', 0),
(4, 'Need Analysis', '', 10, 1, 0, '2018-08-24 22:38:19', 0, '2018-08-24 22:38:19', 0),
(5, 'Value Proposition', '', 5, 1, 0, '2018-08-24 22:38:19', 0, '2018-08-24 22:38:19', 0),
(6, 'Perception Analysis', '', 10, 1, 0, '2018-08-24 22:38:19', 0, '2018-08-24 22:38:19', 0),
(7, 'On Hold', '', 25, 1, 0, '2018-08-24 22:38:19', 0, '2018-08-24 22:38:19', 0),
(8, 'Closed Won', '', 10, 1, 0, '2018-08-24 22:38:19', 0, '2018-08-24 22:38:19', 0),
(9, 'Closed Lost', '', 13, 1, 0, '2018-08-24 22:38:19', 0, '2018-08-24 22:38:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `country_id`, `name`, `status`) VALUES
(1, 1, 'ANDHRA PRADESH', 1),
(2, 1, 'ASSAM', 1),
(3, 1, 'ARUNACHAL PRADESH', 1),
(4, 1, 'BIHAR', 1),
(5, 1, 'GUJRAT', 1),
(6, 1, 'HARYANA', 1),
(7, 1, 'HIMACHAL PRADESH', 1),
(8, 1, 'JAMMU & KASHMIR', 1),
(9, 1, 'KARNATAKA', 1),
(10, 1, 'KERALA', 1),
(11, 1, 'MADHYA PRADESH', 1),
(12, 1, 'MAHARASHTRA', 1),
(13, 1, 'MANIPUR', 1),
(14, 1, 'MEGHALAYA', 1),
(15, 1, 'MIZORAM', 1),
(16, 1, 'NAGALAND', 1),
(17, 1, 'ORISSA', 1),
(18, 1, 'PUNJAB', 1),
(19, 1, 'RAJASTHAN', 1),
(20, 1, 'SIKKIM', 1),
(21, 1, 'TAMIL NADU', 1),
(22, 1, 'TRIPURA', 1),
(23, 1, 'UTTAR PRADESH', 1),
(24, 1, 'WEST BENGAL', 1),
(25, 1, 'DELHI', 1),
(26, 1, 'GOA', 1),
(27, 1, 'PONDICHERY', 1),
(28, 1, 'LAKSHDWEEP', 1),
(29, 1, 'DAMAN & DIU', 1),
(30, 1, 'DADRA & NAGAR', 1),
(31, 1, 'CHANDIGARH', 1),
(32, 1, 'ANDAMAN & NICOBAR', 1),
(33, 1, 'UTTARANCHAL', 1),
(34, 1, 'JHARKHAND', 1),
(35, 1, 'CHATTISGARH', 1);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4565 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `state_name`, `created_at`, `created_by`) VALUES
(1484, 105, 'Andaman and Nicobar Islands', 1399700193, 14),
(1485, 105, 'Andhra Pradesh', 1399700193, 14),
(1486, 105, 'Arunachal Pradesh', 1399700193, 14),
(1487, 105, 'Assam', 1399700193, 14),
(1488, 105, 'Bihar', 1399700193, 14),
(1489, 105, 'Chandigarh', 1399700193, 14),
(1490, 105, 'Chhattisgarh', 1399700193, 14),
(1491, 105, 'Dadra and Nagar Haveli', 1399700193, 14),
(1492, 105, 'Daman and Diu', 1399700193, 14),
(1493, 105, 'Delhi', 1399700193, 14),
(1494, 105, 'Goa', 1399700193, 14),
(1495, 105, 'Gujarat', 1399700193, 14),
(1496, 105, 'Haryana', 1399700193, 14),
(1497, 105, 'Himachal Pradesh', 1399700193, 14),
(1498, 105, 'Jammu and Kashmir', 1399700193, 14),
(1499, 105, 'Jharkhand', 1399700193, 14),
(1500, 105, 'Karnataka', 1399700193, 14),
(1501, 105, 'Kerala', 1399700193, 14),
(1502, 105, 'Lakshadweep', 1399700193, 14),
(1503, 105, 'Madhya Pradesh', 1399700194, 14),
(1504, 105, 'Maharashtra', 1399700194, 14),
(1505, 105, 'Manipur', 1399700194, 14),
(1506, 105, 'Meghalaya', 1399700194, 14),
(1507, 105, 'Mizoram', 1399700194, 14),
(1508, 105, 'Nagaland', 1399700194, 14),
(1509, 105, 'Orissa', 1399700194, 14),
(1510, 105, 'Pondicherry', 1399700194, 14),
(1511, 105, 'Punjab', 1399700194, 14),
(1512, 105, 'Rajasthan', 1399700194, 14),
(1513, 105, 'Sikkim', 1399700194, 14),
(1514, 105, 'Tamil Nadu', 1399700194, 14),
(1515, 105, 'Tripura', 1399700194, 14),
(1516, 105, 'Uttar Pradesh', 1399700194, 14),
(1517, 105, 'Uttaranchal', 1399700194, 14),
(1518, 105, 'West Bengal', 1399700194, 14),
(4564, 105, 'Telangana', 1399700181, 14);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
CREATE TABLE IF NOT EXISTS `subscription` (
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

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plan`
--

DROP TABLE IF EXISTS `subscription_plan`;
CREATE TABLE IF NOT EXISTS `subscription_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `min_value` tinyint(4) NOT NULL,
  `max_value` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription_plan`
--

INSERT INTO `subscription_plan` (`id`, `name`, `min_value`, `max_value`, `status`, `is_deleted`, `created_date`, `updated_date`) VALUES
(1, '1-10 users', 1, 10, 1, 0, '2018-08-29 00:00:52', '2018-08-29 00:00:52'),
(2, '11-30 users', 11, 30, 1, 0, '2018-08-29 00:01:08', '2018-08-29 00:01:08'),
(3, '30-50 users', 30, 50, 1, 0, '2018-08-29 00:01:52', '2018-08-29 00:01:52'),
(4, '50+ users ', 50, 0, 1, 0, '2018-08-29 00:02:08', '2018-08-29 00:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

DROP TABLE IF EXISTS `system_settings`;
CREATE TABLE IF NOT EXISTS `system_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `sys_value` longtext NOT NULL,
  `sys_group` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `sys_value`, `sys_group`, `status`, `is_deleted`, `created_date`, `updated_date`) VALUES
(1, 'default_currency', 'INR', 'currency ', 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'system_email', 'info@akshaycrm.com', 'email', 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'default_theme', 'purple_red', 'look_feel', 1, 0, '2018-11-09 12:17:49', '0000-00-00 00:00:00'),
(4, 'available_theme', '[{\"name\":\"purple_red\",\"title\":\"Purple Red\"},{\"name\":\"pitch_black\",\"title\":\"Pitch Black\"},{\"name\":\"just_white\",\"title\":\"Just White\"},{\"name\":\"soft_metal\",\"title\":\"Soft Metal\"},{\"name\":\"grape_fruit\",\"title\":\"Grape Fruit\"},{\"name\":\"blue_jeans\",\"title\":\"Blue Jeans\"},{\"name\":\"grass\",\"title\":\"Grass\"},{\"name\":\"pink_rose\",\"title\":\"Pink Rose\"}]', 'look_feel', 1, 0, '2018-11-09 15:48:06', '2018-11-09 15:48:06'),
(5, 'is_sap_connected', '1', 'sap_integration', 1, 0, '2019-01-30 22:42:13', '2019-01-30 22:42:13'),
(6, 'sql_server_type', '2012', 'sap_integration', 1, 0, '2019-01-30 22:57:28', '2019-01-30 22:57:28'),
(7, 'sql_server_name', 'sql-server-2012', 'sap_integration', 1, 0, '2019-01-30 22:57:28', '2019-01-30 22:57:28'),
(8, 'sql_username', 'superadmin', 'sap_integration', 1, 0, '2019-01-30 22:54:56', '2019-01-30 22:54:56'),
(9, 'sql_password', 'sadmin@123', 'sap_integration', 1, 0, '2019-01-30 22:57:28', '2019-01-30 22:57:28'),
(10, 'sap_username', 'sap_manager', 'sap_integration', 1, 0, '2019-01-30 22:44:46', '2019-01-30 22:44:46'),
(11, 'sap_password', '12345', 'sap_integration', 1, 0, '2019-01-30 22:44:46', '2019-01-30 22:44:46'),
(12, 'sap_sales_order_url', 'http://sap.akshay.com:8090/CRMService/CRM/AddSalesOrder', 'sap_integration', 1, 0, '2019-01-30 22:44:46', '2019-01-30 22:44:46'),
(13, 'sap_sales_quote_url', 'http://sap.akshay.com:8090/CRMService/CRM/AddSalesQuotation', 'sap_integration', 1, 0, '2019-01-30 22:44:46', '2019-01-30 22:44:46'),
(14, 'sap_connection_parameter_url', 'http://akshaycrm.com/sap_integration/service.php', 'sap_integration', 1, 0, '2019-01-30 22:44:46', '2019-01-30 22:44:46');

-- --------------------------------------------------------

--
-- Table structure for table `target_duration`
--

DROP TABLE IF EXISTS `target_duration`;
CREATE TABLE IF NOT EXISTS `target_duration` (
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `target_duration`
--

INSERT INTO `target_duration` (`id`, `code`, `name`, `in_days`, `priority`, `status`, `is_deleted`, `created_date`, `updated_date`) VALUES
(1, '', 'weekly', 7, 0, 0, 1, '2018-08-22 00:47:03', '2018-08-22 00:47:03'),
(2, '', '15 days', 15, 1, 0, 1, '2018-08-22 00:47:03', '2018-08-22 00:47:03'),
(3, '', 'monthly', 30, 2, 1, 0, '2018-08-22 00:47:03', '2018-08-22 00:47:03'),
(4, '', 'quaterly', 90, 3, 1, 0, '2018-08-22 00:47:03', '2018-08-22 00:47:03'),
(5, '', 'Half yearly', 180, 4, 1, 0, '2018-08-22 00:47:03', '2018-08-22 00:47:03'),
(6, '', 'Yearly', 360, 5, 1, 0, '2018-08-22 00:47:03', '2018-08-22 00:47:03');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
