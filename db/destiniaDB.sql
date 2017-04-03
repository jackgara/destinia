--
-- Base de datos: `destiniaDB`
--
-- --------------------------------------------------------
CREATE DATABASE IF NOT EXISTS destiniadb;
  SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

USE destiniadb;
--
-- Estructura de tabla para la tabla `latin `
--  utf8mb4 soporta suplemental characters
--
CREATE TABLE IF NOT EXISTS latin_lodging (
  lodging_id INT(60) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  lodging_type ENUM('Hotel','Apartamento') NOT NULL,
  name VARCHAR(60)DEFAULT NULL,
  stars ENUM('1','2','3','4','5') DEFAULT NULL,
  room_type ENUM('Simple','Doble','Simple con Vista','Doble con Vista')DEFAULT NULL,
  apartments INT DEFAULT NULL,
  people INT DEFAULT NULL,
  city VARCHAR(60) NOT NULL,
  province VARCHAR(60)NOT NULL
)ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci ;
-- CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci ;

--
-- Estructura de tabla para la tabla `arabic `
--

CREATE TABLE IF NOT EXISTS arabic_lodging (
  lodging_id INT(60) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  lodging_type ENUM('Hotel','Apartamento') NOT NULL,
  name VARCHAR(60)DEFAULT NULL,
  stars ENUM('1','2','3','4','5') DEFAULT NULL,
  room_type ENUM('Simple','Doble','Simple con Vista','Doble con Vista')DEFAULT NULL,
  apartments INT DEFAULT NULL,
  people INT DEFAULT NULL,
  city VARCHAR(60) NOT NULL,
  province VARCHAR(60)NOT NULL
)ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci ;

--
-- Estructura de tabla para la tabla `cyrillic `
--

CREATE TABLE IF NOT EXISTS cyrillic_lodging (
  lodging_id INT(60) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  lodging_type ENUM('Hotel','Apartamento') NOT NULL,
  name VARCHAR(60)DEFAULT NULL,
  stars ENUM('1','2','3','4','5') DEFAULT NULL,
  room_type ENUM('Simple','Doble','Simple con Vista','Doble con Vista')DEFAULT NULL,
  apartments INT DEFAULT NULL,
  people INT DEFAULT NULL,
  city VARCHAR(60) NOT NULL,
  province VARCHAR(60)NOT NULL
)ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci ;