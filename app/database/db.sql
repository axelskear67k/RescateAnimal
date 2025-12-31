CREATE DATABASE rescate;

use rescate;

CREATE TABLE animales
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  clasificacion ENUM('Cachorro','Adulto','Senior','Discapacitado') NOT NULL,
  nombre         VARCHAR(50)  NOT NULL,
  especie        VARCHAR(30)  NOT NULL,
  raza           VARCHAR(50)  NOT NULL,
  genero         VARCHAR(10)  NOT NULL,
  Condiciones    VARCHAR(100) NOT NULL,
  vacunas        VARCHAR(50)  NOT NULL,
  estado         VARCHAR(20)  NOT NULL,
  ingreso        DATE         NOT NULL,
  foto           VARCHAR(200)  NULL,
  created       DATETIME      NOT NULL DEFAULT NOW() COMMENT 'Campo calculado Fecha y Hora',
  updated       DATETIME      NOT NULL COMMENT 'se agrega al detectar un cambio'

)ENGINE = INNODB; /*  INNODB (relacional -join), MYISAM (veloz no relacional)*/




/* En cada insert into 1. Valida, 2 Verifica, 3 Calcula, 4 Escribe, 5 Actualiza

Se usa un solo insert into para no sobrecargar el equipo */

INSERT INTO animales 
(clasificacion, nombre, especie, raza, genero, condiciones, vacunas, estado, ingreso, foto)
VALUES
('Adulto', 'Max', 'Perro', 'Labrador', 'Macho', 'Saludable', 'Completa', 'Disponible', '2024-01-15', 'labrador.png'),
('Adulto', 'Luna', 'Gato', 'Siames', 'Hembra', 'Alergias leves', 'Completa', 'Adoptado', '2023-11-20', 'luna.png'),
('Senior', 'Rocky', 'Perro', 'Bulldog', 'Macho', 'Artritis', 'Parcial', 'En tratamiento', '2022-05-10', 'rocky.png'),
('Discapacitado', 'Mimi', 'Gato', 'Persa', 'Hembra', 'Ceguera parcial', 'Completa', 'Disponible', '2024-03-05', 'persa.png');SELECT*FROM animales;

SELECT * FROM animales;
/* Ordena los datos de forma desendente, de los ultimos registros ingresados
a los mas antiguos */
SELECT 
id,classificacion, nombre, especie, raza, genero, estado, ingreso
 FROM animales
 ORDER BY id DESC;


 CREATE TABLE personas 
 (
  clasificacion ENUM('Adoptante','Voluntario','Donante','Veterinario') NOT NULL,
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre        VARCHAR (150)  NOT NULL,
  apellidos     VARCHAR (150)  NOT NULL,
  telefono      CHAR    (9)    NOT NULL,
  direccion     VARCHAR (200)  NOT NULL,
 idanimal      INT              NULL,
 fecha DATE NOT NULL,
  created       DATETIME      NOT NULL DEFAULT NOW() COMMENT 'Campo calculado Fecha y Hora',
  updated       DATETIME      NOT NULL COMMENT 'se agrega al detectar un cambio'

 )


drop table personas;
SELECT COUNT(*) FROM personas;

INSERT INTO personas(
clasificacion, nombre, apellidos, telefono, direccion, idanimal,fecha
) VALUES
('Adoptante', 'Carlos', 'Perez', '987654321', 'Calle Falsa 123', 1,'2024-06-10'),
('Voluntario', 'Ana', 'Gomez', '912345678', 'Avenida Siempre Viva 456', NULL,'2024-06-12'),
('Donante', 'Luis', 'Martinez', '923456789', 'Boulevard Central 789', NULL,'2024-06-15'),
('Veterinario', 'Sofia', 'Lopez', '934567890', '      Calle del Sol 101', 2,'2024-06-18');  




 SELECT * FROM personas;
