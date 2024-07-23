SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;
-- DROP TABLE IF EXISTS `evento`;
CREATE TABLE IF NOT EXISTS productos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
    description VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
    price DECIMAL (10,2) NOT NULL,
    stock INT NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO productos (name,description,price,stock) values ('Producto1','Descripcion 1',10.50,20);
INSERT INTO productos (name,description,price,stock) values ('Producto2','Descripcion 2',2.50,15);