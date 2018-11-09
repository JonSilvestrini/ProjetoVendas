create database if not exists vendas;
use vendas;

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios`(
  `usucod` int NOT NULL AUTO_INCREMENT,
  `usunome` varchar(100) DEFAULT NULL,
  `usulogin` varchar(50) DEFAULT NULL,
  `ususenha` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`usucod`)
);

DROP TABLE IF EXISTS `produtos`;

CREATE TABLE `produtos`(
  `codigo` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `estoque` int DEFAULT NULL,
  `estoquemin` int DEFAULT NULL,
  PRIMARY KEY (`codigo`)
);

CREATE TABLE `pedidos`(
  `codped` int NOT NULL AUTO_INCREMENT,
  `total` double DEFAULT NULL,
  `dinheiro` double DEFAULT NULL,
  `troco` double DEFAULT NULL,
  PRIMARY KEY (`codped`)
);

CREATE TABLE `itens`(
  `coditem` int NOT NULL AUTO_INCREMENT,
  `pedido` int DEFAULT NULL,
  `codprod` int DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `qtde` int DEFAULT NULL,
  PRIMARY KEY (`coditem`)
);




