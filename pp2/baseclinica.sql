
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

CREATE TABLE medicos (
    med_id INT PRIMARY KEY,
    descripcion VARCHAR(70),
    dni INT(8), -- Número de documento
    are_id INT, -- Área a la que pertenece el médico
    FOREIGN KEY (are_id) REFERENCES areas(are_id)
);

CREATE TABLE turnos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    apellido VARCHAR(30),
    nombre VARCHAR(40),
    mail VARCHAR(40),
    telefono VARCHAR(15),
    fecha DATE,
    horario TIME,
    are_id INT,
    med_id INT,
    dni INT, -- Agrega la columna dni
    FOREIGN KEY (are_id) REFERENCES areas(are_id),
    FOREIGN KEY (med_id) REFERENCES medicos(med_id)
);



-- Crear la tabla "horarios_medicos"
CREATE TABLE horarios_medicos (
    horario_id INT AUTO_INCREMENT PRIMARY KEY,
    med_id INT, -- ID del médico al que pertenece el horario
    dia_semana INT, -- Día de la semana (por ejemplo, 1 para Lunes, 2 para Martes, etc.)
    hora_inicio TIME, -- Hora de inicio del horario disponible
    hora_fin TIME, -- Hora de finalización del horario disponible
    UNIQUE KEY (med_id, dia_semana, hora_inicio, hora_fin),
    FOREIGN KEY (med_id) REFERENCES medicos(med_id)
);



-- Insertar datos en la tabla "roles"
INSERT INTO roles (rol_id, descripcion) VALUES
(1, 'secretaria'),
(2, 'director');

-- Insertar datos en la tabla "usuario"
INSERT INTO usuario (id, nombre, usuario, contrasena, rol_id) VALUES
(1, 'Agustina Cherry', '12345678', 'noche1990', 1),
(2, 'Federico Lacroze', '98765432', 'plastico10', 2);


INSERT INTO areas (are_id, descripcion) VALUES
(1,'Cardiologia'),
(2,'Neurologia'),
(3,'Clinica General'),
(4,'Urologia'),
(5,'Hematologia'),
(6, 'Cirugia');


INSERT INTO medicos (med_id, descripcion) VALUES


(1, 'Huffmann Eduardo'),
(2, 'Ventos Sabrina'),
(3, 'Scholz Alejandro'),
(4, 'Del Puerto Maria Fernanda '),
(5, 'Cabrera Maria del Pilar'),
(6, 'Suarez Jose Ignacio'),
(7, 'Domenichini Federico'),
(8, 'Tula Rovaletti Abelardo'),
(9, 'Valdez Alarcon Marilina'),
(10, 'Galeano Jose Antonio'),
(11, 'Locatti Gabriel Alejandro'),
(12, 'Prieto Juan Martin');


-- Insertar datos en la tabla "roles"
INSERT INTO roles (rol_id, descripcion) VALUES
(1, 'secretaria'),
(2, 'director');

-- Insertar datos en la tabla "usuario"
INSERT INTO usuario (id, nombre, usuario, contrasena, rol_id) VALUES
(1, 'Agustina Cherry', '12345678', 'noche1990', 1),
(2, 'Federico Lacroze', '98765432', 'plastico10', 2);


-- Insertar horarios de trabajo de los médicos
INSERT INTO horarios_medicos (med_id, are_id, dia_semana, hora_inicio, hora_fin)
VALUES
(1, 1, 1, '08:00:00', '12:00:00'), -- Huffmann Eduardo en Cardiologia, Lunes de 8 a 12
(1, 1, 5, '08:00:00', '12:00:00'), -- Huffmann Eduardo en Cardiologia, Viernes de 8 a 12
(2, 1, 2, '16:00:00', '20:00:00'), -- Ventos Sabrina en Cardiologia, Martes de 16 a 20
(2, 1, 4, '16:00:00', '20:00:00'), -- Ventos Sabrina en Cardiologia, Jueves de 16 a 20
(3, 6, 1, '14:00:00', '18:00:00'), -- Scholz Alejandro en Cirugia, Lunes de 14 a 18
(3, 6, 3, '14:00:00', '18:00:00'), -- Scholz Alejandro en Cirugia, Miercoles de 14 a 18
(4, 6, 4, '09:00:00', '13:00:00'), -- Del Puerto Maria Fernanda en Cirugia, Jueves de 9 a 13
(5, 5, 2, '14:00:00', '17:00:00'), -- Cabrera Maria del Pilar en Hematologia, Martes de 14 a 17
(5, 5, 5, '14:00:00', '17:00:00'), -- Cabrera Maria del Pilar en Hematologia, Viernes de 14 a 17
(6, 5, 3, '15:00:00', '20:00:00'), -- Suarez Jose Ignacio en Hematologia, Miercoles de 15 a 20
(7, 4, 1, '09:00:00', '11:00:00'), -- Domenichini Federico en Urologia, Lunes de 9 a 11
(7, 4, 3, '09:00:00', '11:00:00'), -- Domenichini Federico en Urologia, Miercoles de 9 a 11
(7, 4, 4, '09:00:00', '11:00:00'), -- Domenichini Federico en Urologia, Jueves de 9 a 11
(8, 4, 2, '15:00:00', '18:00:00'), -- Tula Rovaletti Abelardo en Urologia, Martes de 15 a 18
(9, 3, 1, '08:00:00', '12:00:00'), -- Valdez Alarcon Marilina en Clinica General, Lunes de 8 a 12
(9, 3, 2, '08:00:00', '12:00:00'), -- Valdez Alarcon Marilina en Clinica General, Martes de 8 a 12
(9, 3, 3, '08:00:00', '12:00:00'), -- Valdez Alarcon Marilina en Clinica General, Miercoles de 8 a 12
(10, 3, 2, '15:00:00', '20:00:00'), -- Galeano Jose Antonio en Clinica General, Martes de 15 a 20
(10, 3, 3, '15:00:00', '20:00:00'), -- Galeano Jose Antonio en Clinica General, Miercoles de 15 a 20
(10, 3, 5, '15:00:00', '20:00:00'), -- Galeano Jose Antonio en Clinica General, Viernes de 15 a 20
(11, 2, 2, '08:00:00', '12:00:00'), -- Locatti Gabriel Alejandro en Neurologia, Martes de 8 a 12
(12, 2, 4, '16:00:00', '20:00:00'); -- Prieto Juan Martin en Neurologia, Jueves de 16 a 20
