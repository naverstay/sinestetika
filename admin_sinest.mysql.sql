-- MySQL dump 10.13  Distrib 5.7.18-ndb-7.6.2, for Linux (x86_64)
--
-- Host: localhost    Database: sinestetika
-- ------------------------------------------------------
-- Server version	5.7.18-ndb-7.6.2

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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_sections`
--

DROP TABLE IF EXISTS `project_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_sections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `type` enum('image','video','content') NOT NULL DEFAULT 'image',
  `small_format` tinyint(1) unsigned DEFAULT '0',
  `image` text,
  `video` text,
  `content` text,
  `visible` tinyint(1) unsigned DEFAULT '1',
  `order` int(10) unsigned DEFAULT '0',
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `visible` (`visible`,`order`),
  CONSTRAINT `project_sections_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_sections`
--

LOCK TABLES `project_sections` WRITE;
/*!40000 ALTER TABLE `project_sections` DISABLE KEYS */;
INSERT INTO `project_sections` VALUES (1,1,'image',0,'[\"images\\/uploads\\/fbadd7f24b40b98f5822857c54ad8b90.png\",\"images\\/uploads\\/19bd184ab4b1a12afda045a3def8b1ec.jpg\"]',NULL,NULL,1,0,'111'),(2,1,'image',1,'[\"images\\/uploads\\/df5b15ea8a330a0a40bc08c1a37fc88e.png\"]',NULL,NULL,1,3,'111'),(3,1,'video',0,NULL,'storage/project_sections/video/de/595f13cbd0d46.mp4',NULL,1,1,'test'),(4,1,'image',1,'[\"images\\/uploads\\/dae38888013423a1f1735441ce6f864e.jpg\",\"images\\/uploads\\/87ceae8e80c9bf55697b1a2704b6a493.jpg\",\"images\\/uploads\\/5f39ef5ae9ada947e1909b4887197996.jpg\"]',NULL,NULL,1,4,NULL),(5,1,'image',0,'[]',NULL,NULL,1,7,'111'),(6,1,'video',1,NULL,'storage/project_sections/video/41/595f81686cbbd.mp4',NULL,1,5,'видео'),(10,2,'image',0,'[\"images\\/uploads\\/fbadd7f24b40b98f5822857c54ad8b90.png\",\"images\\/uploads\\/19bd184ab4b1a12afda045a3def8b1ec.jpg\"]','','',1,0,'111'),(11,2,'image',1,'[\"images\\/uploads\\/df5b15ea8a330a0a40bc08c1a37fc88e.png\"]','','',1,1,'111'),(12,2,'video',1,'','storage/project_sections/video/de/595f13cbd0d46.mp4','',1,2,'test'),(13,2,'image',0,'[\"images\\/uploads\\/58eb14abe2ebbe6e12b733c8ba869af0.jpg\",\"images\\/uploads\\/33b8a4a0569f57997013f2f88c255105.jpg\"]','','',1,3,''),(14,2,'image',0,'[\"images\\/uploads\\/c5b75ad9fce3dbf54d05ea212e44a387.jpg\"]',NULL,NULL,1,4,'111'),(15,2,'video',1,'','storage/project_sections/video/41/595f81686cbbd.mp4','',1,6,'видео'),(16,2,'video',0,'','storage/project_sections/video/0c/596188da9df35.mp4','',1,5,'test'),(17,2,'video',0,'','','',1,6,'test'),(18,2,'video',0,'','storage/project_sections/video/81/5961994db7131.mp4','',1,6,'test'),(19,3,'image',0,'[\"images\\/uploads\\/fbadd7f24b40b98f5822857c54ad8b90.png\",\"images\\/uploads\\/19bd184ab4b1a12afda045a3def8b1ec.jpg\"]','','',1,0,'111'),(20,3,'image',1,'[\"images\\/uploads\\/df5b15ea8a330a0a40bc08c1a37fc88e.png\"]','','',1,1,'111'),(21,3,'video',1,'','storage/project_sections/video/de/595f13cbd0d46.mp4','',1,2,'test'),(22,3,'image',0,'[\"images\\/uploads\\/58eb14abe2ebbe6e12b733c8ba869af0.jpg\",\"images\\/uploads\\/33b8a4a0569f57997013f2f88c255105.jpg\"]','','',1,3,''),(23,3,'image',0,'[]','','',1,4,'111'),(24,3,'video',1,'','storage/project_sections/video/41/595f81686cbbd.mp4','',1,5,'видео'),(25,3,'video',0,'','storage/project_sections/video/0c/596188da9df35.mp4','',1,6,'test'),(26,3,'video',0,'','','',1,6,'test'),(27,3,'video',0,'','storage/project_sections/video/81/5961994db7131.mp4','',1,6,'test'),(28,4,'image',0,'[\"images\\/uploads\\/fbadd7f24b40b98f5822857c54ad8b90.png\",\"images\\/uploads\\/19bd184ab4b1a12afda045a3def8b1ec.jpg\"]','','',1,0,'111'),(29,4,'image',1,'[\"images\\/uploads\\/df5b15ea8a330a0a40bc08c1a37fc88e.png\"]','','',1,1,'111'),(30,4,'video',1,'','storage/project_sections/video/de/595f13cbd0d46.mp4','',1,2,'test'),(31,4,'image',0,'[\"images\\/uploads\\/58eb14abe2ebbe6e12b733c8ba869af0.jpg\",\"images\\/uploads\\/33b8a4a0569f57997013f2f88c255105.jpg\"]','','',1,3,''),(32,4,'image',0,'[]','','',1,4,'111'),(33,4,'video',1,'','storage/project_sections/video/41/595f81686cbbd.mp4','',1,5,'видео'),(34,4,'video',0,'','storage/project_sections/video/0c/596188da9df35.mp4','',1,6,'test'),(35,4,'video',0,'','','',1,6,'test'),(36,4,'video',0,'','storage/project_sections/video/81/5961994db7131.mp4','',1,6,'test'),(37,5,'image',0,'[\"images\\/uploads\\/fbadd7f24b40b98f5822857c54ad8b90.png\",\"images\\/uploads\\/19bd184ab4b1a12afda045a3def8b1ec.jpg\"]','','',1,0,'111'),(38,5,'image',1,'[\"images\\/uploads\\/df5b15ea8a330a0a40bc08c1a37fc88e.png\"]','','',1,1,'111'),(39,5,'video',1,'','storage/project_sections/video/de/595f13cbd0d46.mp4','',1,2,'test'),(40,5,'image',0,'[\"images\\/uploads\\/58eb14abe2ebbe6e12b733c8ba869af0.jpg\",\"images\\/uploads\\/33b8a4a0569f57997013f2f88c255105.jpg\"]','','',1,3,''),(41,5,'image',0,'[]','','',1,4,'111'),(42,5,'video',1,'','storage/project_sections/video/41/595f81686cbbd.mp4','',1,5,'видео'),(43,5,'video',0,'','storage/project_sections/video/0c/596188da9df35.mp4','',1,6,'test'),(44,5,'video',0,'','','',1,6,'test'),(45,5,'video',0,'','storage/project_sections/video/81/5961994db7131.mp4','',1,6,'test'),(46,6,'image',0,'[\"images\\/uploads\\/fbadd7f24b40b98f5822857c54ad8b90.png\",\"images\\/uploads\\/19bd184ab4b1a12afda045a3def8b1ec.jpg\"]','','',1,0,'111'),(47,6,'image',1,'[\"images\\/uploads\\/df5b15ea8a330a0a40bc08c1a37fc88e.png\"]','','',1,1,'111'),(48,6,'video',1,'','storage/project_sections/video/de/595f13cbd0d46.mp4','',1,2,'test'),(49,6,'image',0,'[\"images\\/uploads\\/58eb14abe2ebbe6e12b733c8ba869af0.jpg\",\"images\\/uploads\\/33b8a4a0569f57997013f2f88c255105.jpg\"]','','',1,3,''),(50,6,'image',0,'[]','','',1,4,'111'),(51,6,'video',1,'','storage/project_sections/video/41/595f81686cbbd.mp4','',1,5,'видео'),(52,6,'video',0,'','storage/project_sections/video/0c/596188da9df35.mp4','',1,6,'test'),(53,6,'video',0,'','','',1,6,'test'),(54,6,'video',0,'','storage/project_sections/video/81/5961994db7131.mp4','',1,6,'test'),(55,7,'image',0,'[\"images\\/uploads\\/fbadd7f24b40b98f5822857c54ad8b90.png\",\"images\\/uploads\\/19bd184ab4b1a12afda045a3def8b1ec.jpg\"]','','',1,0,'111'),(56,7,'image',1,'[\"images\\/uploads\\/df5b15ea8a330a0a40bc08c1a37fc88e.png\"]','','',1,1,'111'),(57,7,'video',1,'','storage/project_sections/video/de/595f13cbd0d46.mp4','',1,2,'test'),(58,7,'image',0,'[\"images\\/uploads\\/58eb14abe2ebbe6e12b733c8ba869af0.jpg\",\"images\\/uploads\\/33b8a4a0569f57997013f2f88c255105.jpg\"]','','',1,3,''),(59,7,'image',0,'[]','','',1,4,'111'),(60,7,'video',1,'','storage/project_sections/video/41/595f81686cbbd.mp4','',1,5,'видео'),(61,7,'video',0,'','storage/project_sections/video/0c/596188da9df35.mp4','',1,6,'test'),(62,7,'video',0,'','','',1,6,'test'),(63,7,'video',0,'','storage/project_sections/video/81/5961994db7131.mp4','',1,6,'test'),(64,1,'image',1,'[\"images\\/uploads\\/cf3450aeafb18eff643173b9fc8191a2.jpg\",\"images\\/uploads\\/1c2f14e2bf3d886f5216e12c0eb33d15.jpg\"]',NULL,NULL,1,6,NULL),(65,1,'content',1,NULL,NULL,'<p>Текст помельче. Ключевая метафора позволяет\r\nосуществить переход из аналитической в творческую\r\nплоскость при разработке бренда.</p>\r\n\r\n<p>Это понятный образ, который запускает механизм\r\nассоциаций и задает направление для развития\r\nкреативной составляющей. Для разработки ключевой\r\nметафоры мы отвечаем на вопрос &laquo;мы как что?&raquo;</p>',1,2,NULL),(66,1,'video',0,NULL,'storage/project_sections/video/65/596e12dde4ca9.mp4',NULL,1,62,NULL);
/*!40000 ALTER TABLE `project_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_service`
--

DROP TABLE IF EXISTS `project_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_service` (
  `project_id` int(10) unsigned NOT NULL,
  `service_id` int(10) unsigned NOT NULL,
  KEY `project_id` (`project_id`),
  KEY `service_id` (`service_id`),
  CONSTRAINT `project_service_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `project_service_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_service`
--

LOCK TABLES `project_service` WRITE;
/*!40000 ALTER TABLE `project_service` DISABLE KEYS */;
INSERT INTO `project_service` VALUES (2,2),(4,2),(5,3),(6,3),(7,2),(1,1);
/*!40000 ALTER TABLE `project_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_tag`
--

DROP TABLE IF EXISTS `project_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `project_tag_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `project_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_tag`
--

LOCK TABLES `project_tag` WRITE;
/*!40000 ALTER TABLE `project_tag` DISABLE KEYS */;
INSERT INTO `project_tag` VALUES (1,7,13,0),(2,2,10,0),(3,3,1,0),(4,4,8,0),(5,5,4,0),(6,6,7,0),(7,7,5,0),(11,1,10,1),(12,1,8,0),(13,1,9,2);
/*!40000 ALTER TABLE `project_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `caption` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `short_descr` text,
  `descr` text,
  `photo` varchar(100) DEFAULT NULL,
  `order` int(10) unsigned NOT NULL DEFAULT '1',
  `visible` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `visible` (`visible`,`order`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'Reykjavik Fashion Festival','nike','<p>Аудит бизнес-процессов в компании<br />\r\nИсследования продукта и потребителей<br />\r\nСтратегия, видение бренда</p>','<p>Крупный текст. Мы помогаем брендам выстраивать новые отношения с клиентами и партнерами, используя передовые digital-инструменты.</p>\r\n\r\n<p>Мы разрабатываем и развиваем корпоративные и промо сайты, e-commerce проекты и веб-сервисы.</p>','images/uploads/ab486af5f870e6e1860fc85d689d0b65.jpg',0,1),(2,'Moisturizing Shampoo','polaroid','<p>Аудит бизнес-процессов в компании<br />\r\nИсследования продукта и потребителей<br />\r\nСтратегия, видение бренда</p>','<p>Крупный текст. Мы помогаем брендам выстраивать новые отношения с клиентами и партнерами, используя передовые digital-инструменты.</p>\r\n\r\n<p>Мы разрабатываем и развиваем корпоративные и промо сайты, e-commerce проекты и веб-сервисы.</p>','images/uploads/e836fcbc53b85156a4cf0b9a32c595a1.jpg',1,1),(3,'Reykjavik Fashion Festival 1','vw','<p>Аудит бизнес-процессов в компании<br />\r\nИсследования продукта и потребителей<br />\r\nСтратегия, видение бренда</p>','<p>Крупный текст. Мы помогаем брендам выстраивать новые отношения с клиентами и партнерами, используя передовые digital-инструменты.</p>\r\n\r\n<p>Мы разрабатываем и развиваем корпоративные и промо сайты, e-commerce проекты и веб-сервисы.</p>','images/uploads/e95e2d8ea97fc7a37eea01f92c308812.jpg',2,1),(4,'Reykjavik Fashion Festival 1','pill','<p>Аудит бизнес-процессов в компании<br />\r\nИсследования продукта и потребителей<br />\r\nСтратегия, видение бренда</p>','<p>Крупный текст. Мы помогаем брендам выстраивать новые отношения с клиентами и партнерами, используя передовые digital-инструменты.</p>\r\n\r\n<p>Мы разрабатываем и развиваем корпоративные и промо сайты, e-commerce проекты и веб-сервисы.</p>','images/uploads/7cd3b4555a52a5b1df264711cdfa816f.jpg',3,1),(5,'Reykjavik Fashion Festival','fox','<p>Аудит бизнес-процессов в компании<br />\r\nИсследования продукта и потребителей<br />\r\nСтратегия, видение бренда</p>','<p>Крупный текст. Мы помогаем брендам выстраивать новые отношения с клиентами и партнерами, используя передовые digital-инструменты.</p>\r\n\r\n<p>Мы разрабатываем и развиваем корпоративные и промо сайты, e-commerce проекты и веб-сервисы.</p>','images/uploads/109ae6971d6461207d409fe3265ececc.jpg',4,1),(6,'Reykjavik Fashion Festival 1','reykjavik','<p>Аудит бизнес-процессов в компании<br />\r\nИсследования продукта и потребителей<br />\r\nСтратегия, видение бренда</p>','<p>Крупный текст. Мы помогаем брендам выстраивать новые отношения с клиентами и партнерами, используя передовые digital-инструменты.</p>\r\n\r\n<p>Мы разрабатываем и развиваем корпоративные и промо сайты, e-commerce проекты и веб-сервисы.</p>','images/uploads/a4bfaf7c514d1f26300aa89c8261c1bd.jpg',5,1),(7,'Reykjavik Fashion Festival 1','back-to-the-future','<p>Аудит бизнес-процессов в компании<br />\r\nИсследования продукта и потребителей<br />\r\nСтратегия, видение бренда</p>','<p>Крупный текст. Мы помогаем брендам выстраивать новые отношения с клиентами и партнерами, используя передовые digital-инструменты.</p>\r\n\r\n<p>Мы разрабатываем и развиваем корпоративные и промо сайты, e-commerce проекты и веб-сервисы.</p>','images/uploads/1b686b056eebe93e402c755a662db387.jpg',6,1);
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_home_tags`
--

DROP TABLE IF EXISTS `service_home_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_home_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(10) unsigned NOT NULL,
  `section_id` int(10) unsigned DEFAULT NULL,
  `caption` varchar(255) NOT NULL,
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  `visible` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `service_home_tags_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `service_home_tags_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `service_sections` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_home_tags`
--

LOCK TABLES `service_home_tags` WRITE;
/*!40000 ALTER TABLE `service_home_tags` DISABLE KEYS */;
INSERT INTO `service_home_tags` VALUES (1,1,NULL,'Бренд-аудит',0,1),(2,1,2,'Исследования и аналитика',1,1),(3,1,3,'Стратегия бренда',2,1),(5,1,4,'Нейминг',3,1),(6,2,5,'Логотип, фирменный стиль',4,1),(7,2,8,'Гайдлайн/Брендбук',5,1),(8,2,6,'Дизайн упаковки',6,1),(9,2,NULL,'Печатная продукция',7,1),(10,3,NULL,'UI/UX дизайн',8,1),(11,3,NULL,'front-end/back-end',9,1),(12,3,NULL,'Техническая поддержка',10,1);
/*!40000 ALTER TABLE `service_home_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_section_tag`
--

DROP TABLE IF EXISTS `service_section_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_section_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_section_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `service_section_id` (`service_section_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `service_section_tag_ibfk_1` FOREIGN KEY (`service_section_id`) REFERENCES `service_sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `service_section_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_section_tag`
--

LOCK TABLES `service_section_tag` WRITE;
/*!40000 ALTER TABLE `service_section_tag` DISABLE KEYS */;
INSERT INTO `service_section_tag` VALUES (1,3,5,0),(2,4,4,0),(3,5,6,0),(4,5,7,0),(5,6,8,0),(7,10,12,0),(8,10,11,1),(9,10,13,2),(10,2,2,0),(11,1,1,0),(12,8,10,0);
/*!40000 ALTER TABLE `service_section_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_sections`
--

DROP TABLE IF EXISTS `service_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_sections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(10) unsigned NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `descr` text,
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  `visible` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `visible` (`visible`,`order`),
  KEY `service_id` (`service_id`),
  CONSTRAINT `service_sections_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_sections`
--

LOCK TABLES `service_sections` WRITE;
/*!40000 ALTER TABLE `service_sections` DISABLE KEYS */;
INSERT INTO `service_sections` VALUES (1,1,'Аудит бизнес-процессов в компании','<p>Перед тем, как приступить разработке всех составляющих бренда, нам необходимо получить информацию о внутренней среде вашей компании: о продукте или услуге, имеющихся ресурсах, краткосрочных и долгосрочных планах. Это позволит определить направление и состав работ, а также предотвратить проблемы на тех или иных этапах брендинга.</p>',0,1),(2,1,'Исследования продукта и потребителей','<p>Для того, чтобы понять текущую ситуацию и увидеть возможности для развития, необходимо собрать исходные данные. Этот этап включает в себя исследования продукта, аудитории, рыночных тенденций и конкурентного окружения. Результаты анализа полученных данных станут основой для разработки или корректировки стратегии вашего бренда.</p>',1,1),(3,1,'Стратегия бренда','<p>Стратегия бренда поможет сформировать и вербально закрепить общий образ, который в итоге будет видеть и чувствовать каждый представитель аудитории. Она позволит сформировать основной вектор развития и определить новые каналы для реализации всех продуктов.</p>',2,1),(4,1,'Вербальная идентификация','<p><strong>Ключевая метафора</strong><br />\r\nКлючевая метафора позволяет осуществить переход из аналитической в творческую плоскость при разработке бренда. Это понятный образ, который запускает механизм ассоциаций и задает направление для развития креативной составляющей. Для разработки ключевой метафоры мы отвечаем на вопрос &laquo;мы как что?&raquo;</p>\r\n\r\n<p><strong>Нейминг</strong><br />\r\nПостроение стабильных и долгосрочных отношений бренда с целевой аудиторией и определение тона коммуникаций. Нейминг направлен на создание маркетинговых имен для всех продуктов компании. Разрабатываем различные варианты названий, учитывая существующие названия брендов конкурентов и наличие свободного доменного имени.</p>\r\n\r\n<p><strong>Слоган</strong><br />\r\nСлоган &mdash; это легко запоминающаяся фраза, кратко выражающая суть философии бренда. Через слоган мы будем транслировать стратегию и основное конкурентное преимущество, уникальный стиль и характер вашего бренда.</p>',3,1),(5,2,'Визуальная система','<p><strong>Логотип</strong><br />\r\nСоздаем визуальный символ бренда на основе проведенного исследования и выработанной стратегии. Это может быть уникальное шрифтовое начертание, знак или комбинация элементов.</p>\r\n\r\n<p><strong>Фирменный стиль</strong><br />\r\nНаделение бренда опознавательной концептуальной и визуальной платформой. В фирменный стиль входит разработка графической среды, гайдлайна и набора носителей на выбор заказчика (визитки, папки, ручки, бланки и прочее).</p>',4,1),(6,2,'Дизайн продукта и упаковки','<p>Создаем внешний вид продуктов, эффективно решающих коммуникационную задачу. Разрабатываем различные варианты эскизов и затем дорабатываем выбранный концепт-эскиз. Производим корректорскую вычитку и предпечатную подготовку.</p>',5,1),(7,2,'Дизайн печатной продукции','<p>Разрабатываем комплект эффективных носителей, которые включают в себя: наружную рекламу (билборды, вывески), рекламную печатную продукцию (листовки, буклеты, календари), многостраничную продукцию (книги, справочники) и периодические издания (газеты, журналы, корпоративные издания).</p>',6,1),(8,2,'Гайдлайн / брендбук','<p>Мы подготовим брендбук, в который войдёт описание ценностей и особенностей бренда, а также способов донесения их до аудитории. Итоговый документ будет включать в себя гайдбук и катгайд.</p>',7,1),(9,2,'Авторский надзор','<p>Адаптируем дизайн-решения, осуществляем авторский надзор при воплощении.</p>',8,1),(10,3,'Как строится работа:','<ul>\r\n	<li><strong>Исследования и аналитика</strong><br />\r\n	Собираем информацию, формулируем задачи. Определяем критерии успеха.</li>\r\n	<li><strong>Подготовка контента</strong><br />\r\n	Используем принцип &laquo;content first&raquo;. Формируем содержание сайта, после этого приступаем к дизайну.</li>\r\n	<li><strong>Проектирование и дизайн</strong><br />\r\n	Проектируем структуру и разрабатываем дизайн интерфейсов. Учитываем эстетику бренда.</li>\r\n	<li><strong>Front-end и back-end программирование</strong><br />\r\n	Программируем серверную логику и оживляем интерфейсы.</li>\r\n	<li><strong>Тестирование и запуск</strong><br />\r\n	Проводим кросс-браузерное и нагрузочное тестирование, выкладываем сайт в публичный доступ.</li>\r\n	<li><strong>Поддержка</strong><br />\r\n	Оказываем техническую и дизайн поддержку после запуска.</li>\r\n</ul>',9,1);
/*!40000 ALTER TABLE `service_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `caption` varchar(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `main_caption` varchar(255) DEFAULT NULL,
  `land_caption` varchar(255) DEFAULT NULL,
  `main_descr` text,
  `short_descr` text,
  `descr` text,
  `order` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order` (`order`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Проектирование брендов','branding','Проектирование бренда','Проектирование бренда','<p>Исследуем и анализируем продукт, потребителей, рынок.&nbsp;Формируем стратегию, видение бренда. Создаем систему вербальной идентификации: название, слоган, метафору.</p>','<ul>\r\n	<li>Проводим аудит бизнес-процессов в компании клиента.</li>\r\n	<li>Исследуем и анализируем продукт, потребителей, рынок.</li>\r\n	<li>Формируем стратегию, видение бренда.</li>\r\n</ul>','',0),(2,'Системы  визуальной идентификации','design','Визуальная идентификация','Системы визуальной идентификации','<p>Разрабатываем визуальную&nbsp;систему бренда:</p>\r\n\r\n<p>логотип, фирменный стиль, дизайн продукта и упаковки.&nbsp;Объединяем&nbsp;стандарты в брендбук или гайдлайн.</p>','<ul>\r\n	<li>Создаем системы вербальной идентификации: бренд-нейм, слоган, метафору</li>\r\n	<li>Разрабатываем визуальные системы: логотип, фирменный стиль, дизайн упаковки, дизайн печатной продукции</li>\r\n	<li>Объединяем регламенты и стандарты в брендбук или гайдлайн.</li>\r\n	<li>Адаптируем дизайн-решения, осуществляем авторский надзор при воплощении.</li>\r\n</ul>','',1),(3,'Разрабатываем  и развиваем веб-проекты','digital','Веб-разработка','Веб-разработка','<p>Разрабатываем и развиваем корпоративные и промо сайты, e-commerce проекты и веб-сервисы. Учитываем стратегию бизнеса и эстетику бренда.</p>','<p>Разрабатываем и развиваем корпоративные и промо сайты, e-commerce проекты и веб-сервисы. Тщательно прорабатываем интерфейсы в соответствии с потребностями пользователей и эстетикой бренда.</p>','<p>Мы помогаем брендам выстраивать новые отношения с клиентами и партнерами, используя передовые digital‑инструменты.</p>\r\n\r\n<p>Мы разрабатываем и развиваем корпоративные и промо сайты, e‑commerce проекты и веб‑сервисы.</p>',2);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_groups`
--

DROP TABLE IF EXISTS `tag_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `caption` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order` (`order`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_groups`
--

LOCK TABLES `tag_groups` WRITE;
/*!40000 ALTER TABLE `tag_groups` DISABLE KEYS */;
INSERT INTO `tag_groups` VALUES (1,'Исследование','research',1),(3,'Стратегия','strategy',0),(4,'Нейминг','naming',2),(5,'Фирменный стиль','style',3),(6,'Упаковка','pkg',4),(7,'Брендбук','brandbook',5),(8,'Веб-разработка','web',6);
/*!40000 ALTER TABLE `tag_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_tag_group`
--

DROP TABLE IF EXISTS `tag_tag_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_tag_group` (
  `tag_group_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  KEY `tag_group_id` (`tag_group_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `tag_tag_group_ibfk_1` FOREIGN KEY (`tag_group_id`) REFERENCES `tag_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tag_tag_group_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_tag_group`
--

LOCK TABLES `tag_tag_group` WRITE;
/*!40000 ALTER TABLE `tag_tag_group` DISABLE KEYS */;
INSERT INTO `tag_tag_group` VALUES (1,2),(3,5),(4,4),(5,7),(6,8),(7,1),(7,10),(8,12),(8,11),(8,13);
/*!40000 ALTER TABLE `tag_tag_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `caption` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `on_main` tinyint(1) unsigned DEFAULT '1',
  `order` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order` (`order`),
  KEY `on_main` (`on_main`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'Бренд-аудит','audit',0,1),(2,'Исследования','research',1,0),(3,'Исследования потребителей','research',0,4),(4,'Нейминг','naming',1,10),(5,'Стратегия бренда','strategy',1,7),(6,'Логотип','identity',1,2),(7,'Фирменный стиль','identity',1,5),(8,'Дизайн упаковки','package',1,8),(9,'Печатная продукция','polygraphy',0,12),(10,'Гайдлайн/Брендбук','brandbook',1,11),(11,'UI/UX дизайн','web',1,3),(12,'Front-end/Back-end','web',1,6),(13,'Тех. поддержка','web',1,9);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@sinestetika.ru','$2y$10$6SZZIB88.qHSvd0gWz5or.nKwgA.GYlO9xkNEYv.6WJ/I/Xx0nDv6','m9vG2vGp2TjOfAYNxcqf4fVrr0SELg3jJuNiZPk34pQnpARD1x9ydKiITKTy','2017-06-22 02:54:39','2017-06-22 02:54:39');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-31  5:14:47
