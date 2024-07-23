SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;
-- DROP TABLE IF EXISTS `evento`;
CREATE TABLE IF NOT EXISTS evento (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
    ubicacion VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
    fecha DATETIME NOT NULL,
    detalles VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
