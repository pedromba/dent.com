-- Creación de la base de datos

drop database if exists clinica_medica;
CREATE DATABASE clinica_medica;
USE clinica_medica;

-- Tabla: Pacientes
CREATE TABLE Pacientes (
    id_paciente INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    fecha_nacimiento DATE,
    direccion VARCHAR(255),
    telefono VARCHAR(20),
    email VARCHAR(255)
);

-- Tabla: Historial_Medico
CREATE TABLE Historial_Medico (
    id_historial INT PRIMARY KEY AUTO_INCREMENT,
    id_paciente INT,
    fecha DATE NOT NULL,
    diagnostico TEXT,
    tratamiento TEXT,
    notas TEXT,
    FOREIGN KEY (id_paciente) REFERENCES Pacientes(id_paciente)
);

-- Tabla: Empleados
CREATE TABLE Empleados (
    id_empleado INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    especialidad VARCHAR(255),
    semblanza TEXT,
    tipo_empleado int,
    FOREIGN KEY (tipo_empleado) REFERENCES tipo_empleado(id_tipo)
);

create table tipo_empleado(
    id_tipo int PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(255),
    descripcion TEXT
);

-- Tabla: Servicios
CREATE TABLE Servicios (
    id_servicio INT PRIMARY KEY AUTO_INCREMENT,
    nombre_servicio VARCHAR(255) NOT NULL,
    descripcion TEXT,
    id_empleado INT,
    FOREIGN KEY (id_empleado) REFERENCES Empleados(id_empleado)
);

-- Tabla: Citas
CREATE TABLE Citas (
    id_cita INT PRIMARY KEY AUTO_INCREMENT,
    id_paciente INT,
    id_empleado INT,
    fecha_hora DATETIME NOT NULL,
    motivo TEXT,
    estado ENUM('agendada', 'realizada', 'cancelada'),
    FOREIGN KEY (id_paciente) REFERENCES Pacientes(id_paciente),
    FOREIGN KEY (id_empleado) REFERENCES Empleados(id_empleado)
);

-- Tabla: Farmacos
CREATE TABLE Farmacos (
    id_farmaco INT PRIMARY KEY AUTO_INCREMENT,
    nombre_farmaco VARCHAR(255) NOT NULL,
    descripcion TEXT,
    stock INT
);

-- Tabla: Recetas
CREATE TABLE Recetas (
    id_receta INT PRIMARY KEY AUTO_INCREMENT,
    id_paciente INT,
    id_empleado INT,
    id_farmaco INT,
    fecha DATE NOT NULL,
    dosis VARCHAR(255),
    instrucciones TEXT,
    FOREIGN KEY (id_paciente) REFERENCES Pacientes(id_paciente),
    FOREIGN KEY (id_empleado) REFERENCES Empleados(id_empleado),
    FOREIGN KEY (id_farmaco) REFERENCES Farmacos(id_farmaco)
);

-- Tabla: Resultados_Laboratorio
CREATE TABLE Resultados_Laboratorio (
    id_resultado INT PRIMARY KEY AUTO_INCREMENT,
    id_paciente INT,
    fecha DATE NOT NULL,
    tipo_prueba VARCHAR(255),
    resultados TEXT,
    FOREIGN KEY (id_paciente) REFERENCES Pacientes(id_paciente)
);

-- Tabla: Casos_Exito
CREATE TABLE Casos_Exito (
    id_caso INT PRIMARY KEY AUTO_INCREMENT,
    id_paciente INT,
    descripcion TEXT,
    FOREIGN KEY (id_paciente) REFERENCES Pacientes(id_paciente)
);

-- Tabla: Testimonios
CREATE TABLE Testimonios (
    id_testimonio INT PRIMARY KEY AUTO_INCREMENT,
    id_paciente INT,
    testimonio TEXT,
    FOREIGN KEY (id_paciente) REFERENCES Pacientes(id_paciente)
);
