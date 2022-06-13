create database reserve;
use reserve;

create table usuarios(
id int not null auto_increment primary key,
rut varchar(12) not null,
nombre varchar(40) not null,
apellido varchar(60) not null,
contraseña varchar(64) not null
);

create table bloques(
bloque int not null auto_increment primary key,
hora time not null
);

create table curso(
id_cur int not null auto_increment primary key,
nombre varchar(30) not null
);

create table laboratorio(
id_lab int not null auto_increment primary key,
nombre varchar(60) not null
);

create table reserva(
id_res int not null auto_increment primary key,
fecha date not null,
bloque int not null references bloques(bloque),
curso int not null references curso(id_cur),
id_lab int not null references laboratorio(id_lab),
asignatura varchar(40) not null
);