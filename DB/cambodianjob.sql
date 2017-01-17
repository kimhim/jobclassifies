/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.6.17 : Database - cambodianjob
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cambodianjob` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `cambodianjob`;

/*Table structure for table `education` */

DROP TABLE IF EXISTS `education`;

CREATE TABLE `education` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `school` varchar(250) DEFAULT NULL,
  `major` varchar(200) DEFAULT NULL,
  `start_year` int(4) DEFAULT NULL,
  `finish_year` int(4) DEFAULT NULL,
  `employee_id` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `education` */

insert  into `education`(`id`,`school`,`major`,`start_year`,`finish_year`,`employee_id`,`created_at`,`updated_at`) values (9,'Passeriel Numeric Cambodia','Web Programming',2010,2012,90,'2017-01-12 09:44:08','2017-01-12 11:21:28'),(10,'University of Puthisastra (UP)','Database and Programming',2012,2014,90,'2017-01-12 09:44:22','2017-01-12 11:22:23'),(12,'Passeriel Numeric Cambodia','Web Programming',2010,2012,92,'2017-01-12 18:35:18','2017-01-12 18:35:33'),(13,'University of Puthisastra (UP)','Database and Programming',2012,2014,92,'2017-01-12 18:35:55','2017-01-12 18:35:55'),(14,'HUN SEN TAKOK Hight SChool (Prey Veng)','Hight School',2007,2010,102,'2017-01-17 13:27:56','2017-01-17 13:27:56'),(15,'Passerelles Numeriques Cambodia','Web Programming',2010,2012,102,'2017-01-17 13:29:38','2017-01-17 13:29:38'),(16,'University of Puthisastra (UP)','Database and Programming',2012,2014,102,'2017-01-17 13:29:56','2017-01-17 13:29:56');

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_title` varchar(200) DEFAULT NULL,
  `job_description` varchar(200) DEFAULT NULL,
  `job_requirement` varchar(200) DEFAULT NULL,
  `job_categories` int(10) DEFAULT NULL,
  `job_priority` int(10) DEFAULT NULL,
  `job_status` int(11) DEFAULT '0',
  `company_id` int(11) DEFAULT NULL,
  `job_closing_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `jobs` */

insert  into `jobs`(`id`,`job_title`,`job_description`,`job_requirement`,`job_categories`,`job_priority`,`job_status`,`company_id`,`job_closing_date`,`created_at`,`updated_at`) values (1,'Drupal Developers','Develop any project by using Drupal CMS','At lest 2 years experience working with Drupal (Any version)',2,1,1,91,'2017-01-17','2017-01-17 13:48:43','2017-01-17 13:48:43');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`migration`,`batch`) values ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

insert  into `password_resets`(`email`,`token`,`created_at`) values ('kimhim.hom@gmail.com','0ee4b6f76ebc3a3562875819ca10406416f32da9108c985140cd05a1e5d194e9','2016-12-21 06:01:26');

/*Table structure for table `user_roles` */

DROP TABLE IF EXISTS `user_roles`;

CREATE TABLE `user_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `user_roles` */

insert  into `user_roles`(`id`,`title`,`created_at`,`updated_at`) values (1,'Administrator',NULL,NULL),(2,'Employer',NULL,NULL),(3,'Employee',NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(200) COLLATE utf8_unicode_ci DEFAULT 'profile_image.png' COMMENT 'this field is created to store user profile photo',
  `dob` date DEFAULT '0000-00-00',
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Please add your address',
  `user_role` int(10) DEFAULT '0',
  `status` int(1) DEFAULT '0',
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT 'Please add your description',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`remember_token`,`sex`,`avatar`,`dob`,`phone`,`address`,`user_role`,`status`,`code`,`description`,`created_at`,`updated_at`) values (1,'Cambodian Job','admin@gmail.com','$2y$10$sKk1BsyOHY7s0.LyOYEuNu/cvYRwgVBmemB4ldQLfKx.jM9ChRop.','eQUnWeyZ2H7650zhXMCvwaEwpf7uZWBgs58sUMZB11kIB6XJ58bAS4gRcfKD','Male','1484633468.png','1990-11-21','093240717','No240 Stree 271 Sangkat Poeng Tumpon Khan Mean Chey Phnom Penh Cambodia',1,1,'','Please add your description','2016-12-20 15:20:08','2017-01-17 13:46:23'),(91,'Ariya Phone shop','h.kimhim@gmail.com','$2y$10$/gU9FPWiAyvmcLftAOKwNu8uO2rk3R1UP7//14EiAlJVHIWa4lkPa','XKjj4Q5gFOWhKABnNvXUvlyzcxXJxJC30jbptZoE3jlx1EZZDLmujaSa5APY','Female','1484638294.jpg','2017-01-18','012582098','Please add your address',2,1,'Ug5mbBbEKjCFSVwKzshLWeo7krvgta','Please add your description','2017-01-08 05:29:59','2017-01-17 14:03:38'),(102,'HOM KIMHIM','kimhim.hom@gmail.com','$2y$10$/gU9FPWiAyvmcLftAOKwNu8uO2rk3R1UP7//14EiAlJVHIWa4lkPa','PmMw0zxzyOV58hZscKAG0TiXHxKnmHZCsGDDzmAVQoxQi0Xz6aWT2ovG9rCa','Male','1484638242.JPG','1900-12-21','093240717','Please add your address',3,1,'ylhBcPyNUqMMbm1OLuTlk9XK4oLKOh','Please add your description','2017-01-17 13:23:30','2017-01-17 14:30:07');

/*Table structure for table `work_experiences` */

DROP TABLE IF EXISTS `work_experiences`;

CREATE TABLE `work_experiences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(200) DEFAULT NULL,
  `position` varchar(250) DEFAULT NULL,
  `start_date` varchar(10) DEFAULT NULL,
  `finish_date` varchar(10) DEFAULT NULL,
  `responsibility` text,
  `employee_id` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `work_experiences` */

insert  into `work_experiences`(`id`,`company_name`,`position`,`start_date`,`finish_date`,`responsibility`,`employee_id`,`created_at`,`updated_at`) values (1,'ABC Contruction Col.,Ltd','Head of Business Development','2014-03-01','Jan-2017',NULL,90,NULL,'2017-01-12 15:14:54'),(2,'Dono Investment Co.,Ltd ','Sales Manager ','2010-01-01','2014-02-01',NULL,90,NULL,NULL),(3,'DND Internation Co.,Ltd','Sales Representive','2010-01-01','2014-02-01',NULL,90,NULL,NULL),(8,'Khmerdev','Software Developer','Dec-2015','Present',NULL,90,'2017-01-12 15:18:17','2017-01-12 15:20:41'),(9,'Prolypsis','Web Developer',NULL,'Jan-2013',NULL,92,'2017-01-12 18:36:41','2017-01-12 18:36:41'),(10,'Setti','Web Developer',NULL,'Nov-2013',NULL,92,'2017-01-12 18:37:11','2017-01-12 18:37:11'),(11,'WebConsole','Web Developer',NULL,'Jul-2017',NULL,92,'2017-01-12 18:37:41','2017-01-12 18:37:41'),(12,'Khmerdev','Software Developer',NULL,'Dec-2016',NULL,92,'2017-01-12 18:38:23','2017-01-12 18:38:23'),(13,'Prolypsis','Developer','Apr-2012','Apr-2013',NULL,102,'2017-01-17 13:31:11','2017-01-17 13:41:52'),(14,'FirstWomentTech Asia','Web Developer','Apr-2013','Nov-2015',NULL,102,'2017-01-17 13:31:41','2017-01-17 13:41:32'),(15,'Khmerdev','Software Developer','Dec-2015','Present',NULL,102,'2017-01-17 13:32:06','2017-01-17 13:41:09');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
