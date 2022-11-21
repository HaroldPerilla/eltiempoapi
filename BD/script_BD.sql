CREATE DATABASE eltiempoapi;

create table productos(
	id int(11) auto_increment primary key,
	nombre varchar(100),
	cantidad int(11),
	precio int(11),
	activo int(11),
	created_at datetime,
	updated_at datetime
);
