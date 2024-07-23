use cv;

insert into candidato (nombre,apellido,avatar) values('Raul','Mendez Garcia','http://avatar.com');
/*
INSERT INTO recomendaciones (id_candidato,recomendador,entidad,descripcion,mes) values
(3,'Felix Escarda','IES Gaspar Melchor de Jovellanos','Alumno que conoce bien los sistemas operativos 
y controla de gestion de usuarios','2023-05-29');*/

INSERT INTO educacion (id_candidato,entidad,tipo_formacion,anio,descripcion)
values(4,'IES Gaspar Melchor de Jovellanos','ASIR',2021,'Curso de gestion de sistemas informaticos');

/*INSERT INTO idioma (nombre) values ('Italiano');
INSERT INTO skill (nombre) values ('PHP');*/

INSERT INTO candidato_idioma (id_candidato,id_idioma,nivel) values (4,(select id from idioma where nombre='Italiano'),'Medio');
INSERT INTO candidato_idioma (id_candidato,id_idioma,nivel) values (4,(select id from idioma where nombre='Frances'),'Alto');

INSERT INTO candidato_skill (id_candidato,id_skill,nivel) values (1,1,'Medio');
INSERT INTO candidato_skill (id_candidato,id_skill,nivel) values (1,2,'Alto');
INSERT INTO candidato_skill (id_candidato,id_skill,nivel) values (1,3,'Alto');
INSERT INTO candidato_skill (id_candidato,id_skill,nivel) values (1,4,'Medio');
INSERT INTO candidato_skill (id_candidato,id_skill,nivel) values (1,5,'Bajo');
/*UPDATE educacion SET descripcion = 'Desarrollo de aplicaciones web' where id_candidato = 2;*/

select * from skill;