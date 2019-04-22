CREATE DATABASE  IF NOT EXISTS `news_m314007` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `news_m314007`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: news_m314007
-- ------------------------------------------------------
-- Server version	5.1.72-community

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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `art_id` int(11) NOT NULL AUTO_INCREMENT,
  `art_title` varchar(50) DEFAULT NULL,
  `art_text` text,
  `art_max_pics` int(11) DEFAULT NULL,
  `art_person` varchar(255) DEFAULT NULL,
  `art_genre` int(11) DEFAULT NULL,
  `art_creator` int(11) DEFAULT NULL,
  `art_timestamp` datetime DEFAULT NULL,
  `art_editor` varchar(45) DEFAULT NULL,
  `art_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`art_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'Πολιτική','Lorem ipsum dolor sit amet, consectetur adipiscing elit. In in mauris ut velit venenatis lobortis aliquet quis metus. Ut justo risus, ullamcorper et tellus at, convallis aliquet tortor. Donec interdum ultrices mi, et sollicitudin arcu blandit et. Sed tincidunt a ipsum ut laoreet. Ut rutrum turpis a blandit aliquet. Sed blandit lorem magna, a finibus ligula pellentesque non. Vestibulum a risus id lacus commodo mollis. Curabitur commodo eget tellus eu pharetra. Maecenas vel risus quis nisl lobortis euismod eget at nisl. Donec condimentum velit vitae velit tempor varius. Sed purus eros, fringilla consectetur sollicitudin a, mollis convallis lorem. Nulla facilisi. Aenean fringilla mauris sit amet tortor varius, at pulvinar tellus consequat. Maecenas fringilla sem vitae ultrices bibendum.',3,'',1,21,'2015-02-20 02:40:59','21',1),(2,'Πολιτική','Et hunc idem dico, inquieta sed ad virtutes et ad vitia nihil interesse.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Solum praeterea formosum, solum liberum, solum civem, stultost; Utrum igitur tibi litteram videor an totas paginas commovere? Iam contemni non poteris. Nihil opus est exemplis hoc facere longius. Eademne, quae restincta siti? Cupit enim dícere nihil posse ad beatam vitam deesse sapienti. Duo Reges: constructio interrete. Tamen aberramus a proposito, et, ne longius, prorsus, inquam, Piso, si ista mala sunt, placet. Quae in controversiam veniunt, de iis, si placet, disseramus. Videamus animi partes, quarum est conspectus illustrior; Eaedem enim utilitates poterunt eas labefactare atque pervertere. Ex eorum enim scriptis et institutis cum omnis doctrina liberalis, omnis historia. ',3,'',1,21,'2015-02-20 02:44:14','21',1),(3,'Κόσμος','Suspendisse nec interdum lacus. Donec vitae tristique ipsum, vitae vulputate leo. Sed a blandit nisl. Proin euismod turpis mi, in hendrerit ligula malesuada in. Sed sed dictum sapien, quis efficitur lorem. Ut congue commodo sapien nec vehicula. Cras pulvinar justo orci, at semper mauris pretium quis. Mauris a vehicula turpis, a commodo metus. Aliquam erat volutpat. Donec eleifend ipsum sit amet auctor ultrices. Suspendisse potenti. Sed eget consequat turpis. Sed blandit dolor aliquet dolor egestas, sed feugiat erat scelerisque. Mauris nec porta nulla, ac malesuada est. Proin maximus ultricies cursus.',2,'',1,22,'2015-02-20 02:49:56','22',1),(4,'Κόσμος','Et hunc idem dico, inquieta sed ad virtutes et ad vitia nihil interesse.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Solum praeterea formosum, solum liberum, solum civem, stultost; Utrum igitur tibi litteram videor an totas paginas commovere? Iam contemni non poteris. Nihil opus est exemplis hoc facere longius. Eademne, quae restincta siti? Cupit enim dícere nihil posse ad beatam vitam deesse sapienti. Duo Reges: constructio interrete. Tamen aberramus a proposito, et, ne longius, prorsus, inquam, Piso, si ista mala sunt, placet. Quae in controversiam veniunt, de iis, si placet, disseramus. Videamus animi partes, quarum est conspectus illustrior; Eaedem enim utilitates poterunt eas labefactare atque pervertere. Ex eorum enim scriptis et institutis cum omnis doctrina liberalis, omnis historia. ',3,'',1,22,'2015-02-20 02:49:56','22',1),(5,'Κόσμος','\nHaec para/doca illi, nos admirabilia dicamus.\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quid sentiat, non videtis. Deinde prima illa, quae in congressu solemus: Quid tu, inquit, huc? Sed quae tandem ista ratio est? Duo Reges: constructio interrete. Tum Quintus: Est plane, Piso, ut dicis, inquit. Aliena dixit in physicis nec ea ipsa, quae tibi probarentur; \n\nTollitur beneficium, tollitur gratia, quae sunt vincla concordiae. Sedulo, inquam, faciam. Ecce aliud simile dissimile. Avaritiamne minuis? Tria genera bonorum; Ab hoc autem quaedam non melius quam veteres, quaedam omnino relicta. Tollenda est atque extrahenda radicitus. Si verbum sequimur, primum longius verbum praepositum quam bonum. Nam quibus rebus efficiuntur voluptates, eae non sunt in potestate sapientis. \n\nSummum a vobis bonum voluptas dicitur.\n\nConfecta res esset. Non modo carum sibi quemque, verum etiam vehementer carum esse? Cur ipse Pythagoras et Aegyptum lustravit et Persarum magos adiit? Quis est tam dissimile homini. Hoc non est positum in nostra actione. Re mihi non aeque satisfacit, et quidem locis pluribus. Sed plane dicit quod intellegit. \n\nMihi quidem Antiochum, quem audis, satis belle videris attendere.\n\nCompensabatur, inquit, cum summis doloribus laetitia. Praeteritis, inquit, gaudeo. Quae hic rei publicae vulnera inponebat, eadem ille sanabat. \n.',2,'',1,21,'2015-02-20 02:49:56','21',1),(6,'Ελλάδα','Lorem ipsum dolor sit amet, consectetur adipiscing elit. In in mauris ut velit venenatis lobortis aliquet quis metus. Ut justo risus, ullamcorper et tellus at, convallis aliquet tortor. Donec interdum ultrices mi, et sollicitudin arcu blandit et. Sed tincidunt a ipsum ut laoreet. Ut rutrum turpis a blandit aliquet. Sed blandit lorem magna, a finibus ligula pellentesque non. Vestibulum a risus id lacus commodo mollis. Curabitur commodo eget tellus eu pharetra. Maecenas vel risus quis nisl lobortis euismod eget at nisl. Donec condimentum velit vitae velit tempor varius. Sed purus eros, fringilla consectetur sollicitudin a, mollis convallis lorem. Nulla facilisi. Aenean fringilla mauris sit amet tortor varius, at pulvinar tellus consequat. Maecenas fringilla sem vitae ultrices bibendum.',2,'',1,21,'2015-02-20 02:51:19','21',1),(7,'Ελλάδα','Donec non vulputate tellus. Praesent sed pulvinar quam. In consectetur cursus orci dignissim viverra. Sed nec consectetur justo. Aliquam sodales nibh sed euismod maximus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla facilisi.',3,'',1,23,'2015-02-20 02:51:19','23',1),(8,'Ελλάδα','Nunc mollis nisl tincidunt aliquam ultricies. Aliquam gravida orci diam, et efficitur velit elementum a. Phasellus sapien justo, sagittis vitae est eu, feugiat feugiat tellus. Aliquam vulputate erat vel metus faucibus tempor. Integer vitae nunc et sapien fermentum rhoncus non vitae metus. Interdum et malesuada fames ac ante ipsum primis in faucibus. In commodo sapien quis risus molestie sagittis. Nam faucibus nec urna dignissim tincidunt. Proin sed laoreet tortor. Sed ornare egestas molestie.',3,'',1,23,'2015-02-20 03:23:18','23',1),(9,'Ελλάδα','Nullam dapibus lectus tellus, a dignissim felis accumsan a. Mauris sem odio, mattis bibendum commodo ut, posuere a mi. Curabitur non orci ut leo tempor molestie. Aenean molestie sagittis orci vel bibendum. Duis vitae felis libero. Proin porta leo id scelerisque commodo. Phasellus ac pretium dui. Aliquam faucibus purus velit, lobortis consectetur mauris eleifend eget.',2,'',1,23,'2015-02-20 03:23:18','23',1);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artpics`
--

DROP TABLE IF EXISTS `artpics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artpics` (
  `art_id` int(11) NOT NULL,
  `art_filename` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artpics`
--

LOCK TABLES `artpics` WRITE;
/*!40000 ALTER TABLE `artpics` DISABLE KEYS */;
INSERT INTO `artpics` VALUES (1,'0101.jpg'),(1,'0102.jpg'),(1,'0103.jpg'),(2,'0201.jpg'),(2,'0202.jpg'),(2,'0203.jpg'),(3,'0301.jpg'),(3,'0302.jpg'),(4,'0401.jpg'),(4,'0402.png'),(4,'0403.jpg'),(5,'0501.jpg'),(5,'0502.jpg'),(6,'0601.jpg'),(6,'0602.jpg'),(7,'0701.jpg'),(7,'0702.jpg'),(7,'0703.png'),(8,'0801.jpg'),(8,'0802.png'),(8,'0803.jpg'),(9,'0901.jpg'),(9,'0902.png');
/*!40000 ALTER TABLE `artpics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genre` (
  `gen_id` int(11) NOT NULL AUTO_INCREMENT,
  `gen_name` varchar(45) NOT NULL,
  PRIMARY KEY (`gen_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre`
--

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` VALUES (1,'Θετικός'),(2,'Αρνητικός');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newscat`
--

DROP TABLE IF EXISTS `newscat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newscat` (
  `nc_id` int(10) NOT NULL AUTO_INCREMENT,
  `nc_name` varchar(50) NOT NULL,
  PRIMARY KEY (`nc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newscat`
--

LOCK TABLES `newscat` WRITE;
/*!40000 ALTER TABLE `newscat` DISABLE KEYS */;
INSERT INTO `newscat` VALUES (1,'Κόσμος'),(2,'Ελλάδα'),(3,'Εργασία'),(4,'Ψυχαγωγία'),(5,'Αθλητικά'),(6,'Επιστήμη και Τεχνολογία'),(7,'Πολιτική');
/*!40000 ALTER TABLE `newscat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `sts_id` int(11) NOT NULL AUTO_INCREMENT,
  `sts_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`sts_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'Draft'),(2,'Live');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `Usr_ID` int(10) NOT NULL AUTO_INCREMENT,
  `Usr_Username` varchar(20) DEFAULT NULL,
  `Usr_Password` varchar(20) DEFAULT NULL,
  `Usr_Lastname` varchar(20) DEFAULT NULL,
  `Usr_Firstname` varchar(20) DEFAULT NULL,
  `Usr_Email` varchar(30) DEFAULT NULL,
  `Usr_Phone` varchar(20) DEFAULT NULL,
  `Usr_Mobile` varchar(20) DEFAULT NULL,
  `Usr_Role_Admin` varchar(5) DEFAULT NULL,
  `Usr_Role_Editor` varchar(5) DEFAULT NULL,
  `Usr_Role_Writer` varchar(5) DEFAULT NULL,
  `Usr_Status` varchar(10) DEFAULT NULL,
  `Usr_Prefs` int(11) DEFAULT NULL,
  PRIMARY KEY (`Usr_ID`),
  UNIQUE KEY `Usr_Username_UNIQUE` (`Usr_Username`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (21,'1','1','Νίκος','Αντωνίου',NULL,NULL,NULL,'True',NULL,NULL,NULL,1),(22,'2','2','Βασίλης','Κώτσης',NULL,NULL,NULL,NULL,'True',NULL,NULL,1),(23,'3','3','Σπύρος','Σταθάκης',NULL,NULL,NULL,NULL,NULL,'True',NULL,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'news_m314007'
--

--
-- Dumping routines for database 'news_m314007'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-02-21 10:08:23
