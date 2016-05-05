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

insert  into `oferta`(`id`,`nombre`,`ficha`,`descripcion`,`condiciones`,`precio`,`descuento`,`fecha_publicacion`,`fecha_expiracion`,`compras`,`umbral`,`revisada`,`ciudad_id`,`tienda_id`,`foto`) values (2,'oferta 1','oferta-1','Oferta de Quesos\r\nPromocion especial del mes\r\nUna oferta de una vez en mil años','Comprar dos quesos','1.99','0.99','2016-02-19 00:00:00','2016-03-08 00:00:00',0,5,1,1,1,NULL),(3,'oferta 2','oferta-2','Oferta de Vinos\r\nOferta navideña\r\nEspecial para el mes de febrero','Compras mayores a $5','2.99','1.00','2016-02-19 00:00:00','2016-03-15 00:00:00',1,5,1,2,1,'vinos.jpg'),(4,'Oferta Prueba','oferta-prueba','Esta es una oferta de Prueba\r\nSegunda oferta de prueba','No necesita','5.99','2.99','2016-02-19 00:00:00','2016-03-14 00:00:00',3,19,1,3,2,NULL),(5,'Oferta de Quesos','oferta-queso','Esta es una oferta de Quesos\r\nEste es un queso que viene de USA','Compras de dos o mas quesos iguales','10.99','1.75','2016-02-21 00:00:00','2016-03-22 00:00:00',0,10,1,2,1,'quesos.jpg'),(6,'Oferta de Pollos','oferta-pollo','Destinada para los pollos de la marca Pollo Indio\r\nNunca veras una promocion igual en el pais','Compras mayoresa a $9','7.50','5.50','2016-02-20 00:00:00','2016-03-15 00:00:00',0,8,1,3,2,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`nombre`,`apellidos`,`email`,`password`,`direccion`,`permite_email`,`fecha_alta`,`fecha_nacimiento`,`dui`,`numero_tarjeta`,`ciudad_id`,`rol`,`estado`) values (3,'Jonatan','Lopez','mcr.jblh@gmail.com','$2a$12$SKR/bSorNZXwEQfQ3LtCRednwVqdw38D/e24/0rvaRiexVgAIHomW','Mi Casa',1,NULL,'1991-09-21 00:00:00','12345679-','12346565',2,1,1),(6,'Jocelyn','Contreras','ligia@gmail.com','$2a$12$S5tWF7gcD6nYTcnDJsc9tehn49PxlN2Ut4Ca92UkGFNZfIcA35LWC','Otra casa',1,NULL,'1990-09-20 00:00:00','123456980','56148741',3,2,1),(7,'a','a','mcr.jblh@gmail.com','$2y$13$bNW9jyINKk4ek.tn9.7nAOYbm6JU3bdWlh9dKFPb/OAaEsOjkY58m','a',0,NULL,NULL,'1','1',1,1,1),(8,'1','1','a@gmail.com','$2y$13$wUP6dnyw/xfiafKvReuAKeqhfkRTaDor2AbdWCaPej0j1S8edY5sK','1',1,NULL,NULL,'1','1',1,1,1),(9,'Pedro','Noe','raquel@gmail.com','$2y$13$L0ClvVG2HXq7y4rtvPL.o.i59GCa/i/CvGtL4IXCiEhtiAaY443/.','ASD',1,NULL,NULL,'1','1',3,1,1),(10,'Antonio','Anakin','sara@gmail.com','$2y$13$lmwlI.tQ72/4Nct4Cw1bXeZHMcvvNjcQ3dStxIDzxDwlQIDjagbie','ASFSF',0,NULL,NULL,'1','1233',3,1,1),(11,'Anakin','Skywalker','anakin@gmail.com','$2y$13$05RHu0PQF05c82MHWfpn1.5J03fw4aYXIuU1qO5LYMuYbXybajgK6','Planeta Tatwin',0,NULL,'2016-03-27 18:49:39','123465970','12356465465464646464',3,1,1),(12,'Darth','Vader','darth@hotmail.com','$2y$13$DiZc9X/r3Muwtn1HETS/LuGS60JNuP/lvJxNASZQ1NYSOK3NEjpt6','Estrella de la Muerte',1,NULL,'2016-03-27 18:51:09','444444444','88888888888888888888',1,1,1),(13,'Jin','Kisaragi','jin@hotmail.com','$2y$13$WZoi/VTKyWeQhWTolil7muIVxrFR2.dfawYHa8jwykbE0oaAWaxly','NOL',1,NULL,'2016-03-27 18:56:58','111111111','12222222222222222222',3,1,1),(14,'Ragna','Bloodedge','ragna@gmail.com','$2y$13$UFwJN7KcaFrig3vRDoGHWeVFEc16htn/2SftCwwP2R2GoIWvJ5pI6','AAAA',1,NULL,'2016-03-27 19:02:49','777777777','123',1,1,1),(15,'Ragna','Bloodedge','ragna@gmail.com','$2y$13$ZsKumuHReeWhZ5lw0N1WS.IswWc.rDyYlf39d222H7TAyuH8nO20.','AAAA',1,NULL,'2016-03-27 19:03:21','777777777','123',1,1,1),(16,'Noel','Vermillion','noel@gmail.com','$2y$13$6HVAS3DefRPHl6tW0ZDmmOdYoz4B27MtXRf/7j5/CZqUd7wZhucCe','NOL',1,NULL,'2016-03-27 19:05:35','411111111','123',2,1,1),(17,'Ana','A','a@gmail.com','$2y$13$UF7j.ko1PToDTf2IZYQ6sONny9yF7vcS926ioZSf2t7U78hY5gD42','1',1,NULL,'2016-03-27 19:29:06','1','1',1,1,1),(18,'Ana','A','a@gmail.com','$2y$13$FBMXxo8fd0WP4A4miUElEOJpJT9o2rOruvwHWaXc4zJEAu6MFCs9i','1',1,NULL,'2016-03-27 19:30:03','1','1',1,1,1),(19,'Ana','A','a@gmail.com','$2y$13$ZhE9U17T52zAIX5GA0JWlee4kd7P1mJ96dBgzA8T0VcY27aadBQ8O','1',1,NULL,'2016-03-27 19:37:34','1','1',1,1,1),(20,'a','Vader','a@gmail.com','$2y$13$yq5eZRUmd0kKn7.9CrUDyOF0wwum67qczmAdFzqbM03Oz5fyZr0Qy','s',0,NULL,'2016-03-27 19:39:57','12','1234',1,1,1),(21,'Nana','Na','a@gmail.com','$2y$13$RT1QpgTD3OlAl9gkTb1Vj..5ZoI6okEEkrVyEsSnWRDMvMR0Yw6Cu','En mi mundo',1,NULL,'2016-03-27 20:46:17','111111111','123',2,1,1),(22,'Nana','Na','a@gmail.com','$2y$13$pn.ZAH/knuGPY2dLJz7p5OtY3He2LQo45wB.MiB2Ybg8ZDJzFGUnO','En mi mundo',0,NULL,'2016-03-27 20:47:21','111111111','123',2,1,1),(23,'Nana','Na','a@gmail.com','$2y$13$fpOEMgrPylQl8zcGzojhBe3k.6b.noteFMw2SEXzVBJgKsmKfbZ5G','En mi mundo',0,NULL,'2016-03-27 20:49:25','111111111','123',2,1,1),(24,'a','Vader','a@gmail.com','$2y$13$RdZizlMq8udtWbq18RJaCervugsIReTkNsVCbn7I1QZu.cTxYl.j6','awe',1,NULL,'2016-03-27 20:49:47','1','123',1,1,1),(25,'Darth','Kisaragi','mcr.jblh@gmail.com','$2y$13$XJgrluBAAA6HZHOVInG9Nez.IfspvlILuZl2a.cffgSzIG4Sc3zvS','asdwf',0,NULL,'2016-03-27 20:52:43','123','123',1,1,1),(26,'a','Kisaragi','a@gmail.com','$2y$13$tHrFddAciSVEJA1kewksSeXIpT0rpnOOvEBTJ4xtRJR5pkg88Hpaq','qwe',0,NULL,'2016-03-27 20:54:36','1212','123',1,1,1),(27,'a','Vader','mcr.jblh@gmail.com','$2y$13$41aaZMHsS6IiBogJNKtlxeTsu3rwa6ySwMa5JYwGYK8GueCy/BMhe','1213',1,NULL,'2016-03-27 20:57:14','123','12',1,1,1),(28,'Darth','Kisaragi','a@gmail.com','$2y$13$50YwoR.n9XwisI7wP8rn6ONSWdouPucYG.X.LVN2JNLyT6HpPvn92','qwe',1,NULL,'2016-03-27 21:01:24','12445','12222222222222222222',2,1,1),(29,'Darth','1','a@gmail.com','$2y$13$tC/MlWiCNT/kRLHITwkmlOIn7xFbkl6GZ9dRdv7Jv5M9KYmKPduIS','asdafasdf',0,NULL,'2016-03-27 21:02:39','123','1',3,1,1),(30,'11','11','a@gmail.com','$2y$13$HvQ6CksLKnL5Z2FM9raQqey/zPFIJIizNI9FzmNo1P2socpzSmyc6','qq',0,NULL,'2016-03-27 21:35:30','11','11',1,1,1);

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

insert  into `venta`(`oferta_id`,`usuario_id`,`fecha`) values (2,3,'2016-03-12 00:00:00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
