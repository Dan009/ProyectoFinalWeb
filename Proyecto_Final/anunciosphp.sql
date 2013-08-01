-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 01-08-2013 a las 12:55:22
-- Versión del servidor: 5.0.51
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `anunciosphp`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `administrador`
-- 

DROP TABLE IF EXISTS `administrador`;
CREATE TABLE IF NOT EXISTS `administrador` (
  `idadmin` int(11) NOT NULL auto_increment,
  `nombre` varchar(45) default NULL,
  `claveAdmin` char(32) default NULL,
  PRIMARY KEY  (`idadmin`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- Volcar la base de datos para la tabla `administrador`
-- 

INSERT INTO `administrador` VALUES (1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055');
INSERT INTO `administrador` VALUES (2, 'Zoe', 'e35cf7b66449df565f93c607d5a81d09');
INSERT INTO `administrador` VALUES (4, 'Zach', '9830fe95de944d260ed51d68d41638e0');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `anuncio`
-- 

DROP TABLE IF EXISTS `anuncio`;
CREATE TABLE IF NOT EXISTS `anuncio` (
  `idanuncio` int(11) NOT NULL,
  `titulo` varchar(100) default NULL,
  `descripcion` varchar(150) default NULL,
  `categoria` varchar(45) default NULL,
  `idfoto` int(11) default NULL,
  `idusuario` int(11) default NULL,
  `latitud` bigint(20) default NULL,
  `longitud` bigint(20) default NULL,
  PRIMARY KEY  (`idanuncio`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `anuncio`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `categoria`
-- 

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `idcategoria` int(11) NOT NULL auto_increment,
  `nombre` varchar(45) default NULL,
  `descripcion` varchar(150) default NULL,
  PRIMARY KEY  (`idcategoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- 
-- Volcar la base de datos para la tabla `categoria`
-- 

INSERT INTO `categoria` VALUES (1, 'Electronica', 'Materiales y herramientas para trabajar en electronica, al igual que materiales gastables, ect.');
INSERT INTO `categoria` VALUES (2, 'Computadoras', 'Computadoras, laptops, IPADs, Tabletas Surface y todo lo que requiera una computadora');
INSERT INTO `categoria` VALUES (11, 'Otros', 'Ofertas y temas varios');
INSERT INTO `categoria` VALUES (10, 'Articulos de Videojuegos', 'Articulos, desde T- Shirts, tazas de cafe, pulseras, mochilas,ect. Todo lo referente a videojuegos ');
INSERT INTO `categoria` VALUES (9, 'Videojuegos', 'Juegos de video, clasicos, modernos y los ultimos del momento. Tambien, para consolas de todos los tipos y accesorios.');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `fotos`
-- 

DROP TABLE IF EXISTS `fotos`;
CREATE TABLE IF NOT EXISTS `fotos` (
  `idfoto` int(11) NOT NULL auto_increment,
  `idanuncio` int(11) default NULL,
  `nombre` varchar(45) default NULL,
  `tipo` varchar(45) default NULL,
  `fecha_agregada` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`idfoto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `fotos`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuario`
-- 

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(11) NOT NULL auto_increment,
  `nombreusuario` varchar(45) default NULL,
  `clave` varbinary(32) NOT NULL,
  `nombre` varchar(45) default NULL,
  `apellido` varchar(45) default NULL,
  `email` varchar(45) default NULL,
  `cedula` varchar(13) default NULL,
  `telefono` varchar(12) default NULL,
  PRIMARY KEY  (`idusuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Volcar la base de datos para la tabla `usuario`
-- 

INSERT INTO `usuario` VALUES (2, 'Dan009', 0x3831646339626462353264303464633230303336646264383331336564303535, 'Daniel ', 'Ortega Marte', 'dan_009marte@gmail.com', '004-9222333-3', '(809)-223-91');
