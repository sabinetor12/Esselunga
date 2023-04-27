DROP DATABASE IF EXISTS EsselungaDB;
CREATE DATABASE EsselungaDB;
USE EsselungaDB;

create table login(
	ID int PRIMARY KEY auto_increment,
    mail VARCHAR(64) unique,
    cognome varchar(64),
    indirizzo varchar(64),
    nome varchar(64),
    password varchar(10)
);

create table reparto(
	ID int PRIMARY KEY auto_increment,
    nome varchar(64)
);

create table prodotti(
	ID int PRIMARY KEY auto_increment,
    descrizione varchar(64),
    idReparto int,
    foreign key(idReparto) references reparto(ID)
);

create table munit(
	ID int PRIMARY KEY auto_increment,
    id_prodotto int,
    quantità int,
    costo_euro double,
    foreign key(id_prodotto) references prodotti(ID)
);

create table mpeso(
	ID int PRIMARY KEY auto_increment,
    id_prodotto int,
    peso double,
    costo_euro double,
    foreign key(id_prodotto) references prodotti(ID)
);

insert into reparto values (default,"Frutta e verdura");
insert into reparto values (default,"Dolci");

insert into prodotti values(default,"Torta al semolino","2")

    