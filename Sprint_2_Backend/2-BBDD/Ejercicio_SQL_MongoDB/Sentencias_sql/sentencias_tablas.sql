USE cv;

CREATE TABLE IF NOT EXISTS skill (
	id INT AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(128),
    PRIMARY KEY (id)
);
CREATE TABLE IF NOT EXISTS idioma (
	id INT AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(128),
    PRIMARY KEY (id)
);
CREATE TABLE IF NOT EXISTS candidato(
	id INT AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(128),
    apellido VARCHAR(256),
    avatar VARCHAR(512),
    PRIMARY KEY(id)
);

/*Relaccion de muchos a muchos*/
CREATE TABLE IF NOT EXISTS candidato_idioma(
	id_candidato INT,
    id_idioma INT,
    nivel VARCHAR(128),
    PRIMARY KEY (id_candidato,id_idioma)
);
CREATE TABLE IF NOT EXISTS candidato_skill(
	id_candidato INT,
    id_skill INT,
    nivel VARCHAR(128),
    PRIMARY KEY (id_candidato,id_skill)
);

CREATE TABLE IF NOT EXISTS educacion(
	id INT AUTO_INCREMENT,
    id_candidato INT,
    entidad VARCHAR(128),
    tipo_formacion VARCHAR(128),
    anio YEAR,
    descripcion VARCHAR(512),
    PRIMARY KEY (id),
    FOREIGN KEY (id_candidato) REFERENCES candidato(id)    
);

CREATE TABLE IF NOT EXISTS recomendaciones(
	id INT AUTO_INCREMENT,
    id_candidato INT,
    recomendador VARCHAR (128),
    entidad VARCHAR(128),
    descripcion VARCHAR(128),
    mes DATE,
    PRIMARY KEY (id),
    FOREIGN KEY (id_candidato) REFERENCES candidato(id)
);




/*

*/
/*describe skill; describe idioma; describe candidato; 
describe candidato_skill;describe candidato_idioma;*/
