SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-05:00";
CREATE DATABASE IF NOT EXISTS `cms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cms`;
CREATE TABLE IF NOT EXISTS `pages` (`pageID` int(11) NOT NULL AUTO_INCREMENT,`page` varchar(20) NOT NULL, PRIMARY KEY (`pageID`,`page`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
CREATE USER 'admin'@'localhost' IDENTIFIED BY  'password';
GRANT ALL PRIVILEGES ON * . * TO  'admin'@'localhost' IDENTIFIED BY  'password' WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;
GRANT ALL PRIVILEGES ON  `cms` . * TO  'admin'@'localhost';
