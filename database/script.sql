create database reserva;


use reserva;

create table tipousuarios(
id_tip int not null auto_increment primary key,
nombre varchar(30) not null
);

insert into tipousuarios values(null, "Administrador");
insert into tipousuarios values(null, "Supervisor");
insert into tipousuarios values(null, "usuario");

create table users(
id_usu int not null auto_increment primary key,
rut varchar(12) not null,
nombre varchar(60) not null,
apellido varchar(60) not null,
id_tip int not null references tipousuarios(id_tip),
correo varchar(60) not null,
contrasena varchar(64),
token varchar(64) not null,
fecha timestamp not null
);

insert into users values(null, "25.484.361-K", "Departamento", "Informatica", 1, "informatica@colegiograneros.cl",sha1("21chichi"),sha1("informatica@colegiograneros.cl"),now());


create table bloques(
id_blo int not null auto_increment primary key,
nombre varchar(40) not null,
hora varchar(20) not null
);

insert into bloques values(null,'Bloque 1','08:00 - 08:45');
insert into bloques values(null,'Bloque 2','08:45 - 09:30');
insert into bloques values(null,'Bloque 3','09:45 - 10:30');
insert into bloques values(null,'Bloque 4','10:30 - 11:15');
insert into bloques values(null,'Bloque 5','11:30 - 12:15');
insert into bloques values(null,'Bloque 6','12:15 - 13:00');
insert into bloques values(null,'Bloque 7','14:00 - 14:45');
insert into bloques values(null,'Bloque 8','14:45 - 15:30');
insert into bloques values(null,'Bloque 9','15:45 - 16:30');
insert into bloques values(null,'Bloque 10','16:30 - 17:15');

create table sala(
id_sal int not null auto_increment primary key,
nombre varchar(100) not null
);

insert into sala values(null, "Laboratorio Informatica");
insert into sala values(null, "Sala Computacion");

create table curso(
id_cur int not null auto_increment primary key,
nombre varchar(30) not null
);

insert into curso(nombre) values('1 Basico A');
insert into curso(nombre) values('1 Basico B');
insert into curso(nombre) values('2 Basico A');
insert into curso(nombre) values('2 Basico B');
insert into curso(nombre) values('3 Basico A');
insert into curso(nombre) values('3 Basico B');
insert into curso(nombre) values('4 Basico A');
insert into curso(nombre) values('4 Basico B');
insert into curso(nombre) values('5 Basico A');
insert into curso(nombre) values('5 Basico B');
insert into curso(nombre) values('6 Basico A');
insert into curso(nombre) values('6 Basico B');
insert into curso(nombre) values('7 Basico A');
insert into curso(nombre) values('7 Basico B');
insert into curso(nombre) values('8 Basico A');
insert into curso(nombre) values('8 Basico B');
insert into curso(nombre) values('1 Medio A');
insert into curso(nombre) values('1 Medio B');
insert into curso(nombre) values('2 Medio A');
insert into curso(nombre) values('2 Medio B');
insert into curso(nombre) values('3 Medio');
insert into curso(nombre) values('4 Medio');
insert into curso(nombre) values('Prekinder A');
insert into curso(nombre) values('Prekinder B');
insert into curso(nombre) values('Kinder A');
insert into curso(nombre) values('Kinder B');
insert into curso values(null,'3 y 4 Medio Electivo');
insert into curso values(null,'Sala Computación');
insert into curso values(null,'Laboratorio Computación');


create table reserva(
id_res int not null auto_increment primary key,
cant_alu int not null,
id_sal int not null references  sala(id_sal),
asignatura varchar(50) not null,
fecha date not null,
id_cur int not null references curso(id_cur),
id_usu int not null references users(id_usu)
);

create table detalles_reserva(
id_det int not null auto_increment primary key,
id_res int not null references reserva,
id_blo int not null references bloques(id_blo)
);