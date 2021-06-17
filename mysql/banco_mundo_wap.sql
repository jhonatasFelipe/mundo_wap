create database mundo_wap;
use mundo_wap;

create table produto (
    EAN int(11) not null,
    nome varchar(50) not null,
    preco decimal(6,2) not null,
    estoque int(11) not null,
    fabricacao date nullable ,
    primary key (EAN)
);

create table usuario (
    id int(11) not null auto_increment,
    email varchar(50) not null,
    senha varchar(100) not null,
    primary key (id)
);