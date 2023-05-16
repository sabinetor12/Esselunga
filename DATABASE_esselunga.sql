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
    immagine varchar(512),
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

create table carrello(
	ID int PRIMARY KEY auto_increment,
    id_prodotto int,
    id_login int,
    foreign key(id_login) references login(ID)
);

insert into reparto values(default,"bevande");-- id 1
insert into reparto values(default,"colazione");-- id 2
-- insert bevande
insert into prodotti values(default,"acqua",1,"../Images/acqua naturale.jpeg");
insert into prodotti values(default,"coca-cola",1,"../Images/coca cola.jpeg");
insert into prodotti values(default,"fanta",1,"../Images/fanta.jpeg");
-- insert bevande in munit
insert into munit values(default,1,5,0.50);
insert into munit values(default,2,10,1);
insert into munit values(default,3,8,3);

-- insert colazione 
insert into prodotti values(default,"abbracci",2,"../Images/abbracci.jpeg");
insert into prodotti values(default,"gocciole",2,"../Images/gocciole.jpeg");
insert into prodotti values(default,"pan di stelle",2,"../Images/pandistelle.jpeg");
-- insert colazione in munit
insert into munit values(default,5,10,3);
insert into munit values(default,6,15,2);
insert into munit values(default,7,8,2.2);




SELECT p.id,p.immagine,p.descrizione,mu.costo_euro FROM Prodotti p join Reparto r on p.idReparto=r.id join munit mu on p.id=mu.id_prodotto where r.nome ='bevande'