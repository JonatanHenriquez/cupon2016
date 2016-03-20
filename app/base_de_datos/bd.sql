/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.5.5-10.1.9-MariaDB : Database - guiasymfony
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`guiasymfony` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `guiasymfony`;

/*Table structure for table `ciudad` */

DROP TABLE IF EXISTS `ciudad`;

CREATE TABLE `ciudad` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `ficha` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `ciudad` */

insert  into `ciudad`(`id`,`nombre`,`ficha`) values (1,'Vitoria-Gasteiz','vitoria-gasteiz'),(2,'Madrid','madrid'),(3,'Barcelona','barcelona'),(4,'Cataluña','cataluña');

/*Table structure for table `oferta` */

DROP TABLE IF EXISTS `oferta`;

CREATE TABLE `oferta` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `ficha` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `condiciones` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `descuento` decimal(10,2) DEFAULT NULL,
  `fecha_publicacion` datetime DEFAULT NULL,
  `fecha_expiracion` datetime DEFAULT NULL,
  `compras` int(11) DEFAULT NULL,
  `umbral` int(11) DEFAULT NULL,
  `revisada` int(1) DEFAULT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `tienda_id` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tienda_idx` (`tienda_id`),
  KEY `ciudad_idx` (`ciudad_id`),
  CONSTRAINT `FK_7479C8F219BA6D46` FOREIGN KEY (`tienda_id`) REFERENCES `tienda` (`id`),
  CONSTRAINT `FK_7479C8F2E8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `oferta` */

insert  into `oferta`(`id`,`nombre`,`ficha`,`descripcion`,`condiciones`,`precio`,`descuento`,`fecha_publicacion`,`fecha_expiracion`,`compras`,`umbral`,`revisada`,`ciudad_id`,`tienda_id`,`foto`) values (2,'oferta 1','oferta-1','Oferta de Quesos\r\nPromocion especial del mes\r\nUna oferta de una vez en mil años','Comprar dos quesos','1.99','0.99','2016-02-19 00:00:00','2016-03-08 00:00:00',0,5,1,1,1,NULL),(3,'oferta 2','oferta-2','Oferta de Vinos\r\nOferta navideña\r\nEspecial para el mes de febrero','Compras mayores a $5','2.99','1.00','2016-02-19 00:00:00','2016-03-15 00:00:00',1,5,1,2,1,'vinos.jpg'),(4,'Oferta Prueba','oferta-prueba','Esta es una oferta de Prueba\r\nSegunda oferta de prueba','No necesita','5.99','2.99','2016-02-19 00:00:00','2016-03-14 00:00:00',3,19,1,3,2,NULL),(5,'Oferta de Quesos','oferta-queso','Esta es una oferta de Quesos\r\nEste es un queso que viene de USA','Compras de dos o mas quesos iguales','10.99','1.75','2016-02-21 00:00:00','2016-03-16 00:00:00',0,10,1,2,1,'quesos.jpg'),(6,'Oferta de Pollos','oferta-pollo','Destinada para los pollos de la marca Pollo Indio\r\nNunca veras una promocion igual en el pais','Compras mayoresa a $9','7.50','5.50','2016-02-20 00:00:00','2016-03-15 00:00:00',0,8,1,3,2,NULL);

/*Table structure for table `rol` */

DROP TABLE IF EXISTS `rol`;

CREATE TABLE `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `rol` varchar(100) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `rol` */

insert  into `rol`(`id`,`nombre`,`rol`,`estado`) values (1,'usuario','USUARIO',1),(2,'admin','ADMINISTRADOR',1);

/*Table structure for table `tienda` */

DROP TABLE IF EXISTS `tienda`;

CREATE TABLE `tienda` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `ficha` varchar(10) DEFAULT NULL,
  `login` varchar(10) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `direccion` text,
  `ciudad_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ciudad_idx` (`ciudad_id`),
  CONSTRAINT `FK_C0C6E53EE8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tienda` */

insert  into `tienda`(`id`,`nombre`,`ficha`,`login`,`password`,`descripcion`,`direccion`,`ciudad_id`) values (1,'Super Tienda Keny','tienda_ken','keny','4423','Es una tienda muy bonita ubicada en el departamento de La Libertad, El Salvador','Avenida el Boqueron bla bla bla',1),(2,'Panes Chory','chory','chory','4423','Un establecimiento de Hot Dogs\r\nUbicados en San Salvador','Por la U',1);

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `direccion` text,
  `permite_email` tinyint(1) DEFAULT NULL,
  `fecha_alta` datetime DEFAULT NULL,
  `fecha_nacimiento` datetime DEFAULT NULL,
  `dui` varchar(9) DEFAULT NULL,
  `numero_tarjeta` varchar(20) DEFAULT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ciudad_idx` (`ciudad_id`),
  KEY `rol_idx` (`rol`),
  CONSTRAINT `FK_2265B05DE8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`),
  CONSTRAINT `FK_usuario_rol` FOREIGN KEY (`rol`) REFERENCES `rol` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`nombre`,`apellidos`,`email`,`password`,`direccion`,`permite_email`,`fecha_alta`,`fecha_nacimiento`,`dui`,`numero_tarjeta`,`ciudad_id`,`rol`,`estado`) values (2,'jontan','lopez','mcr.jblh@gmail.com','$2a$12$5Su/BTw93qx2C7kr/OsCeOt7jPY6UGuNfbm50cBi3j9yx5C4t8XMi','Por ahi\r\n',1,NULL,'1991-09-21 00:00:00','1234698-9','123465-8',2,1,1);

/*Table structure for table `venta` */

DROP TABLE IF EXISTS `venta`;

CREATE TABLE `venta` (
  `oferta_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`oferta_id`,`usuario_id`),
  KEY `usuario_ix` (`usuario_id`),
  KEY `oferta_idx` (`oferta_id`),
  CONSTRAINT `FK_venta_oferta` FOREIGN KEY (`oferta_id`) REFERENCES `oferta` (`id`),
  CONSTRAINT `FK_venta_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `venta` */

insert  into `venta`(`oferta_id`,`usuario_id`,`fecha`) values (2,2,'2016-04-12 00:00:00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
