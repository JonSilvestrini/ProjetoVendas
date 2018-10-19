drop database if exists vendas;

CREATE DATABASE IF NOT EXISTS `vendas`;
USE `vendas`;

CREATE TABLE `usuarios` (
  usucod int auto_increment,
  usunome varchar(100),
  usulogin varchar(50),
  ususenha varchar (100),
  primary key(usucod)
);

CREATE TABLE produtos (
  codigo int auto_increment,
  descricao varchar(100),
  valor double,
  estoque int,
  estoquemin int,
  primary key(codigo)
);

CREATE TABLE pedidos (
  codped int auto_increment,
  total double,
  dinheiro double,
  troco double,
  primary key(codped)
);

CREATE TABLE itens (
  coditem int auto_increment,
  pedido int,
  codprod int,
  valor double,
  qtde int,
  primary key(coditem)
);



ALTER TABLE itens
  ADD FOREIGN KEY (codprod) REFERENCES produtos (codigo),
  add foreign key (pedido) references pedidos (codped);

insert into usuarios values (0, 'Admin', 'sysadmin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');