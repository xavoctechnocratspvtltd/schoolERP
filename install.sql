-- MySQL dump 10.13  Distrib 5.5.28, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: ttt
-- ------------------------------------------------------
-- Server version	5.5.28-0ubuntu0.12.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alerts`
--

DROP TABLE IF EXISTS `alerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alerts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `epan_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `sender_signature` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_epan_id` (`epan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alerts`
--

LOCK TABLES `alerts` WRITE;
/*!40000 ALTER TABLE `alerts` DISABLE KEYS */;
/*!40000 ALTER TABLE `alerts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `points` varchar(255) DEFAULT NULL,
  `owner_name` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `address` text,
  `created_at` date DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branch`
--

LOCK TABLES `branch` WRITE;
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
INSERT INTO `branch` VALUES (1,'Default','500000','Xavoc Technocrats','+91 8875191258','18/436 Gayatri Marg, Kanji Ka Hata, Dhabai Ji Ka Wada, udaipur','2011-12-12','info@xavoc.com');
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `epan`
--

DROP TABLE IF EXISTS `epan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `epan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fund_alloted` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `contact_person_name` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `address` text,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `keywords` text,
  `description` text,
  `website` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `is_approved` tinyint(1) DEFAULT NULL,
  `last_email_sent` datetime DEFAULT NULL,
  `allowed_aliases` int(11) DEFAULT NULL,
  `parked_domain` varchar(255) DEFAULT NULL,
  `email_host` varchar(255) DEFAULT NULL,
  `email_port` varchar(255) DEFAULT NULL,
  `email_username` varchar(255) DEFAULT NULL,
  `email_password` varchar(255) DEFAULT NULL,
  `email_reply_to` varchar(255) DEFAULT NULL,
  `email_reply_to_name` varchar(255) DEFAULT NULL,
  `email_from` varchar(255) DEFAULT NULL,
  `email_from_name` varchar(255) DEFAULT NULL,
  `is_frontent_regiatrstion_allowed` tinyint(1) DEFAULT NULL,
  `user_activation` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_epan_staff1` (`staff_id`),
  KEY `fk_epan_epan_categories1` (`category_id`),
  FULLTEXT KEY `tags_description_full_text` (`keywords`,`description`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `epan`
--

LOCK TABLES `epan` WRITE;
/*!40000 ALTER TABLE `epan` DISABLE KEYS */;
INSERT INTO `epan` VALUES (1,'web',1,1,'admin','5000000','2014-01-26',1,'Xavoc Technocrats Pvt. Ltd.','Xavoc Admin','+91 8875191258','18/436, Gayatri marg, Kanji Ka hata, Udaipur, Rajasthan , India','Udaipur','Rajasthan','India','info@xavoc.com','xEpan CMS, an innovative approach towards Drag And Drop CMS.','World\'s best and easiest cms :)','http://www.xavoc.com',1,1,NULL,1,NULL,'','','','','','','','',1,'self_activated');
/*!40000 ALTER TABLE `epan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `epan_aliases`
--

DROP TABLE IF EXISTS `epan_aliases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `epan_aliases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `epan_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_epan_id` (`epan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `epan_aliases`
--

LOCK TABLES `epan_aliases` WRITE;
/*!40000 ALTER TABLE `epan_aliases` DISABLE KEYS */;
/*!40000 ALTER TABLE `epan_aliases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `epan_categories`
--

DROP TABLE IF EXISTS `epan_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `epan_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `parent_category_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cat_id` (`id`),
  KEY `cat_parent` (`parent_category_id`),
  KEY `func_getPathWay` (`id`,`parent_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `epan_categories`
--

LOCK TABLES `epan_categories` WRITE;
/*!40000 ALTER TABLE `epan_categories` DISABLE KEYS */;
INSERT INTO `epan_categories` VALUES (1,'Default','Default',0,0);
/*!40000 ALTER TABLE `epan_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `epan_components_marketplace`
--

DROP TABLE IF EXISTS `epan_components_marketplace`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `epan_components_marketplace` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_final` tinyint(1) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `allowed_children` varchar(255) DEFAULT NULL,
  `specific_to` varchar(255) DEFAULT NULL,
  `namespace` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `is_system` tinyint(1) DEFAULT NULL,
  `plugin_hooked` text,
  `description` text,
  `default_enabled` tinyint(1) DEFAULT NULL,
  `has_toolbar_tools` tinyint(1) DEFAULT NULL,
  `has_owner_modules` tinyint(1) DEFAULT NULL,
  `has_plugins` tinyint(1) DEFAULT NULL,
  `has_live_edit_app_page` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `epan_components_marketplace`
--

LOCK TABLES `epan_components_marketplace` WRITE;
/*!40000 ALTER TABLE `epan_components_marketplace` DISABLE KEYS */;
INSERT INTO `epan_components_marketplace` VALUES (1,'Image',1,'50',NULL,NULL,'imageElement','element',1,NULL,NULL,NULL,1,NULL,0,NULL),(2,'RowColumn',0,'0','3','','rowColumnElement','element',1,NULL,NULL,NULL,1,NULL,0,NULL),(4,'SlideShow',0,'0','5','','slideshowModule','module',0,NULL,NULL,NULL,1,NULL,0,NULL),(6,'Text',0,'0',NULL,NULL,'textElement','element',1,NULL,NULL,NULL,1,NULL,0,NULL),(7,'Title',1,'0',NULL,NULL,'titleElement','element',1,NULL,NULL,NULL,1,NULL,0,NULL),(8,'EnquiryForm',1,'0','',NULL,'enquiryformModule','module',0,NULL,NULL,NULL,1,NULL,0,NULL),(10,'MenuBar',0,'0','11','','menubarModule','module',0,NULL,NULL,NULL,1,NULL,0,NULL),(13,'SystemContentManipulations',1,'0',NULL,NULL,'systemcontentmanipulationPlugins','plugins',1,'output-fetched',NULL,1,NULL,NULL,1,NULL),(12,'Container',0,'0','','','containerElement','element',1,NULL,NULL,NULL,1,NULL,0,NULL),(16,'SocialShare',NULL,NULL,NULL,NULL,'socialshareModule','module',0,NULL,NULL,NULL,1,NULL,0,NULL),(20,'Backup And Restore App',NULL,NULL,NULL,NULL,'backupandrestoreApp','application',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(21,'Simple Image Gallary App',NULL,NULL,NULL,NULL,'simpleImageGallaryApp','application',0,NULL,'bla bla bla',0,1,0,0,0),(22,'Visitor Counter',NULL,NULL,NULL,NULL,'visitorCounterApp','application',0,'epan-hit','sdfsd',0,1,0,0,0),(26,'User Login',NULL,NULL,NULL,NULL,'userLoginElement','element',1,NULL,NULL,0,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `epan_components_marketplace` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `epan_installed_components`
--

DROP TABLE IF EXISTS `epan_installed_components`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `epan_installed_components` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `epan_id` int(11) DEFAULT NULL,
  `component_id` int(11) DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `params` varchar(255) DEFAULT NULL,
  `installed_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `epan_installed_components`
--

LOCK TABLES `epan_installed_components` WRITE;
/*!40000 ALTER TABLE `epan_installed_components` DISABLE KEYS */;
INSERT INTO `epan_installed_components` VALUES (1,1,13,1,NULL,'2014-01-26'),(2,1,8,1,NULL,'2014-01-27');
/*!40000 ALTER TABLE `epan_installed_components` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `epan_page`
--

DROP TABLE IF EXISTS `epan_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `epan_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `menu_caption` varchar(255) DEFAULT NULL,
  `epan_id` int(11) DEFAULT NULL,
  `is_template` tinyint(1) DEFAULT NULL,
  `title` text,
  `description` text,
  `keywords` text,
  `content` text,
  `body_attributes` text,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_epan_page_epan1` (`epan_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `epan_page`
--

LOCK TABLES `epan_page` WRITE;
/*!40000 ALTER TABLE `epan_page` DISABLE KEYS */;
INSERT INTO `epan_page` VALUES (1,'home','Home',1,0,'xEpan CMS, an innovative approach towards Drag And Drop CMS.','World\'s best and easiest cms :)','xEpan CMS, an innovative approach towards Drag And Drop CMS.','\n  \n  \n  \n  \n  \n  \n  \n\n\n\n\n\n\n\n\n','cursor: auto;',NULL,'2014-01-31 22:03:22');
/*!40000 ALTER TABLE `epan_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `epan_page_snapshots`
--

DROP TABLE IF EXISTS `epan_page_snapshots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `epan_page_snapshots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `epan_page_id` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `keywords` text,
  `description` text,
  `body_attributes` text,
  `content` text,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `epan_page_snapshots`
--

LOCK TABLES `epan_page_snapshots` WRITE;
/*!40000 ALTER TABLE `epan_page_snapshots` DISABLE KEYS */;
/*!40000 ALTER TABLE `epan_page_snapshots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `epan_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `message` text,
  `created_at` datetime DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `sender_signature` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_epan_id` (`epan_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,16,'demoMessage1','Hi this is for you',NULL,0,'khushi');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `access_level` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_staff_branche1` (`branch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1,'Staff1',1,'xadmin','x123',100);
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `epan_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `last_login_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_epan_id` (`epan_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Admin','admin','admin','2014-01-31','SuperUser',NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitorCounterApp_config`
--

DROP TABLE IF EXISTS `visitorCounterApp_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitorCounterApp_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `epan_id` int(11) DEFAULT NULL,
  `show_total` tinyint(1) DEFAULT NULL,
  `show_yearly` tinyint(1) DEFAULT NULL,
  `show_monthly` tinyint(1) DEFAULT NULL,
  `show_daily` tinyint(1) DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `font_size` varchar(255) DEFAULT NULL,
  `start_number` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_epan_id` (`epan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitorCounterApp_config`
--

LOCK TABLES `visitorCounterApp_config` WRITE;
/*!40000 ALTER TABLE `visitorCounterApp_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `visitorCounterApp_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitorCounterApp_visits`
--

DROP TABLE IF EXISTS `visitorCounterApp_visits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitorCounterApp_visits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `epan_id` int(11) DEFAULT NULL,
  `name` datetime DEFAULT NULL,
  `IP` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_epan_id` (`epan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitorCounterApp_visits`
--

LOCK TABLES `visitorCounterApp_visits` WRITE;
/*!40000 ALTER TABLE `visitorCounterApp_visits` DISABLE KEYS */;
/*!40000 ALTER TABLE `visitorCounterApp_visits` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-01-31 22:40:40
