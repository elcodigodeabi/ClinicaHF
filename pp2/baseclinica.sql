create database baseclinica;

use baseclinica;

CREATE TABLE roles (
    rol_id INT PRIMARY KEY,
    descripcion VARCHAR(20)
);

-- Crear la tabla "usuario"
CREATE TABLE usuario (
    id INT PRIMARY KEY,
    nombre VARCHAR(70),
    usuario int(8),
    contrasena VArchar(10),
    rol_id INT,
    FOREIGN KEY (rol_id) REFERENCES roles(rol_id)
);

-- Crear la tabla "areas"
CREATE TABLE areas (
    are_id INT PRIMARY KEY,
    descripcion VARCHAR(20)
);

-- Crear la tabla "medicos"
CREATE TABLE medicos (
    med_id INT PRIMARY KEY,
    descripcion VARCHAR(20)
);

-- Crear la tabla "turnos"
CREATE TABLE turnos (
    id INT PRIMARY KEY,
    apellido VARCHAR(30),
    nombre VARCHAR(40),
    mail VARCHAR(40),
    telefono VARCHAR(15),
    fecha DATE,
    horario TIME,
    are_id INT,
    med_id INT,
    FOREIGN KEY (are_id) REFERENCES areas(are_id),
    FOREIGN KEY (med_id) REFERENCES medicos(med_id)
);

-- Insertar datos en la tabla "roles"
INSERT INTO roles (rol_id, descripcion) VALUES
(1, 'secretaria'),
(2, 'director');

-- Insertar datos en la tabla "usuario"
INSERT INTO usuario (id, nombre, usuario, contrasena, rol_id) VALUES
(1, 'Agustina Cherry', '34789098', 'noche1990', 1),
(2, 'Federico Lacroze', '25780283', 'plastico10', 2);

-- Insertar datos en la tabla "areas" con IDs en orden incremental
INSERT INTO areas (are_id, descripcion) VALUES
(1, 'cardiologia'),
(2, 'neurologia'),
(3, 'general'),
(4, 'pediatria');

-- Insertar datos en la tabla "medicos"
INSERT INTO medicos (med_id, descripcion) VALUES
(1, 'Huffmann'),
(2, 'Perez Pardo'),
(3, 'Vargas'),
(4, 'Abi');
