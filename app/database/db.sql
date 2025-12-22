CREATE DATABASE rescate;

use rescate;

CREATE TABLE animales
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  classificacion ENUM('Cachorro','Adulto','Senior','Discapacitado') NOT NULL,
  nombre         VARCHAR(50)  NOT NULL,
  especie        VARCHAR(30)  NOT NULL,
  raza           VARCHAR(50)  NOT NULL,
  genero         VARCHAR(10)  NOT NULL,
  Condiciones    VARCHAR(100) NOT NULL,
  vacunas        VARCHAR(50)  NOT NULL,
  estado         VARCHAR(20)  NOT NULL,
  ingreso        DATE         NOT NULL,
  created       DATETIME      NOT NULL DEFAULT NOW() COMMENT 'Campo calculado Fecha y Hora',
  updated       DATETIME      NOT NULL COMMENT 'se agrega al detectar un cambio'

)ENGINE = INNODB; /*  INNODB (relacional -join), MYISAM (veloz no relacional)*/



/* En cada insert into 1. Valida, 2 Verifica, 3 Calcula, 4 Escribe, 5 Actualiza

Se usa un solo insert into para no sobrecargar el equipo */

INSERT INTO animales 
(classificacion, nombre, especie, raza, genero, Condiciones, Vacunas, estado, ingreso)
VALUES
('Cachorro', 'Max', 'Perro', 'Labrador', 'Macho', 'Saludable', 'Completa', 'Disponible', '2024-01-15'),
('Adulto', 'Luna', 'Gato', 'Siames', 'Hembra', 'Alergias leves', 'Completa', 'Adoptado', '2023-11-20'),
('Senior', 'Rocky', 'Perro', 'Bulldog', 'Macho', 'Artritis', 'Parcial', 'En tratamiento', '2022-05-10'),
('Discapacitado', 'Mimi', 'Gato', 'Persa', 'Hembra', 'Ceguera parcial', 'Completa', 'Disponible', '2024-03-05');
SELECT*FROM animales;
/* Ordena los datos de forma desendente, de los ultimos registros ingresados
a los mas antiguos */
SELECT 
id,classificacion, nombre, especie, raza, genero, estado, ingreso
 FROM animales
 ORDER BY id DESC;


 CREATE TABLE personas 
 (
  clasifiacion ENUM('Adoptante','Voluntario','Donante','Veterinario') NOT NULL,
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre        VARCHAR (150)  NOT NULL,
  apellidos     VARCHAR (150)  NOT NULL,
  telefono      CHAR    (9)    NOT NULL,
  direccion     VARCHAR (200)  NOT NULL,
  ingreso       DATE           NOT NULL,
  created       DATETIME      NOT NULL DEFAULT NOW() COMMENT 'Campo calculado Fecha y Hora',
  updated       DATETIME      NOT NULL COMMENT 'se agrega al detectar un cambio'

 )


INSERT INTO personas 
(clasifiacion, nombre, apellidos, telefono, direccion, ingreso)
VALUES
('Adoptante', 'Carlos', 'Gomez', '612345678', 'Calle Falsa 123', '2023-12-01'),
('Voluntario', 'Ana', 'Martinez', '698765432', 'Avenida Siempre Viva 456', '2024-02-15'),
('Donante', 'Luis', 'Rodriguez', '948626955', 'Plaza Central 789', '2023-10-20'),
('Veterinario', 'Sofia', 'Lopez', '600123456', 'Calle Mayor 101', '2024-01-30');

 SELECT * FROM personas;
