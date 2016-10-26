# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.27-0ubuntu1)
# Database: moose-pirates
# Generation Time: 2016-10-26 05:48:23 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table friends
# ------------------------------------------------------------

DROP TABLE IF EXISTS `friends`;

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;

INSERT INTO `friends` (`id`, `friend_id`)
VALUES
	(5,4),
	(8,4),
	(8,5),
	(8,6);

/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_keywords
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_keywords`;

CREATE TABLE `user_keywords` (
  `keyword` varchar(240) NOT NULL DEFAULT '',
  `id` int(11) NOT NULL,
  PRIMARY KEY (`keyword`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `user_keywords` WRITE;
/*!40000 ALTER TABLE `user_keywords` DISABLE KEYS */;

INSERT INTO `user_keywords` (`keyword`, `id`)
VALUES
	('avatar the last airbender',4),
	('brisbane',8),
	('election',6),
	('face',1),
	('fire',5),
	('kangaroo',9),
	('naruto',8),
	('procrastinating',6),
	('trees',5);

/*!40000 ALTER TABLE `user_keywords` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(245) DEFAULT NULL,
  `email` varchar(245) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `password`)
VALUES
	(1,'John','John@john.com ','5f4dcc3b5aa765d61d8327deb882cf99'),
	(4,'Nick Cassidy ','nick_c94@hotmail.com','1354f801848b13be0240ab59bac4d192'),
	(5,'Sam ','sambuck19@gmail.com','773e056e1e36c885f12e2ab89fdff1fc'),
	(6,'G ','gbseeto1@hotmail.com','25f9e794323b453885f5181f1b624d0b'),
	(8,'zaim ','zaim.hamdan@uq.edu.au','af40f4d356658b565b6e70abfc07ec77'),
	(9,'deco3500 ','zaim.hamdan@uq.net.au','af40f4d356658b565b6e70abfc07ec77');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
