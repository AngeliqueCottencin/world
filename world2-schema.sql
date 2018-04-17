-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.37-1ubuntu5


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema world2
--

CREATE DATABASE IF NOT EXISTS world2;
USE world2;

DROP TABLE IF EXISTS `City`;
CREATE TABLE  `City` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCountry` int(11) DEFAULT NULL,
  `Name` char(35) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `CountryCode` char(3) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `District` char(20) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `Population` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `fk_constraint_city_country` (`idCountry`),
  CONSTRAINT `fk_constraint_city_country` FOREIGN KEY (`idCountry`) REFERENCES `Country` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4080 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `Country`;
CREATE TABLE  `Country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Code` char(3) CHARACTER SET latin1 DEFAULT NULL,
  `Name` char(52) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `Continent` enum('Asia','Europe','North America','Africa','Oceania','Antarctica','South America') CHARACTER SET latin1 NOT NULL DEFAULT 'Asia',
  `Region` char(26) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `SurfaceArea` float(10,2) NOT NULL DEFAULT '0.00',
  `IndepYear` smallint(6) DEFAULT NULL,
  `Population` int(11) NOT NULL DEFAULT '0',
  `LifeExpectancy` float(3,1) DEFAULT NULL,
  `GNP` float(10,2) DEFAULT NULL,
  `GNPOld` float(10,2) DEFAULT NULL,
  `LocalName` char(45) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `GovernmentForm` char(45) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `HeadOfState` char(60) CHARACTER SET latin1 DEFAULT NULL,
  `Capital` int(11) DEFAULT NULL,
  `Code2` char(2) CHARACTER SET latin1 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `CountryLanguage`;
CREATE TABLE  `CountryLanguage` (
  `idCountry` int(11) NOT NULL DEFAULT '0',
  `idLanguage` int(11) NOT NULL DEFAULT '0',
  `IsOfficial` enum('T','F') CHARACTER SET latin1 NOT NULL DEFAULT 'F',
  `Percentage` float(4,1) NOT NULL DEFAULT '0.0',
  PRIMARY KEY (`idCountry`,`idLanguage`) USING BTREE,
  KEY `fk_constraint_Language` (`idLanguage`),
  CONSTRAINT `fk_constraint_Country` FOREIGN KEY (`idCountry`) REFERENCES `Country` (`id`),
  CONSTRAINT `fk_constraint_Language` FOREIGN KEY (`idLanguage`) REFERENCES `Language` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `Language`;
CREATE TABLE  `Language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=512 DEFAULT CHARSET=utf8;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

