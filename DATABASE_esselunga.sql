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
    quantità int check (quantità >0),
    costo_euro double,
    foreign key(id_prodotto) references prodotti(ID)
);

-- create table mpeso(
-- ID int PRIMARY KEY auto_increment,
--    id_prodotto int,
--   peso double,
--    costo_euro double,
--    foreign key(id_prodotto) references prodotti(ID)
-- );

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
insert into reparto values(default,"scuola");-- id 8

-- insert bevande
insert into prodotti values(default,"Acqua",1,"../Images/acqua naturale.jpeg");
insert into prodotti values(default,"Coca-cola",1,"../Images/coca cola.jpeg");
insert into prodotti values(default,"Fanta",1,"../Images/fanta.jpeg");
-- insert bevande in munit
insert into munit values(default,1,5,0.50);
insert into munit values(default,2,10,1);
insert into munit values(default,3,8,3);

-- insert colazione
insert into prodotti values(default,"Abbracci",2,"../Images/abbracci.jpeg");
insert into prodotti values(default,"Gocciole",2,"../Images/gocciole.jpeg");
insert into prodotti values(default,"Pan di stelle",2,"../Images/pandistelle.jpeg");
-- insert colazione in munit
insert into munit values(default,4,10,3);
insert into munit values(default,5,15,2);
insert into munit values(default,6,8,2.20);

-- insert pasta
insert into prodotti values(default,"Penne",3,"../Images/penne.jpeg");
insert into prodotti values(default,"Spaghetti",3,"../Images/spaghetti5.jpeg");
insert into prodotti values(default,"Ditalini",3,"../Images/dit.jpeg");
-- insert pasta in munit
insert into munit values(default,7,11,5.7);
insert into munit values(default,8,7,2.8);
insert into munit values(default,9,9,2);

-- insert salumeria
insert into prodotti values(default,"Culatello",4,"../Images/culatello.jpeg");
insert into prodotti values(default,"Lardo",4,"../Images/lardo.jpeg");
insert into prodotti values(default,"Salame",4,"../Images/dit.jpeg");
-- insert salumeria in munit
insert into munit values(default,10,20,4);
insert into munit values(default,11,8,2.9);
insert into munit values(default,12,12,2.5);

-- insert frutta e verdura
insert into prodotti values(default,"Mela",5,"../Images/mele.jpeg");
insert into prodotti values(default,"Banane",5,"../Images/banana.jpeg");
insert into prodotti values(default,"Arance",5,"../Images/arance.jpeg");
-- insert salumeria in munit
insert into munit values(default,13,15,3.7);
insert into munit values(default,14,10,2.1);
insert into munit values(default,15,8,1.5);

-- insert dolci
insert into prodotti values(default,"Profiterole",6,"../Images/profitterol.jpeg");
insert into prodotti values(default,"Torta al semolino",6,"../Images/torta al semolino.jpeg");
insert into prodotti values(default,"Tiramisu",6,"../Images/tiramisu.jpeg");
-- insert dolci in munit
insert into munit values(default,16,19,3.9);
insert into munit values(default,17,11,2);
insert into munit values(default,18,10,4.5);

-- insert casa
insert into prodotti values(default,"Scottex",7,"../Images/scottex.jpg");
insert into prodotti values(default,"Carteigenica",7,"../Images/carteigenica.jpeg");
insert into prodotti values(default,"Fazzoletti",7,"../Images/fazzoletti.jpeg");
-- insert casa in munit
insert into munit values(default,19,17,2.3);
insert into munit values(default,20,12,1.2);
insert into munit values(default,21,5,4.8);

-- insert scuola
insert into prodotti values(default,"Astuccio",8,"../Images/astu.jpeg");
insert into prodotti values(default,"Quaderni",8,"../Images/quaderni.jpeg");
insert into prodotti values(default,"Album da disegno",8,"../Images/album da disegno.jpeg");
-- insert scuola in munit
insert into munit values(default,22,15,7.8);
insert into munit values(default,23,10,2);
insert into munit values(default,24,18,4);



SELECT p.id,p.immagine,p.descrizione,mu.costo_euro FROM Prodotti p join Reparto r on p.idReparto=r.id join munit mu on p.id=mu.id_prodotto where r.nome ='bevande';


SELECT count(c.id_prodotto) as conta,c.id_prodotto,p.immagine,p.descrizione,mu.costo_euro FROM Prodotti p join Reparto r on p.idReparto=r.id 
join munit mu on p.id=mu.id_prodotto join carrello c on c.id_prodotto=p.id where c.id_login=1
group by c.id_login,c.id_prodotto;