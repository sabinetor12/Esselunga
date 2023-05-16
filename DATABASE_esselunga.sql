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
    foreign key(id_login) references login(ID),
    foreign key(id_prodotto) references prodotti(ID)
);

insert into reparto values(default,"bevande");-- id 1
insert into reparto values(default,"colazione");-- id 2
insert into reparto values(default,"pasta");-- id 3
insert into reparto values(default,"salumeria");-- id 4
insert into reparto values(default,"frutta e verdura");-- id 5
insert into reparto values(default,"dolci");-- id 6
insert into reparto values(default,"casa");-- id 7
insert into reparto values(default,"casa");-- id 8

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

-- insert pasta
insert into prodotti values(default,"penne",3,"../Images/penne.jpeg");
insert into prodotti values(default,"spaghetti",3,"../Images/spaghetti5.jpeg");
insert into prodotti values(default,"ditalini",3,"../Images/dit.jpeg");
-- insert pasta in munit
insert into munit values(default,8,11,5.7);
insert into munit values(default,9,7,2.8);
insert into munit values(default,10,9,2);

-- insert salumeria
insert into prodotti values(default,"culatello",4,"../Images/culatello.jpeg");
insert into prodotti values(default,"lardo",4,"../Images/lardo.jpeg");
insert into prodotti values(default,"salame",4,"../unghe/dit.jpeg");
-- insert salumeria in munit
insert into munit values(default,11,20,4);
insert into munit values(default,12,8,2.9);
insert into munit values(default,13,12,2.5);

-- insert frutta e verdura
insert into prodotti values(default,"mela",5,"../Images/mele.jpeg");
insert into prodotti values(default,"banane",5,"../Images/banana.jpeg");
insert into prodotti values(default,"arance",5,"../unghe/arance.jpeg");
-- insert salumeria in munit
insert into munit values(default,14,15,3.7);
insert into munit values(default,15,10,2.1);
insert into munit values(default,16,8,1.5);

-- insert dolci
insert into prodotti values(default,"profiterole",6,"../Images/profitterol.jpeg");
insert into prodotti values(default,"torta al semolino",6,"../Images/torta al semolino.jpeg");
insert into prodotti values(default,"tiramisu",6,"../unghe/tiramisu.jpeg");
-- insert dolci in munit
insert into munit values(default,17,19,3.9);
insert into munit values(default,18,11,2);
insert into munit values(default,19,10,4.5);

-- insert casa
insert into prodotti values(default,"scottex",7,"../Images/scottex.jpeg");
insert into prodotti values(default,"carteigenica",7,"../Images/carteigenica.jpeg");
insert into prodotti values(default,"fazzoletti",7,"../unghe/fazzoletti.jpeg");
-- insert casa in munit
insert into munit values(default,20,17,2.3);
insert into munit values(default,21,12,1.2);
insert into munit values(default,22,5,4.8);

-- insert scuola
insert into prodotti values(default,"astuccio",8,"../Images/astu.jpeg");
insert into prodotti values(default,"quaderni",8,"../Images/quaderni.jpeg");
insert into prodotti values(default,"album da disegno",8,"../unghe/album da disegno.jpeg");
-- insert acuola in munit
insert into munit values(default,23,15,7.8);
insert into munit values(default,24,10,2);
insert into munit values(default,25,18,4);



SELECT p.id,p.immagine,p.descrizione,mu.costo_euro FROM Prodotti p join Reparto r on p.idReparto=r.id join munit mu on p.id=mu.id_prodotto where r.nome ='bevande';


SELECT count(c.id_prodotto) as conta,c.id_prodotto,p.immagine,p.descrizione,mu.costo_euro FROM Prodotti p join Reparto r on p.idReparto=r.id 
join munit mu on p.id=mu.id_prodotto join carrello c on c.id_prodotto=p.id where c.id_login=1
group by c.id_login,c.id_prodotto;