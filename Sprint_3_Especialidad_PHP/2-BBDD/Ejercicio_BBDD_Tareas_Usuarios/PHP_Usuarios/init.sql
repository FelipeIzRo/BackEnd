CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    email VARCHAR(100)
);

CREATE TABLE tareas (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nombre VARCHAR(50),descripcion VARCHAR(280),
    id_usuario INT, FOREIGN KEY (id_usuario) 
    REFERENCES usuarios(id)
);

INSERT INTO usuarios (nombre,email) VALUES ('Usuario','De Prueba');