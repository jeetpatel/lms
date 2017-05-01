-- noinspection SqlNoDataSourceInspectionForFile

-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: lrmv1
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.10-MariaDB

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
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`,`ip_address`,`user_agent`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sitesettings`
--

DROP TABLE IF EXISTS `sitesettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sitesettings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(45) DEFAULT NULL,
  `site_phone` varchar(10) DEFAULT NULL,
  `site_email` varchar(45) DEFAULT NULL,
  `site_address` varchar(512) DEFAULT NULL,
  `site_city` varchar(45) DEFAULT NULL,
  `site_state` varchar(45) DEFAULT NULL,
  `site_country` varchar(45) DEFAULT NULL,
  `site_pincode` varchar(10) DEFAULT NULL,
  `site_currency` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sitesettings`
--

LOCK TABLES `sitesettings` WRITE;
/*!40000 ALTER TABLE `sitesettings` DISABLE KEYS */;
INSERT INTO `sitesettings` VALUES (1,'LAB MANAGEMENT','7386896258','medlab@gmail.com','1391, 3rd floor','hyderabad','telangana','india','500090','$');
/*!40000 ALTER TABLE `sitesettings` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(24) DEFAULT NULL,
  `email` varchar(160) NOT NULL,
  `password` varchar(60) DEFAULT NULL,
  `createdon` datetime NOT NULL,
  `verifiedon` datetime DEFAULT NULL,
  `lastsignedinon` datetime DEFAULT NULL,
  `resetsenton` datetime DEFAULT NULL,
  `deletedon` datetime DEFAULT NULL,
  `suspendedon` datetime DEFAULT NULL,
  `verificationstatus` enum('active','inactive') NOT NULL DEFAULT 'active',
  `verificationcode` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (1,'admin','admin@lms.com','$2a$08$kNiy3tfhwSj8ifs96qgbpuCFgjYnbuTPRKTMO8jvClczbOlNa7fj6','2015-08-27 10:33:19',NULL,'2016-03-22 08:01:40','2016-03-22 07:04:26',NULL,NULL,'active',NULL),(3,'staff','staff@lms.com','$2a$08$ixd.Bu8gYb8NP1/BjbbeTuhB1JCBEoXnDlPAmYduZYXjj46QKM9du','2016-03-17 10:32:08',NULL,'2016-03-21 20:01:54',NULL,NULL,NULL,'active',NULL);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `account_details`
--

DROP TABLE IF EXISTS `account_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account_details` (
  `account_id` bigint(20) unsigned NOT NULL,
  `fullname` varchar(160) DEFAULT NULL,
  `firstname` varchar(80) DEFAULT NULL,
  `lastname` varchar(80) DEFAULT NULL,
  `dateofbirth` varchar(20) DEFAULT NULL,
  `gender` enum('M','F','O') DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `address` varchar(512) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `postalcode` varchar(40) DEFAULT NULL,
  `country` char(2) DEFAULT NULL,
  `language` char(2) DEFAULT NULL,
  `timezone` varchar(40) DEFAULT NULL,
  `citimezone` varchar(6) DEFAULT NULL,
  `picture` varchar(240) DEFAULT NULL,
  PRIMARY KEY (`account_id`),
  CONSTRAINT `account_details_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_details`
--

LOCK TABLES `account_details` WRITE;
/*!40000 ALTER TABLE `account_details` DISABLE KEYS */;
INSERT INTO `account_details` VALUES (1,'admin','admin',NULL,'2004-01-05','M',NULL,NULL,NULL,NULL,'500090','in','te','Asia/Kolkata',NULL,NULL),(3,'staff','staff',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `account_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_permission`
--

DROP TABLE IF EXISTS `acl_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_permission` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suspendedon` datetime DEFAULT NULL,
  `is_system` tinyint(1) NOT NULL DEFAULT '1',
  `system_access_only` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_permission`
--

LOCK TABLES `acl_permission` WRITE;
/*!40000 ALTER TABLE `acl_permission` DISABLE KEYS */;
INSERT INTO `acl_permission` VALUES (15,'manage_appointments','Using this module one can mange appointments',NULL,1,0),(16,'manage_doctors','Using this module one can manage doctors',NULL,1,0),(17,'manage_tests','Using this module one can manage tests',NULL,1,0),(18,'manage_sitesettings','Using this module one can manage site settings informations',NULL,1,0),(19,'manage_users','Using this module one can manage users',NULL,1,0),(20,'manage_roles','Using this module one can manage roles',NULL,1,0),(21,'manage_permissions','Using this module one can manage permissions to users',NULL,1,0),(22,'reports','Reports module gives over all business financial and appointments informations',NULL,1,0),(23,'manage_emailsettings','Using this module one can manage email communications of the business',NULL,1,0);
/*!40000 ALTER TABLE `acl_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_role`
--

DROP TABLE IF EXISTS `acl_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_role` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suspendedon` datetime DEFAULT NULL,
  `is_system` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_role`
--

LOCK TABLES `acl_role` WRITE;
/*!40000 ALTER TABLE `acl_role` DISABLE KEYS */;
INSERT INTO `acl_role` VALUES (1,'Admin','Website Administrator',NULL,1),(3,'Staff','Staff is an employee under administrator who has access to the system to  manage operations based on permissions given by administrator.',NULL,1);
/*!40000 ALTER TABLE `acl_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `reference_no` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` enum('male','female','others') NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email_id` varchar(100) DEFAULT NULL,
  `test` int(11) NOT NULL,
  `test_price` decimal(10,2) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `sample_collection_time` varchar(45) NOT NULL,
  `appointment_date` date NOT NULL,
  `doctor_ref_by` varchar(100) NOT NULL,
  `appointment_status` enum('pending','inprogress','generated','cancelled') DEFAULT 'pending',
  `report_doc` varchar(250) DEFAULT NULL,
  `payment_status` enum('unpaid','paid') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='all the appointments are stored in this table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surname` varchar(100) NOT NULL,
  `name` varchar(250) NOT NULL,
  `medical_licence_no` varchar(50) NOT NULL,
  `specialization` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctors`
--

LOCK TABLES `doctors` WRITE;
/*!40000 ALTER TABLE `doctors` DISABLE KEYS */;
/*!40000 ALTER TABLE `doctors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_settings`
--

DROP TABLE IF EXISTS `email_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocol` varchar(45) DEFAULT NULL,
  `path_to_send_mail` varchar(512) NOT NULL,
  `smtp_host` varchar(512) NOT NULL,
  `smtp_port` varchar(512) NOT NULL,
  `smtp_user` varchar(512) NOT NULL,
  `smtp_password` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_settings`
--

LOCK TABLES `email_settings` WRITE;
/*!40000 ALTER TABLE `email_settings` DISABLE KEYS */;
INSERT INTO `email_settings` VALUES (1,'smtp','/usr/sbin/smtp','smtp.gmail.com','465','developer.kalyankrishna@gmail.com','');
/*!40000 ALTER TABLE `email_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_country`
--

DROP TABLE IF EXISTS `ref_country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_country` (
  `alpha2` char(2) NOT NULL,
  `alpha3` char(3) NOT NULL,
  `numeric` varchar(3) NOT NULL,
  `country` varchar(80) NOT NULL,
  PRIMARY KEY (`alpha2`),
  UNIQUE KEY `alpha3` (`alpha3`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_country`
--

LOCK TABLES `ref_country` WRITE;
/*!40000 ALTER TABLE `ref_country` DISABLE KEYS */;
INSERT INTO `ref_country` VALUES ('ad','and','020','Andorra'),('ae','are','784','United Arab Emirates'),('af','afg','004','Afghanistan'),('ag','atg','028','Antigua and Barbuda'),('ai','aia','660','Anguilla'),('al','alb','008','Albania'),('am','arm','051','Armenia'),('an','ant','530','Netherlands Antilles'),('ao','ago','024','Angola'),('aq','ata','010','Antarctica'),('ar','arg','032','Argentina'),('as','asm','016','American Samoa'),('at','aut','040','Austria'),('au','aus','036','Australia'),('aw','abw','533','Aruba'),('ax','ala','248','Åland Islands'),('az','aze','031','Azerbaijan'),('ba','bih','070','Bosnia and Herzegovina'),('bb','brb','052','Barbados'),('bd','bgd','050','Bangladesh'),('be','bel','056','Belgium'),('bf','bfa','854','Burkina Faso'),('bg','bgr','100','Bulgaria'),('bh','bhr','048','Bahrain'),('bi','bdi','108','Burundi'),('bj','ben','204','Benin'),('bl','blm','652','Saint Barthélemy'),('bm','bmu','060','Bermuda'),('bn','brn','096','Brunei Darussalam'),('bo','bol','068','Bolivia, Plurinational State of'),('br','bra','076','Brazil'),('bs','bhs','044','Bahamas'),('bt','btn','064','Bhutan'),('bv','bvt','074','Bouvet Island'),('bw','bwa','072','Botswana'),('by','blr','112','Belarus'),('bz','blz','084','Belize'),('ca','can','124','Canada'),('cc','cck','166','Cocos (Keeling) Islands'),('cd','cod','180','Congo, the Democratic Republic of the'),('cf','caf','140','Central African Republic'),('cg','cog','178','Congo'),('ch','che','756','Switzerland'),('ci','civ','384','Côte d\'Ivoire'),('ck','cok','184','Cook Islands'),('cl','chl','152','Chile'),('cm','cmr','120','Cameroon'),('cn','chn','156','China'),('co','col','170','Colombia'),('cr','cri','188','Costa Rica'),('cu','cub','192','Cuba'),('cv','cpv','132','Cape Verde'),('cx','cxr','162','Christmas Island'),('cy','cyp','196','Cyprus'),('cz','cze','203','Czech Republic'),('de','deu','276','Germany'),('dj','dji','262','Djibouti'),('dk','dnk','208','Denmark'),('dm','dma','212','Dominica'),('do','dom','214','Dominican Republic'),('dz','dza','012','Algeria'),('ec','ecu','218','Ecuador'),('ee','est','233','Estonia'),('eg','egy','818','Egypt'),('eh','esh','732','Western Sahara'),('er','eri','232','Eritrea'),('es','esp','724','Spain'),('et','eth','231','Ethiopia'),('fi','fin','246','Finland'),('fj','fji','242','Fiji'),('fk','flk','238','Falkland Islands (Malvinas)'),('fm','fsm','583','Micronesia, Federated States of'),('fo','fro','234','Faroe Islands'),('fr','fra','250','France'),('ga','gab','266','Gabon'),('gb','gbr','826','United Kingdom'),('gd','grd','308','Grenada'),('ge','geo','268','Georgia'),('gf','guf','254','French Guiana'),('gg','ggy','831','Guernsey'),('gh','gha','288','Ghana'),('gi','gib','292','Gibraltar'),('gl','grl','304','Greenland'),('gm','gmb','270','Gambia'),('gn','gin','324','Guinea'),('gp','glp','312','Guadeloupe'),('gq','gnq','226','Equatorial Guinea'),('gr','grc','300','Greece'),('gs','sgs','239','South Georgia and the South Sandwich Islands'),('gt','gtm','320','Guatemala'),('gu','gum','316','Guam'),('gw','gnb','624','Guinea-Bissau'),('gy','guy','328','Guyana'),('hk','hkg','344','Hong Kong'),('hm','hmd','334','Heard Island and McDonald Islands'),('hn','hnd','340','Honduras'),('hr','hrv','191','Croatia'),('ht','hti','332','Haiti'),('hu','hun','348','Hungary'),('id','idn','360','Indonesia'),('ie','irl','372','Ireland'),('il','isr','376','Israel'),('im','imn','833','Isle of Man'),('in','ind','356','India'),('io','iot','086','British Indian Ocean Territory'),('iq','irq','368','Iraq'),('ir','irn','364','Iran, Islamic Republic of'),('is','isl','352','Iceland'),('it','ita','380','Italy'),('je','jey','832','Jersey'),('jm','jam','388','Jamaica'),('jo','jor','400','Jordan'),('jp','jpn','392','Japan'),('ke','ken','404','Kenya'),('kg','kgz','417','Kyrgyzstan'),('kh','khm','116','Cambodia'),('ki','kir','296','Kiribati'),('km','com','174','Comoros'),('kn','kna','659','Saint Kitts and Nevis'),('kp','prk','408','Korea, Democratic People\'s Republic of'),('kr','kor','410','Korea, Republic of'),('kw','kwt','414','Kuwait'),('ky','cym','136','Cayman Islands'),('kz','kaz','398','Kazakhstan'),('la','lao','418','Lao People\'s Democratic Republic'),('lb','lbn','422','Lebanon'),('lc','lca','662','Saint Lucia'),('li','lie','438','Liechtenstein'),('lk','lka','144','Sri Lanka'),('lr','lbr','430','Liberia'),('ls','lso','426','Lesotho'),('lt','ltu','440','Lithuania'),('lu','lux','442','Luxembourg'),('lv','lva','428','Latvia'),('ly','lby','434','Libyan Arab Jamahiriya'),('ma','mar','504','Morocco'),('mc','mco','492','Monaco'),('md','mda','498','Moldova, Republic of'),('me','mne','499','Montenegro'),('mf','maf','663','Saint Martin (French part)'),('mg','mdg','450','Madagascar'),('mh','mhl','584','Marshall Islands'),('mk','mkd','807','Macedonia, the former Yugoslav Republic of'),('ml','mli','466','Mali'),('mm','mmr','104','Myanmar'),('mn','mng','496','Mongolia'),('mo','mac','446','Macao'),('mp','mnp','580','Northern Mariana Islands'),('mq','mtq','474','Martinique'),('mr','mrt','478','Mauritania'),('ms','msr','500','Montserrat'),('mt','mlt','470','Malta'),('mu','mus','480','Mauritius'),('mv','mdv','462','Maldives'),('mw','mwi','454','Malawi'),('mx','mex','484','Mexico'),('my','mys','458','Malaysia'),('mz','moz','508','Mozambique'),('na','nam','516','Namibia'),('nc','ncl','540','New Caledonia'),('ne','ner','562','Niger'),('nf','nfk','574','Norfolk Island'),('ng','nga','566','Nigeria'),('ni','nic','558','Nicaragua'),('nl','nld','528','Netherlands'),('no','nor','578','Norway'),('np','npl','524','Nepal'),('nr','nru','520','Nauru'),('nu','niu','570','Niue'),('nz','nzl','554','New Zealand'),('om','omn','512','Oman'),('pa','pan','591','Panama'),('pe','per','604','Peru'),('pf','pyf','258','French Polynesia'),('pg','png','598','Papua New Guinea'),('ph','phl','608','Philippines'),('pk','pak','586','Pakistan'),('pl','pol','616','Poland'),('pm','spm','666','Saint Pierre and Miquelon'),('pn','pcn','612','Pitcairn'),('pr','pri','630','Puerto Rico'),('ps','pse','275','Palestinian Territory, Occupied'),('pt','prt','620','Portugal'),('pw','plw','585','Palau'),('py','pry','600','Paraguay'),('qa','qat','634','Qatar'),('re','reu','638','Réunion'),('ro','rou','642','Romania'),('rs','srb','688','Serbia'),('ru','rus','643','Russian Federation'),('rw','rwa','646','Rwanda'),('sa','sau','682','Saudi Arabia'),('sb','slb','090','Solomon Islands'),('sc','syc','690','Seychelles'),('sd','sdn','736','Sudan'),('se','swe','752','Sweden'),('sg','sgp','702','Singapore'),('sh','shn','654','Saint Helena'),('si','svn','705','Slovenia'),('sj','sjm','744','Svalbard and Jan Mayen'),('sk','svk','703','Slovakia'),('sl','sle','694','Sierra Leone'),('sm','smr','674','San Marino'),('sn','sen','686','Senegal'),('so','som','706','Somalia'),('sr','sur','740','Suriname'),('st','stp','678','Sao Tome and Principe'),('sv','slv','222','El Salvador'),('sy','syr','760','Syrian Arab Republic'),('sz','swz','748','Swaziland'),('tc','tca','796','Turks and Caicos Islands'),('td','tcd','148','Chad'),('tf','atf','260','French Southern Territories'),('tg','tgo','768','Togo'),('th','tha','764','Thailand'),('tj','tjk','762','Tajikistan'),('tk','tkl','772','Tokelau'),('tl','tls','626','Timor-Leste'),('tm','tkm','795','Turkmenistan'),('tn','tun','788','Tunisia'),('to','ton','776','Tonga'),('tr','tur','792','Turkey'),('tt','tto','780','Trinidad and Tobago'),('tv','tuv','798','Tuvalu'),('tw','twn','158','Taiwan, Province of China'),('tz','tza','834','Tanzania, United Republic of'),('ua','ukr','804','Ukraine'),('ug','uga','800','Uganda'),('um','umi','581','United States Minor Outlying Islands'),('us','usa','840','United States'),('uy','ury','858','Uruguay'),('uz','uzb','860','Uzbekistan'),('va','vat','336','Holy See (Vatican City State)'),('vc','vct','670','Saint Vincent and the Grenadines'),('ve','ven','862','Venezuela, Bolivarian Republic of'),('vg','vgb','092','Virgin Islands, British'),('vi','vir','850','Virgin Islands, U.S.'),('vn','vnm','704','Viet Nam'),('vu','vut','548','Vanuatu'),('wf','wlf','876','Wallis and Futuna'),('ws','wsm','882','Samoa'),('ye','yem','887','Yemen'),('yt','myt','175','Mayotte'),('za','zaf','710','South Africa'),('zm','zmb','894','Zambia'),('zw','zwe','716','Zimbabwe');
/*!40000 ALTER TABLE `ref_country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_currency`
--

DROP TABLE IF EXISTS `ref_currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_currency` (
  `alpha` char(3) NOT NULL,
  `numeric` varchar(3) DEFAULT NULL,
  `currency` varchar(80) NOT NULL,
  PRIMARY KEY (`alpha`),
  KEY `numeric` (`numeric`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_currency`
--

LOCK TABLES `ref_currency` WRITE;
/*!40000 ALTER TABLE `ref_currency` DISABLE KEYS */;
INSERT INTO `ref_currency` VALUES ('AED','784','UAE Dirham'),('AFN','971','Afghani'),('ALL','8','Lek'),('AMD','51','Armenian Dram'),('ANG','532','Netherlands Antillian Guilder'),('AOA','973','Kwanza'),('ARS','32','Argentine Peso'),('AUD','36','Australian Dollar'),('AWG','533','Aruban Guilder'),('AZN','944','Azerbaijanian Manat'),('BAM','977','Convertible Marks'),('BBD','52','Barbados Dollar'),('BDT','50','Taka'),('BGN','975','Bulgarian Lev'),('BHD','48','Bahraini Dinar'),('BIF','108','Burundi Franc'),('BMD','60','Bermudian Dollar (customarily known as Bermuda Dollar)'),('BND','96','Brunei Dollar'),('BOB','68','Boliviano'),('BOV','984','Mvdol'),('BRL','986','Brazilian Real'),('BSD','44','Bahamian Dollar'),('BTN','64','Ngultrum'),('BWP','72','Pula'),('BYR','974','Belarussian Ruble'),('BZD','84','Belize Dollar'),('CAD','124','Canadian Dollar'),('CDF','976','Congolese Franc'),('CHE','947','WIR Euro'),('CHF','756','Swiss Franc'),('CHW','948','WIR Franc'),('CLF','990','Unidades de fomento'),('CLP','152','Chilean Peso'),('CNY','156','Yuan Renminbi'),('COP','170','Colombian Peso'),('COU','970','Unidad de Valor Real'),('CRC','188','Costa Rican Colon'),('CUC','931','Peso Convertible'),('CUP','192','Cuban Peso'),('CVE','132','Cape Verde Escudo'),('CZK','203','Czech Koruna'),('DJF','262','Djibouti Franc'),('DKK','208','Danish Krone'),('DOP','214','Dominican Peso'),('DZD','12','Algerian Dinar'),('EEK','233','Kroon'),('EGP','818','Egyptian Pound'),('ERN','232','Nakfa'),('ETB','230','Ethiopian Birr'),('EUR','978','Euro'),('FJD','242','Fiji Dollar'),('FKP','238','Falkland Islands Pound'),('GBP','826','Pound Sterling'),('GEL','981','Lari'),('GHS','936','Cedi'),('GIP','292','Gibraltar Pound'),('GMD','270','Dalasi'),('GNF','324','Guinea Franc'),('GTQ','320','Quetzal'),('GWP','624','Guinea-Bissau Peso'),('GYD','328','Guyana Dollar'),('HKD','344','Hong Kong Dollar'),('HNL','340','Lempira'),('HRK','191','Croatian Kuna'),('HTG','332','Gourde'),('HUF','348','Forint'),('IDR','360','Rupiah'),('ILS','376','New Israeli Sheqel'),('INR','356','Indian Rupee'),('IQD','368','Iraqi Dinar'),('IRR','364','Iranian Rial'),('ISK','352','Iceland Krona'),('JMD','388','Jamaican Dollar'),('JOD','400','Jordanian Dinar'),('JPY','392','Yen'),('KES','404','Kenyan Shilling'),('KGS','417','Som'),('KHR','116','Riel'),('KMF','174','Comoro Franc'),('KPW','408','North Korean Won'),('KRW','410','Won'),('KWD','414','Kuwaiti Dinar'),('KYD','136','Cayman Islands Dollar'),('KZT','398','Tenge'),('LAK','418','Kip'),('LBP','422','Lebanese Pound'),('LKR','144','Sri Lanka Rupee'),('LRD','430','Liberian Dollar'),('LSL','426','Loti'),('LTL','440','Lithuanian Litas'),('LVL','428','Latvian Lats'),('LYD','434','Libyan Dinar'),('MAD','504','Moroccan Dirham'),('MDL','498','Moldovan Leu'),('MGA','969','Malagasy Ariary'),('MKD','807','Denar'),('MMK','104','Kyat'),('MNT','496','Tugrik'),('MOP','446','Pataca'),('MRO','478','Ouguiya'),('MUR','480','Mauritius Rupee'),('MVR','462','Rufiyaa'),('MWK','454','Kwacha'),('MXN','484','Mexican Peso'),('MXV','979','Mexican Unidad de Inversion (UDI)'),('MYR','458','Malaysian Ringgit'),('MZN','943','Metical'),('NAD','516','Namibia Dollar'),('NGN','566','Naira'),('NIO','558','Cordoba Oro'),('NOK','578','Norwegian Krone'),('NPR','524','Nepalese Rupee'),('NZD','554','New Zealand Dollar'),('OMR','512','Rial Omani'),('PAB','590','Balboa'),('PEN','604','Nuevo Sol'),('PGK','598','Kina'),('PHP','608','Philippine Peso'),('PKR','586','Pakistan Rupee'),('PLN','985','Zloty'),('PYG','600','Guarani'),('QAR','634','Qatari Rial'),('RON','946','New Leu'),('RSD','941','Serbian Dinar'),('RUB','643','Russian Ruble'),('RWF','646','Rwanda Franc'),('SAR','682','Saudi Riyal'),('SBD','90','Solomon Islands Dollar'),('SCR','690','Seychelles Rupee'),('SDG','938','Sudanese Pound'),('SEK','752','Swedish Krona'),('SGD','702','Singapore Dollar'),('SHP','654','Saint Helena Pound'),('SLL','694','Leone'),('SOS','706','Somali Shilling'),('SRD','968','Surinam Dollar'),('STD','678','Dobra'),('SVC','222','El Salvador Colon'),('SYP','760','Syrian Pound'),('SZL','748','Lilangeni'),('THB','764','Baht'),('TJS','972','Somoni'),('TMT','934','Manat'),('TND','788','Tunisian Dinar'),('TOP','776','Pa\'anga'),('TRY','949','Turkish Lira'),('TTD','780','Trinidad and Tobago Dollar'),('TWD','901','New Taiwan Dollar'),('TZS','834','Tanzanian Shilling'),('UAH','980','Hryvnia'),('UGX','800','Uganda Shilling'),('USD','840','US Dollar'),('USN','997','US Dollar (Next day)'),('USS','998','US Dollar (Same day)'),('UYI','940','Uruguay Peso en Unidades Indexadas'),('UYU','858','Peso Uruguayo'),('UZS','860','Uzbekistan Sum'),('VEF','937','Bolivar Fuerte'),('VND','704','Dong'),('VUV','548','Vatu'),('WST','882','Tala'),('XAF','950','CFA Franc BEAC'),('XAG','961','Silver'),('XAU','959','Gold'),('XBA','955','Bond Markets Units European Composite Unit (EURCO)'),('XBB','956','European Monetary Unit (E.M.U.-6)'),('XBC','957','European Unit of Account 9 (E.U.A.-9)'),('XBD','958','European Unit of Account 17 (E.U.A.-17)'),('XCD','951','East Caribbean Dollar'),('XDR','960','SDR'),('XFU',NULL,'UIC-Franc'),('XOF','952','CFA Franc BCEAO'),('XPD','964','Palladium'),('XPF','953','CFP Franc'),('XPT','962','Platinum'),('XTS','963','Codes specifically reserved for testing purposes'),('XXX','999','Codes assigned for transactions where no currency is involved'),('YER','886','Yemeni Rial'),('ZAR','710','Rand'),('ZMK','894','Zambian Kwacha'),('ZWL','932','Zimbabwe Dollar');
/*!40000 ALTER TABLE `ref_currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_language`
--

DROP TABLE IF EXISTS `ref_language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_language` (
  `one` char(2) NOT NULL,
  `two` char(3) NOT NULL,
  `language` varchar(120) NOT NULL,
  `native` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`one`),
  KEY `two` (`two`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_language`
--

LOCK TABLES `ref_language` WRITE;
/*!40000 ALTER TABLE `ref_language` DISABLE KEYS */;
INSERT INTO `ref_language` VALUES ('aa','aar','Afar','Afaraf'),('ab','abk','Abkhazian','Аҧсуа'),('ae','ave','Avestan','avesta'),('af','afr','Afrikaans','Afrikaans'),('ak','aka','Akan','Akan'),('am','amh','Amharic',NULL),('an','arg','Aragonese','Aragonés'),('ar','ara','Arabic','العربية'),('as','asm','Assamese',NULL),('av','ava','Avaric','авар мацӀ, магӀарул мацӀ'),('ay','aym','Aymara','aymar aru'),('az','aze','Azerbaijani','azərbaycan dili'),('ba','bak','Bashkir','башҡорт теле'),('be','bel','Belarusian','Беларуская'),('bg','bul','Bulgarian','български език'),('bh','bih','Bihari','भोजपुरी'),('bi','bis','Bislama','Bislama'),('bm','bam','Bambara','bamanankan'),('bn','ben','Bengali',NULL),('bo','bod','Tibetan',NULL),('br','bre','Breton','brezhoneg'),('bs','bos','Bosnian','bosanski jezik'),('ca','cat','Catalan, Valencian','Català'),('ce','che','Chechen','нохчийн мотт'),('ch','cha','Chamorro','Chamoru'),('co','cos','Corsican','corsu, lingua corsa'),('cr','cre','Cree',NULL),('cs','ces','Czech','česky, čeština'),('cu','chu','Old Church Slavonic, Old Bulgarian','ѩзыкъ словѣньскъ'),('cv','chv','Chuvash','чӑваш чӗлхи'),('cy','cym','Welsh','Cymraeg'),('da','dan','Danish','dansk'),('de','deu','German','Deutsch'),('dv','div','Divehi, Dhivehi, Maldivian','ދިވެހި'),('dz','dzo','Dzongkha',NULL),('ee','ewe','Ewe','Eʋegbe'),('el','ell','Modern Greek','Ελληνικά'),('en','eng','English','English'),('eo','epo','Esperanto','Esperanto'),('es','spa','Spanish, Castilian','español, castellano'),('et','est','Estonian','eesti, eesti keel'),('eu','eus','Basque','euskara, euskera'),('fa','fas','Persian','فارسی'),('ff','ful','Fulah','Fulfulde, Pulaar, Pular'),('fi','fin','Finnish','suomi, suomen kieli'),('fj','fij','Fijian','vosa Vakaviti'),('fo','fao','Faroese','føroyskt'),('fr','fra','French','français, langue française'),('fy','fry','Western Frisian','Frysk'),('ga','gle','Irish','Gaeilge'),('gd','gla','Gaelic, Scottish Gaelic','Gàidhlig'),('gl','glg','Galician','Galego'),('gn','grn','Guaraní','Avañe\'ẽ'),('gu','guj','Gujarati','ગુજરાતી'),('gv','glv','Manx','Gaelg, Gailck'),('ha','hau','Hausa','Hausa, هَوُسَ'),('he','heb','Modern Hebrew','עברית'),('hi','hin','Hindi','हिन्दी, हिंदी'),('ho','hmo','Hiri Motu','Hiri Motu'),('hr','hrv','Croatian','hrvatski'),('ht','hat','Haitian, Haitian Creole','Kreyòl ayisyen'),('hu','hun','Hungarian','Magyar'),('hy','hye','Armenian','Հայերեն'),('hz','her','Herero','Otjiherero'),('ia','ina','Interlingua (IALA)','Interlingua'),('id','ind','Indonesian','Bahasa Indonesia'),('ie','ile','Interlingue, Occidental','Interlingue'),('ig','ibo','Igbo','Igbo'),('ii','iii','Sichuan Yi, Nuosu',NULL),('ik','ipk','Inupiaq','Iñupiaq, Iñupiatun'),('io','ido','Ido','Ido'),('is','isl','Icelandic','Íslenska'),('it','ita','Italian','Italiano'),('iu','iku','Inuktitut',NULL),('ja','jpn','Japanese','日本語 (にほんご／にっぽんご)'),('jv','jav','Javanese','basa Jawa'),('ka','kat','Georgian','ქართული'),('kg','kon','Kongo','KiKongo'),('ki','kik','Kikuyu, Gikuyu','Gĩkũyũ'),('kj','kua','Kwanyama, Kuanyama','Kuanyama'),('kk','kaz','Kazakh','Қазақ тілі'),('kl','kal','Kalaallisut, Greenlandic','kalaallisut, kalaallit oqaasii'),('km','khm','Central Khmer',NULL),('kn','kan','Kannada','ಕನ್ನಡ'),('ko','kor','Korean','한국어 (韓國語), 조선말 (朝鮮語)'),('kr','kau','Kanuri','Kanuri'),('ks','kas','Kashmiri','कश्मीरी, كشميري‎'),('ku','kur','Kurdish','Kurdî, كوردی‎'),('kv','kom','Komi','коми кыв'),('kw','cor','Cornish','Kernewek'),('ky','kir','Kirghiz, Kyrgyz','кыргыз тили'),('la','lat','Latin','latine, lingua latina'),('lb','ltz','Luxembourgish, Letzeburgesch','Lëtzebuergesch'),('lg','lug','Ganda','Luganda'),('li','lim','Limburgish, Limburgan, Limburger','Limburgs'),('ln','lin','Lingala','Lingála'),('lo','lao','Lao',NULL),('lt','lit','Lithuanian','lietuvių kalba'),('lu','lub','Luba-Katanga',NULL),('lv','lav','Latvian','latviešu valoda'),('mg','mlg','Malagasy','Malagasy fiteny'),('mh','mah','Marshallese','Kajin M̧ajeļ'),('mi','mri','Māori','te reo Māori'),('mk','mkd','Macedonian','македонски јазик'),('ml','mal','Malayalam',NULL),('mn','mon','Mongolian','Монгол'),('mr','mar','Marathi','मराठी'),('ms','msa','Malay','bahasa Melayu, بهاس ملايو‎'),('mt','mlt','Maltese','Malti'),('my','mya','Burmese',NULL),('na','nau','Nauru','Ekakairũ Naoero'),('nb','nob','Norwegian Bokmål','Norsk bokmål'),('nd','nde','North Ndebele','isiNdebele'),('ne','nep','Nepali','नेपाली'),('ng','ndo','Ndonga','Owambo'),('nl','nld','Dutch, Flemish','Nederlands, Vlaams'),('nn','nno','Norwegian Nynorsk','Norsk nynorsk'),('no','nor','Norwegian','Norsk'),('nr','nbl','South Ndebele','isiNdebele'),('nv','nav','Navajo, Navaho','Diné bizaad, Dinékʼehǰí'),('ny','nya','Chichewa, Chewa, Nyanja','chiCheŵa, chinyanja'),('oc','oci','Occitan (after 1500)','Occitan'),('oj','oji','Ojibwa',NULL),('om','orm','Oromo','Afaan Oromoo'),('or','ori','Oriya',NULL),('os','oss','Ossetian, Ossetic','Ирон æвзаг'),('pa','pan','Panjabi, Punjabi','ਪੰਜਾਬੀ, پنجابی‎'),('pi','pli','Pāli','पाऴि'),('pl','pol','Polish','polski'),('ps','pus','Pashto, Pushto','پښتو'),('pt','por','Portuguese','Português'),('qu','que','Quechua','Runa Simi, Kichwa'),('rm','roh','Romansh','rumantsch grischun'),('rn','run','Rundi','kiRundi'),('ro','ron','Romanian, Moldavian, Moldovan','română'),('ru','rus','Russian','Русский язык'),('rw','kin','Kinyarwanda','Ikinyarwanda'),('sa','san','Sanskrit','संस्कृतम्'),('sc','srd','Sardinian','sardu'),('sd','snd','Sindhi','सिन्धी, سنڌي، سندھی‎'),('se','sme','Northern Sami','Davvisámegiella'),('sg','sag','Sango','yângâ tî sängö'),('si','sin','Sinhala, Sinhalese',NULL),('sk','slk','Slovak','slovenčina'),('sl','slv','Slovene','slovenščina'),('sm','smo','Samoan','gagana fa\'a Samoa'),('sn','sna','Shona','chiShona'),('so','som','Somali','Soomaaliga, af Soomaali'),('sq','sqi','Albanian','Shqip'),('sr','srp','Serbian','српски језик'),('ss','ssw','Swati','SiSwati'),('st','sot','Southern Sotho','Sesotho'),('su','sun','Sundanese','Basa Sunda'),('sv','swe','Swedish','svenska'),('sw','swa','Swahili','Kiswahili'),('ta','tam','Tamil','தமிழ்'),('te','tel','Telugu','తెలుగు'),('tg','tgk','Tajik','тоҷикӣ, toğikī, تاجیکی‎'),('th','tha','Thai','ไทย'),('ti','tir','Tigrinya',NULL),('tk','tuk','Turkmen','Türkmen, Түркмен'),('tl','tgl','Tagalog','Wikang Tagalog'),('tn','tsn','Tswana','Setswana'),('to','ton','Tonga (Tonga Islands)','faka Tonga'),('tr','tur','Turkish','Türkçe'),('ts','tso','Tsonga','Xitsonga'),('tt','tat','Tatar','татарча, tatarça, تاتارچا‎'),('tw','twi','Twi','Twi'),('ty','tah','Tahitian','Reo Mā`ohi'),('ug','uig','Uighur, Uyghur','Uyƣurqə, ئۇيغۇرچە‎'),('uk','ukr','Ukrainian','Українська'),('ur','urd','Urdu','اردو'),('uz','uzb','Uzbek','O\'zbek, Ўзбек, أۇزبېك‎'),('ve','ven','Venda','Tshivenḓa'),('vi','vie','Vietnamese','Tiếng Việt'),('vo','vol','Volapük','Volapük'),('wa','wln','Walloon','Walon'),('wo','wol','Wolof','Wollof'),('xh','xho','Xhosa','isiXhosa'),('yi','yid','Yiddish','ייִדיש'),('yo','yor','Yoruba','Yorùbá'),('za','zha','Zhuang, Chuang','Saɯ cueŋƅ, Saw cuengh'),('zh','zho','Chinese','中文 (Zhōngwén), 汉语, 漢語'),('zu','zul','Zulu','isiZulu');
/*!40000 ALTER TABLE `ref_language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_zoneinfo`
--

DROP TABLE IF EXISTS `ref_zoneinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_zoneinfo` (
  `zoneinfo` varchar(40) NOT NULL,
  `offset` varchar(16) DEFAULT NULL,
  `summer` varchar(16) DEFAULT NULL,
  `country` char(2) NOT NULL,
  `cicode` varchar(6) NOT NULL,
  `cicodesummer` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`zoneinfo`),
  KEY `country` (`country`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_zoneinfo`
--

LOCK TABLES `ref_zoneinfo` WRITE;
/*!40000 ALTER TABLE `ref_zoneinfo` DISABLE KEYS */;
INSERT INTO `ref_zoneinfo` VALUES ('Africa/Abidjan','UTC',NULL,'ci','UTC',NULL),('Africa/Accra','UTC',NULL,'gh','UTC',NULL),('Africa/Addis_Ababa','UTC+3',NULL,'et','UP3',NULL),('Africa/Algiers','UTC+1',NULL,'dz','UP1',NULL),('Africa/Asmara','UTC+3',NULL,'er','UP3',NULL),('Africa/Bamako','UTC',NULL,'ml','UTC',NULL),('Africa/Bangui','UTC+1',NULL,'cf','UP1',NULL),('Africa/Banjul','UTC',NULL,'gm','UTC',NULL),('Africa/Bissau','UTC',NULL,'gw','UTC',NULL),('Africa/Blantyre','UTC+2',NULL,'mw','UP2',NULL),('Africa/Brazzaville','UTC+1',NULL,'cg','UP1',NULL),('Africa/Bujumbura','UTC+2',NULL,'bi','UP2',NULL),('Africa/Cairo','UTC+2',NULL,'eg','UP2',NULL),('Africa/Casablanca','UTC',NULL,'ma','UTC',NULL),('Africa/Ceuta','UTC+1','UTC+2','es','UP1','UP2'),('Africa/Conakry','UTC',NULL,'gn','UTC',NULL),('Africa/Dakar','UTC',NULL,'sn','UTC',NULL),('Africa/Dar_es_Salaam','UTC+3',NULL,'tz','UP3',NULL),('Africa/Djibouti','UTC+3',NULL,'dj','UP3',NULL),('Africa/Douala','UTC+1',NULL,'cm','UP1',NULL),('Africa/El_Aaiun','UTC',NULL,'eh','UTC',NULL),('Africa/Freetown','UTC',NULL,'sl','UTC',NULL),('Africa/Gaborone','UTC+2',NULL,'bw','UP2',NULL),('Africa/Harare','UTC+2',NULL,'zw','UP2',NULL),('Africa/Johannesburg','UTC+2',NULL,'za','UP2',NULL),('Africa/Kampala','UTC+3',NULL,'ug','UP3',NULL),('Africa/Khartoum','UTC+3',NULL,'sd','UP3',NULL),('Africa/Kigali','UTC+2',NULL,'rw','UP2',NULL),('Africa/Kinshasa','UTC+1',NULL,'cd','UP1',NULL),('Africa/Lagos','UTC+1',NULL,'ng','UP1',NULL),('Africa/Libreville','UTC+1',NULL,'ga','UP1',NULL),('Africa/Lome','UTC',NULL,'tg','UTC',NULL),('Africa/Luanda','UTC+1',NULL,'ao','UP1',NULL),('Africa/Lubumbashi','UTC+2',NULL,'cd','UP2',NULL),('Africa/Lusaka','UTC+2',NULL,'zm','UP2',NULL),('Africa/Malabo','UTC+1',NULL,'gq','UP1',NULL),('Africa/Maputo','UTC+2',NULL,'mz','UP2',NULL),('Africa/Maseru','UTC+2',NULL,'ls','UP2',NULL),('Africa/Mbabane','UTC+2',NULL,'sz','UP2',NULL),('Africa/Mogadishu','UTC+3',NULL,'so','UTC3',NULL),('Africa/Monrovia','UTC',NULL,'lr','UTC',NULL),('Africa/Nairobi','UTC+3',NULL,'ke','UP3',NULL),('Africa/Ndjamena','UTC+1',NULL,'td','UP1',NULL),('Africa/Niamey','UTC+1',NULL,'ne','UP1',NULL),('Africa/Nouakchott','UTC',NULL,'mr','UTC',NULL),('Africa/Ouagadougou','UTC',NULL,'bf','UTC',NULL),('Africa/Porto-Novo','UTC+1',NULL,'bj','UP1',NULL),('Africa/Sao_Tome','UTC',NULL,'st','UTC',NULL),('Africa/Tripoli','UTC+2',NULL,'ly','UP2',NULL),('Africa/Tunis','UTC+1','UTC+2','tn','UP1','UP2'),('Africa/Windhoek','UTC+1','UTC+2','na','UP1','UP2'),('America/Adak','UTC-10','UTC-9','us','UM10','UM9'),('America/Anchorage','UTC-9','UTC-8','us','UM9','UM8'),('America/Anguilla','UTC-4',NULL,'ai','UM4',NULL),('America/Antigua','UTC-4',NULL,'ag','UM4',NULL),('America/Araguaina','UTC-3',NULL,'br','UM3',NULL),('America/Argentina/Buenos_Aires','UTC-3','UTC-2','ar','UM3','UM2'),('America/Argentina/Catamarca','UTC-3',NULL,'ar','UM3',NULL),('America/Argentina/Cordoba','UTC-3','UTC-2','ar','UM3','UM2'),('America/Argentina/Jujuy','UTC-3',NULL,'ar','UM3',NULL),('America/Argentina/La_Rioja','UTC-3',NULL,'ar','UM3',NULL),('America/Argentina/Mendoza','UTC-3',NULL,'ar','UM3',NULL),('America/Argentina/Rio_Gallegos','UTC-3',NULL,'ar','UM3',NULL),('America/Argentina/Salta','UTC-3',NULL,'ar','UM3',NULL),('America/Argentina/San_Juan','UTC-3',NULL,'ar','UM3',NULL),('America/Argentina/San_Luis','UTC-4','UTC-3','ar','UM4','UM3'),('America/Argentina/Tucuman','UTC-3','UTC-2','ar','UM3',NULL),('America/Argentina/Ushuaia','UTC-3',NULL,'ar','UM3',NULL),('America/Aruba','UTC-4',NULL,'aw','UM4',NULL),('America/Asuncion','UTC-4','UTC-3','py','UM4','UM3'),('America/Atikokan','UTC-5',NULL,'ca','UM5',NULL),('America/Bahia','UTC-3',NULL,'br','UM3',NULL),('America/Barbados','UTC-4',NULL,'bb','UP4',NULL),('America/Belem','UTC-3',NULL,'br','UM3',NULL),('America/Belize','UTC-6',NULL,'bz','UM6',NULL),('America/Blanc-Sablon','UTC-4',NULL,'ca','UM4',NULL),('America/Boa_Vista','UTC-4',NULL,'br','UM4',NULL),('America/Bogota','UTC-5',NULL,'co','UM5',NULL),('America/Boise','UTC-7','UTC-6','us','UM7','UM6'),('America/Cambridge_Bay','UTC-7','UTC-6','ca','UM7','UM6'),('America/Campo_Grande','UTC-4','UTC-3','br','UM4','UM3'),('America/Cancun','UTC-6','UTC-5','mx','UM6','UM5'),('America/Caracas','UTC-4:30',NULL,'ve','UM45',NULL),('America/Cayenne','UTC-3',NULL,'gf','UM3',NULL),('America/Cayman','UTC-5',NULL,'ky','UM5',NULL),('America/Chicago','UTC-6','UTC-5','us','UM6','UM5'),('America/Chihuahua','UTC-7','UTC-6','mx','UM7','UM6'),('America/Costa_Rica','UTC-6',NULL,'cr','UM6',NULL),('America/Cuiaba','UTC-4','UTC-3','br','UM4','UM3'),('America/Curacao','UTC-4',NULL,'an','UM4',NULL),('America/Danmarkshavn','UTC',NULL,'gl','UTC',NULL),('America/Dawson','UTC-8','UTC-7','ca','UM8','UM7'),('America/Dawson_Creek','UTC-7',NULL,'ca','UM7',NULL),('America/Denver','UTC-7','UTC-6','us','UM7','UM6'),('America/Detroit','UTC-5','UTC-4','us','UM5','UM4'),('America/Dominica','UTC-4',NULL,'dm','UM4',NULL),('America/Edmonton','UTC-7','UTC-6','ca','UM7','UM6'),('America/Eirunepe','UTC-4',NULL,'br','UM4',NULL),('America/El_Salvador','UTC-6',NULL,'sv','UM6',NULL),('America/Fortaleza','UTC-3',NULL,'br','UM3',NULL),('America/Glace_Bay','UTC-4','UTC-3','ca','UM4','UM3'),('America/Godthab','UTC-3','UTC-2','gl','UM3','UM2'),('America/Goose_Bay','UTC-4','UTC-3','ca','UM4','UM3'),('America/Grand_Turk','UTC-5','UTC-4','tc','UM5','UM4'),('America/Grenada','UTC-4',NULL,'gd','UM4',NULL),('America/Guadeloupe','UTC-4',NULL,'gp','UM4',NULL),('America/Guatemala','UTC-6',NULL,'gt','UM6',NULL),('America/Guayaquil','UTC-5',NULL,'ec','UM5',NULL),('America/Guyana','UTC-4',NULL,'gy','UM4',NULL),('America/Halifax','UTC-4','UTC-3','ca','UM4','UM3'),('America/Havana','UTC-5','UTC-4','cu','UM5','UM4'),('America/Hermosillo','UTC-7',NULL,'mx','UM7',NULL),('America/Indiana/Indianapolis','UTC-5','UTC-4','us','UM5','UM4'),('America/Indiana/Knox','UTC-6','UTC-5','us','UM6','UM5'),('America/Indiana/Marengo','UTC-5','UTC-4','us','UM5','UM4'),('America/Indiana/Petersburg','UTC-5','UTC-4','us','UM5','UM4'),('America/Indiana/Tell_City','UTC-6','UTC-5','us','UM6','UM5'),('America/Indiana/Vevay','UTC-5','UTC-4','us','UM5','UM4'),('America/Indiana/Vincennes','UTC-5','UTC-4','us','UM5','UM4'),('America/Indiana/Winamac','UTC-5','UTC-4','us','UM5','UM4'),('America/Inuvik','UTC-7','UTC-6','ca','UM7','UM6'),('America/Iqaluit','UTC-5','UTC-4','ca','UM5','UM4'),('America/Jamaica','UTC-5',NULL,'jm','UM5',NULL),('America/Juneau','UTC-9','UTC-8','us','UM9','UM8'),('America/Kentucky/Louisville','UTC-5','UTC-4','us','UM5','UM4'),('America/Kentucky/Monticello','UTC-5','UTC-4','us','UM5','UM4'),('America/La_Paz','UTC-4',NULL,'bo','UM4',NULL),('America/Lima','UTC-5',NULL,'pe','UM5',NULL),('America/Los_Angeles','UTC-8','UTC-7','us','UM8','UM7'),('America/Maceio','UTC-3',NULL,'br','UM3',NULL),('America/Managua','UTC-6',NULL,'ni','UM6',NULL),('America/Manaus','UTC-4',NULL,'br','UM4',NULL),('America/Marigot','UTC-4',NULL,'mf','UM4',NULL),('America/Martinique','UTC-4',NULL,'mq','UM4',NULL),('America/Mazatlan','UTC-7','UTC-6','mx','UM7','UM6'),('America/Menominee','UTC-6','UTC-5','us','UM6','UM5'),('America/Merida','UTC-6','UTC-5','mx','UM6','UM5'),('America/Mexico_City','UTC-6','UTC-5','mx','UM6','UM5'),('America/Miquelon','UTC-3','UTC-2','pm','UM3','UM2'),('America/Moncton','UTC-4','UTC-3','ca','UM4','UM3'),('America/Monterrey','UTC-6','UTC-5','mx','UM6','UM5'),('America/Montevideo','UTC-3','UTC-2','uy','UM3','UM2'),('America/Montreal','UTC-5','UTC-4','ca','UM5','UM4'),('America/Montserrat','UTC-4',NULL,'ms','UM4',NULL),('America/Nassau','UTC-4','UTC-3','bs','UM4','UM3'),('America/New_York','UTC-5','UTC-4','us','UM5','UM4'),('America/Nipigon','UTC-5','UTC-4','ca','UM5','UM4'),('America/Nome','UTC-9','UTC-8','us','UM9','UM8'),('America/Noronha','UTC-2',NULL,'br','UM2',NULL),('America/North_Dakota/Center','UTC-6','UTC-5','us','UM6','UM5'),('America/North_Dakota/New_Salem','UTC-6','UTC-5','us','UM6','UM5'),('America/Panama','UTC-5',NULL,'pa','UM5',NULL),('America/Pangnirtung','UTC-5','UTC-4','ca','UM5','UM4'),('America/Paramaribo','UTC-3',NULL,'sr','UM3',NULL),('America/Phoenix','UTC-7',NULL,'us','UM7',NULL),('America/Port-au-Prince','UTC-5',NULL,'ht','UM5',NULL),('America/Porto_Velho','UTC-4',NULL,'br','UM4',NULL),('America/Port_of_Spain','UTC-4',NULL,'tt','UM4',NULL),('America/Puerto_Rico','UTC-4',NULL,'pr','UM4',NULL),('America/Rainy_River','UTC-6','UTC-5','ca','UM6','UM5'),('America/Rankin_Inlet','UTC-6','UTC-5','ca','UM6','UM5'),('America/Recife','UTC-3',NULL,'br','UM3',NULL),('America/Regina','UTC-6',NULL,'ca','UM6',NULL),('America/Resolute','UTC-5','UTC-4','ca','UM5','UM4'),('America/Rio_Branco','UTC-4',NULL,'br','UM4',NULL),('America/Santarem','UTC-3',NULL,'br','UM3',NULL),('America/Santiago','UTC-4','UTC-3','cl','UM4','UM3'),('America/Santo_Domingo','UTC-4',NULL,'do','UM4',NULL),('America/Sao_Paulo','UTC-3','UTC-2','br','UM3','UM2'),('America/Scoresbysund','UTC-1','UTC','gl','UM1','UTC'),('America/Shiprock','UTC-7','UTC-6','us','UM7','UM6'),('America/St_Barthelemy','UTC-4',NULL,'bl','UM4',NULL),('America/St_Johns','UTC-3:30','UTC-2:30','ca','UM35','UM25'),('America/St_Kitts','UTC-4',NULL,'kn','UM4',NULL),('America/St_Lucia','UTC-4',NULL,'lc','UM4',NULL),('America/St_Thomas','UTC-4',NULL,'vi','UM4',NULL),('America/St_Vincent','UTC-4',NULL,'vc','UM4',NULL),('America/Swift_Current','UTC-6',NULL,'ca','UM6',NULL),('America/Tegucigalpa','UTC-6',NULL,'hn','UM6',NULL),('America/Thule','UTC-4','UTC-3','gl','UM4','UM3'),('America/Thunder_Bay','UTC-5','UTC-4','ca','UM5','UM4'),('America/Tijuana','UTC-8','UTC-7','mx','UM8','UM7'),('America/Toronto','UTC-5','UTC-4','ca','UM5','UM4'),('America/Tortola','UTC-4',NULL,'vg','UM4',NULL),('America/Vancouver','UTC-8','UTC-7','ca','UM8','UM7'),('America/Whitehorse','UTC-8','UTC-7','ca','UM8','UM7'),('America/Winnipeg','UTC-6','UTC-5','ca','UM6','UM5'),('America/Yakutat','UTC-9','UTC-8','us','UM9','UM8'),('America/Yellowknife','UTC-7','UTC-6','ca','UM7','UM6'),('Antarctica/Casey','UTC+8',NULL,'aq','UP8',NULL),('Antarctica/Davis','UTC+7',NULL,'aq','UP7',NULL),('Antarctica/DumontDUrville','UTC+10',NULL,'aq','UP10',NULL),('Antarctica/Mawson','UTC+6',NULL,'aq','UP6',NULL),('Antarctica/McMurdo','UTC+12','UTC+13','aq','UP12','UP13'),('Antarctica/Palmer','UTC-4','UTC-3','aq','UM4','UM3'),('Antarctica/Rothera','UTC-3',NULL,'aq','UM3',NULL),('Antarctica/South_Pole','UTC+12','UTC+13','aq','UP12','UP13'),('Antarctica/Syowa','UTC+3',NULL,'aq','UP3',NULL),('Antarctica/Vostok',NULL,NULL,'aq','UTC',NULL),('Arctic/Longyearbyen','UTC+1','UTC+2','sj','UP1','UP2'),('Asia/Aden','UTC+3',NULL,'ye','UP3',NULL),('Asia/Almaty','UTC+6',NULL,'kz','UP6',NULL),('Asia/Amman','UTC+2','UTC+3','jo','UP2','UP3'),('Asia/Anadyr','UTC+12','UTC+13','ru','UP12','UP13'),('Asia/Aqtau','UTC+5',NULL,'kz','UP5',NULL),('Asia/Aqtobe','UTC+5',NULL,'kz','UP5',NULL),('Asia/Ashgabat','UTC+5',NULL,'tm','UP5',NULL),('Asia/Baghdad','UTC+3',NULL,'iq','UP3',NULL),('Asia/Bahrain','UTC+3',NULL,'bh','UP3',NULL),('Asia/Baku','UTC+4','UTC+5','az','UP4','UP5'),('Asia/Bangkok','UTC+7',NULL,'th','UP7',NULL),('Asia/Beirut','UTC+2','UTC+3','lb','UP2','UP3'),('Asia/Bishkek','UTC+6',NULL,'kg','UP6',NULL),('Asia/Brunei','UTC+8',NULL,'bn','UP8',NULL),('Asia/Choibalsan','UTC+8',NULL,'mn','UP8',NULL),('Asia/Chongqing','UTC+8',NULL,'cn','UP8',NULL),('Asia/Colombo','UTC+5:30',NULL,'lk','UP55',NULL),('Asia/Damascus','UTC+2','UTC+3','sy','UP2','UP3'),('Asia/Dhaka','UTC+6',NULL,'bd','UP6',NULL),('Asia/Dili','UTC+9',NULL,'tl','UP9',NULL),('Asia/Dubai','UTC+4',NULL,'ae','UP4',NULL),('Asia/Dushanbe','UTC+5',NULL,'tj','UP5',NULL),('Asia/Gaza','UTC+2','UTC+3','ps','UP2','UP3'),('Asia/Harbin','UTC+8',NULL,'cn','UP8',NULL),('Asia/Hong_Kong','UTC+8',NULL,'hk','UP8',NULL),('Asia/Hovd','UTC+7',NULL,'mn','UP7',NULL),('Asia/Ho_Chi_Minh','UTC+7',NULL,'vn','UP7',NULL),('Asia/Irkutsk','UTC+8','UTC+9','ru','UP8','UP9'),('Asia/Jakarta','UTC+7',NULL,'id','UP7',NULL),('Asia/Jayapura','UTC+9',NULL,'id','UP9',NULL),('Asia/Jerusalem','UTC+2','UTC+3','il','UP2','UP3'),('Asia/Kabul','UTC+4:30',NULL,'af','UP45',NULL),('Asia/Kamchatka','UTC+12','UTC+13','ru','UP12','UP13'),('Asia/Karachi','UTC+6',NULL,'pk','UP6',NULL),('Asia/Kashgar','UTC+8',NULL,'cn','UP8',NULL),('Asia/Katmandu','UTC+5:45',NULL,'np','UP575',NULL),('Asia/Kolkata','UTC+5:30',NULL,'in','UP55',NULL),('Asia/Krasnoyarsk','UTC+7','UTC+8','ru','UP7','UP8'),('Asia/Kuala_Lumpur','UTC+8',NULL,'my','UP8',NULL),('Asia/Kuching','UTC+8',NULL,'my','UP8',NULL),('Asia/Kuwait','UTC+3',NULL,'kw','UP3',NULL),('Asia/Macau','UTC+8',NULL,'mo','UP8',NULL),('Asia/Magadan','UTC+11','UTC+12','ru','UP11','UP12'),('Asia/Makassar','UTC+8',NULL,'id','UP8',NULL),('Asia/Manila','UTC+8',NULL,'ph','UP8',NULL),('Asia/Muscat','UTC+4',NULL,'om','UP4',NULL),('Asia/Nicosia','UTC+2','UTC+3','cy','UP2','UP3'),('Asia/Novosibirsk','UTC+6','UTC+7','ru','UP6','UP7'),('Asia/Omsk','UTC+6','UTC+7','ru','UP6','UP7'),('Asia/Oral','UTC+5',NULL,'kz','UP5',NULL),('Asia/Phnom_Penh','UTC+7',NULL,'kh','UP7',NULL),('Asia/Pontianak','UTC+7',NULL,'id','UP7',NULL),('Asia/Pyongyang','UTC+9',NULL,'kp','UP9',NULL),('Asia/Qatar','UTC+3',NULL,'qa','UP3',NULL),('Asia/Qyzylorda','UTC+6',NULL,'kz','UP6',NULL),('Asia/Rangoon','UTC+6:30',NULL,'mm','UP65',NULL),('Asia/Riyadh','UTC+3',NULL,'sa','UP3',NULL),('Asia/Sakhalin','UTC+10','UTC+11','ru','UP10','UP11'),('Asia/Samarkand','UTC+5',NULL,'uz','UP5',NULL),('Asia/Seoul','UTC+9',NULL,'kr','UP9',NULL),('Asia/Shanghai','UTC+8',NULL,'cn','UP8',NULL),('Asia/Singapore','UTC+8',NULL,'sg','UP8',NULL),('Asia/Taipei','UTC+8',NULL,'tw','UP8',NULL),('Asia/Tashkent','UTC+5',NULL,'uz','UP5',NULL),('Asia/Tbilisi','UTC+4',NULL,'ge','UP4',NULL),('Asia/Tehran','UTC+3:30','UTC+4:30','ir','UP35','UP45'),('Asia/Thimphu','UTC+6',NULL,'bt','UP6',NULL),('Asia/Tokyo','UTC+9',NULL,'jp','UP9',NULL),('Asia/Ulaanbaatar','UTC+8',NULL,'mn','UP8',NULL),('Asia/Urumqi','UTC+8',NULL,'cn','UP8',NULL),('Asia/Vientiane','UTC+7',NULL,'la','UP7',NULL),('Asia/Vladivostok','UTC+10','UTC+11','ru','UP10','UP11'),('Asia/Yakutsk','UTC+9','UTC+10','ru','UP9','UP10'),('Asia/Yekaterinburg','UTC+5','UTC+6','ru','UP5','UP6'),('Asia/Yerevan','UTC+4','UTC+5','am','UP4','UP5'),('Atlantic/Azores','UTC-1','UTC','pt','UM1','UTC'),('Atlantic/Bermuda','UTC-4',NULL,'bm','UM4',NULL),('Atlantic/Canary','UTC','UTC+1','es','UTC','UP1'),('Atlantic/Cape_Verde','UTC-1',NULL,'cv','UM1',NULL),('Atlantic/Faroe','UTC','UTC+1','fo','UTC','UP1'),('Atlantic/Madeira','UTC','UTC+1','pt','UTC','UP1'),('Atlantic/Reykjavik','UTC',NULL,'is','UTC',NULL),('Atlantic/South_Georgia','UTC-2',NULL,'gs','UM2',NULL),('Atlantic/Stanley','UTC-4','UTC-3','fk','UM4','UM3'),('Atlantic/St_Helena','UTC',NULL,'sh','UTC',NULL),('Australia/Adelaide','UTC+9:30','UTC+10:30','au','UP95','UP105'),('Australia/Brisbane','UTC+10',NULL,'au','UP10',NULL),('Australia/Broken_Hill','UTC+9:30','UTC+10:30','au','UP95','UP105'),('Australia/Currie','UTC+10','UTC+11','au','UP10','UP11'),('Australia/Darwin','UTC+9:30',NULL,'au','UP95',NULL),('Australia/Eucla','UTC+8:45','UTC+9:45','au','UP875','UP975'),('Australia/Hobart','UTC+10','UTC+11','au','UP10','UP11'),('Australia/Lindeman','UTC+10',NULL,'au','UP10',NULL),('Australia/Lord_Howe','UTC+10:30','UTC+11','au','UP105','UP11'),('Australia/Melbourne','UTC+10','UTC+11','au','UP10','UP11'),('Australia/Perth','UTC+8',NULL,'au','UP8',NULL),('Australia/Sydney','UTC+10','UTC+11','au','UP10','UP11'),('Europe/Amsterdam','UTC+1',NULL,'nl','UP1',NULL),('Europe/Andorra','UTC+1','UTC+2','ad','UP1','UP2'),('Europe/Athens','UTC+2','UTC+3','gr','UP2','UP3'),('Europe/Belgrade','UTC+1','UTC+2','rs','UP1','UP2'),('Europe/Berlin','UTC+1','UTC+2','de','UP1','UP2'),('Europe/Bratislava','UTC+1','UTC+2','sk','UP1','UP2'),('Europe/Brussels','UTC+1','UTC+2','be','UP1','UP2'),('Europe/Bucharest','UTC+2','UTC+3','ro','UP2','UP3'),('Europe/Budapest','UTC+1','UTC+2','hu','UP1','UP2'),('Europe/Chisinau','UTC+2','UTC+3','md','UP2','UP3'),('Europe/Copenhagen','UTC+1','UTC+2','dk','UP1','UP2'),('Europe/Dublin','UTC','UTC+1','ie','UTC','UP1'),('Europe/Gibraltar','UTC+1','UTC+2','gi','UP1','UP2'),('Europe/Guernsey','UTC','UTC+1','gg','UTC','UP1'),('Europe/Helsinki','UTC+2','UTC+3','fi','UP2','UP3'),('Europe/Isle_of_Man','UTC','UTC+1','im','UTC','UP1'),('Europe/Istanbul','UTC+2','UTC+3','tr','UP2','UP3'),('Europe/Jersey','UTC','UTC+1','je','UTC','UP1'),('Europe/Kaliningrad','UTC+2','UTC+3','ru','UP2','UP3'),('Europe/Kiev','UTC+2','UTC+3','ua','UP2','UP3'),('Europe/Lisbon','UTC','UTC+1','pt','UTC','UP1'),('Europe/Ljubljana','UTC+1','UTC+2','si','UP1','UP2'),('Europe/London','UTC','UTC+1','gb','UP1',NULL),('Europe/Luxembourg','UTC+1','UTC+2','lu','UP1','UP2'),('Europe/Madrid','UTC+1','UTC+2','es','UP1','UP2'),('Europe/Malta','UTC+1','UTC+2','mt','UP1','UP2'),('Europe/Mariehamn','UTC+2','UTC+3','ax','UP2','UP3'),('Europe/Minsk','UTC+2','UTC+3','by','UP2','UP3'),('Europe/Monaco','UTC+1','UTC+2','mc','UP1','UP2'),('Europe/Moscow','UTC+3','UTC+4','ru','UP3','UP4'),('Europe/Oslo','UTC+1','UTC+2','no','UP1','UP2'),('Europe/Paris','UTC+1','UTC+2','fr','UP1','UP2'),('Europe/Podgorica','UTC+1','UTC+2','me','UP1','UP2'),('Europe/Prague','UTC+1','UTC+2','cz','UP1','UP2'),('Europe/Riga','UTC+2','UTC+3','lv','UP2','UP3'),('Europe/Rome','UTC+1','UTC+2','it','UP1','UP2'),('Europe/Samara','UTC+4','UTC+5','ru','UP4','UP5'),('Europe/San_Marino','UTC+1','UTC+2','sm','UP1','UP2'),('Europe/Sarajevo','UTC+1','UTC+2','ba','UP1','UP2'),('Europe/Simferopol','UTC+2','UTC+3','ua','UP2','UP3'),('Europe/Skopje','UTC+1','UTC+2','mk','UP1','UP2'),('Europe/Sofia','UTC+2','UTC+3','bg','UP2',NULL),('Europe/Stockholm','UTC+1','UTC+2','se','UP1','UP2'),('Europe/Tallinn','UTC+2','UTC+3','ee','UP2','UP3'),('Europe/Tirane','UTC+1','UTC+2','al','UP1','UP2'),('Europe/Uzhgorod','UTC+2','UTC+3','ua','UP2','UP3'),('Europe/Vaduz','UTC+1','UTC+2','li','UP1','UP2'),('Europe/Vatican','UTC+1','UTC+2','va','UP1','UP2'),('Europe/Vienna','UTC+1','UTC+2','at','UP1','UP2'),('Europe/Vilnius','UTC+2','UTC+3','lt','UP2','UP3'),('Europe/Volgograd','UTC+3','UTC+4','ru','UP3','UP4'),('Europe/Warsaw','UTC+1','UTC+2','pl','UP1','UP2'),('Europe/Zagreb','UTC+1','UTC+2','hr','UP1','UP2'),('Europe/Zaporozhye','UTC+2','UTC+3','ua','UP2','UP3'),('Europe/Zurich','UTC+1','UTC+2','ch','UP1','UP2'),('Indian/Antananarivo','UTC+3',NULL,'mg','UP3',NULL),('Indian/Chagos','UTC+6',NULL,'io','UP6',NULL),('Indian/Christmas','UTC+7',NULL,'cx','UP7',NULL),('Indian/Cocos','UTC+6:30',NULL,'cc','UP65',NULL),('Indian/Comoro','UTC+3',NULL,'km','UP3',NULL),('Indian/Kerguelen','UTC+5',NULL,'tf','UP5',NULL),('Indian/Mahe','UTC+4',NULL,'sc','UP4',NULL),('Indian/Maldives','UTC+5',NULL,'mv','UP5',NULL),('Indian/Mauritius','UTC+4',NULL,'mu','UP4',NULL),('Indian/Mayotte','UTC+3',NULL,'yt','UP3',NULL),('Indian/Reunion','UTC+4',NULL,'re','UP4',NULL),('Pacific/Apia','UTC-11',NULL,'ws','UM11',NULL),('Pacific/Auckland','UTC+12','UTC+13','nz','UP12','UP13'),('Pacific/Chatham','UTC+12:45','UTC+13:45','nz','UP1275','UP1375'),('Pacific/Easter','UTC-6','UTC-5','cl','UM6','UM5'),('Pacific/Efate','UTC+11',NULL,'vu','UP11',NULL),('Pacific/Enderbury','UTC+13',NULL,'ki','UP13',NULL),('Pacific/Fakaofo','UTC-10',NULL,'tk','UM10',NULL),('Pacific/Fiji','UTC+12',NULL,'fj','UP12',NULL),('Pacific/Funafuti','UTC+12',NULL,'tv','UP12',NULL),('Pacific/Galapagos','UTC-6',NULL,'ec','UM6',NULL),('Pacific/Gambier','UTC-9',NULL,'pf','UM9',NULL),('Pacific/Guadalcanal','UTC+11',NULL,'sb','UP11',NULL),('Pacific/Guam','UTC+10',NULL,'gu','UP10',NULL),('Pacific/Honolulu','UTC-10',NULL,'us','UM10',NULL),('Pacific/Johnston','UTC-10',NULL,'um','UM10',NULL),('Pacific/Kiritimati','UTC+14',NULL,'ki','UP13',NULL),('Pacific/Kosrae','UTC+11',NULL,'fm','UP11',NULL),('Pacific/Kwajalein','UTC+12',NULL,'mh','UP12',NULL),('Pacific/Majuro','UTC+12',NULL,'mh','UP12',NULL),('Pacific/Marquesas','UTC+9:30',NULL,'pf','UP95',NULL),('Pacific/Midway','UTC-11',NULL,'um','UM11',NULL),('Pacific/Nauru','UTC+12',NULL,'nr','UP12',NULL),('Pacific/Niue','UTC-11',NULL,'nu','UM11',NULL),('Pacific/Norfolk','UTC+11:30',NULL,'nf','UP115',NULL),('Pacific/Noumea','UTC+11',NULL,'nc','UP11',NULL),('Pacific/Pago_Pago','UTC-11',NULL,'as','UM11',NULL),('Pacific/Palau','UTC+9',NULL,'pw','UP9',NULL),('Pacific/Pitcairn','UTC-8',NULL,'pn','UM8',NULL),('Pacific/Ponape','UTC+11',NULL,'fm','UP11',NULL),('Pacific/Port_Moresby','UTC+10',NULL,'pg','UP10',NULL),('Pacific/Rarotonga','UTC-10',NULL,'ck','UM10',NULL),('Pacific/Saipan','UTC+10',NULL,'mp','UP10',NULL),('Pacific/Tahiti','UTC-10',NULL,'pf','UM10',NULL),('Pacific/Tarawa','UTC+12',NULL,'ki','UP12',NULL),('Pacific/Tongatapu','UTC+13',NULL,'to','UP13',NULL),('Pacific/Truk','UTC+10',NULL,'fm','UP10',NULL),('Pacific/Wake','UTC+12',NULL,'um','UP12',NULL),('Pacific/Wallis','UTC+12',NULL,'wf','UP12',NULL);
/*!40000 ALTER TABLE `ref_zoneinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rel_account_permission`
--

DROP TABLE IF EXISTS `rel_account_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rel_account_permission` (
  `account_id` bigint(20) unsigned NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`account_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rel_account_permission`
--

LOCK TABLES `rel_account_permission` WRITE;
/*!40000 ALTER TABLE `rel_account_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `rel_account_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rel_account_role`
--

DROP TABLE IF EXISTS `rel_account_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rel_account_role` (
  `account_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`account_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rel_account_role`
--

LOCK TABLES `rel_account_role` WRITE;
/*!40000 ALTER TABLE `rel_account_role` DISABLE KEYS */;
INSERT INTO `rel_account_role` VALUES (1,1),(3,3);
/*!40000 ALTER TABLE `rel_account_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rel_role_permission`
--

DROP TABLE IF EXISTS `rel_role_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rel_role_permission` (
  `role_id` bigint(20) unsigned NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rel_role_permission`
--

LOCK TABLES `rel_role_permission` WRITE;
/*!40000 ALTER TABLE `rel_role_permission` DISABLE KEYS */;
INSERT INTO `rel_role_permission` VALUES (1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,22),(1,23),(3,15);
/*!40000 ALTER TABLE `rel_role_permission` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_name` varchar(250) NOT NULL,
  `test_description` text NOT NULL,
  `test_price` decimal(10,2) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tests`
--

LOCK TABLES `tests` WRITE;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-22 12:36:19
