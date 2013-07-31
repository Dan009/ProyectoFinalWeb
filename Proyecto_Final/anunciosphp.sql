-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 31-07-2013 a las 12:31:47
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
  `idmadmin` int(11) NOT NULL,
  `nombre` varchar(45) default NULL,
  `clave` varchar(15) default NULL,
  PRIMARY KEY  (`idmadmin`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `administrador`
-- 

INSERT INTO `administrador` VALUES (0, 'dan009', '81dc9bdb52d04dc');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `categoria`
-- 


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
