use cv;
/*___________SELECCION DE SKILL_________________*/
select CONCAT(can.nombre, ' ' ,can.apellido) as Candidato , s.nombre as Tecnologia , cans.nivel 
from candidato_skill cans
left join candidato can on cans.id_candidato = can.id
left join skill s on cans.id_skill = s.id
where can.id = 1
order by Tecnologia;

/*___________SELECCION DE IDIOMA_________________*/
select CONCAT(can.nombre, ' ' ,can.apellido) as Candidato , i.nombre as Idioma , ci.nivel 
from candidato_idioma ci
left join candidato can on ci.id_candidato = can.id
left join idioma i on ci.id_idioma = i.id
where can.id = 1
order by Idioma;

/*___________SELECCION DE RECOMENDACIONES_________________*/
select CONCAT(can.nombre, ' ' ,can.apellido) as Candidato, rec.recomendador, rec.entidad, rec.descripcion, rec.mes
from recomendaciones rec
left join candidato can on can.id = rec.id_candidato
where can.id = 1;

/*___________SELECCION DE EDUCACION_________________*/
select CONCAT(can.nombre, ' ' ,can.apellido) as Candidato, edu.tipo_formacion, edu.entidad, edu.descripcion, edu.anio
from educacion edu
left join candidato can on can.id = edu.id_candidato
where can.id = 1;

/*___________SELECCION DE CANDIDATOS QUE SABEN INGLES_________________*/
select CONCAT(can.nombre, ' ' ,can.apellido) as Candidato , i.nombre as Idioma , ci.nivel 
from candidato_idioma ci
left join candidato can on ci.id_candidato = can.id
left join idioma i on ci.id_idioma = i.id
where ci.id_idioma = 1
order by Idioma;

/*___________SELECCION DE CANDIDATO CON RECOMENDACIONES_________________*/
select CONCAT(can.nombre, ' ' ,can.apellido) as Candidato, rec.recomendador, rec.entidad, rec.descripcion, rec.mes
from recomendaciones rec
left join candidato can on can.id = rec.id_candidato
where can.id >= 1;



