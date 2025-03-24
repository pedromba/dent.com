-- Active: 1742479573761@@127.0.0.1@3306@clinica

drop database clinica;
CREATE database clinica;
use clinica;


-- hecho
CREATE TABLE Pacientes (
    id_paciente INT PRIMARY KEY AUTO_INCREMENT,
    nombre  VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) DEFAULT 2,
    fecha_nacimiento DATE,
    direccion VARCHAR(255),
    telefono VARCHAR(20),
    email VARCHAR(255)NOT NULL, -- Asegura que el email sea único
    contrasena VARCHAR(255) -- Para permitir que los pacientes inicien sesión
);



SELECT 
    c.fecha,
    c.hora,
    s.nombre_servicio,
    e.denominacion as estado_cita
FROM Citas c
JOIN Servicio s ON c.id_servicio = s.id_servicio
JOIN Estado e ON c.estado = e.id_estado
WHERE c.id_paciente = 2;


select* from pacientes;

CREATE TABLE Historial_Medico (
    id_historial INT PRIMARY KEY AUTO_INCREMENT,
    id_paciente INT,
    id_servicio INT,
    fecha DATE,
    diagnostico TEXT,
    tratamiento TEXT,
    notas TEXT,
    FOREIGN KEY (id_paciente) REFERENCES Pacientes (id_paciente)
);

select * from historial_medico;




-- hecho
CREATE TABLE Servicio (
    id_servicio INT PRIMARY KEY AUTO_INCREMENT,
    nombre_servicio VARCHAR(255) NOT NULL,
    descripcion TEXT,
    id_empleado INT,
    FOREIGN KEY (id_empleado) REFERENCES Empleados (id_empleado)
);



-- hecho
CREATE TABLE Empleados (
    id_empleado INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    especialidad VARCHAR(255),
    tipo_empleado int,
    foto varchar(255),
    email VARCHAR(255) UNIQUE NOT NULL, -- Asegura que el email sea único
    contrasena VARCHAR(255), -- Para permitir que los pacientes inicien sesión
    FOREIGN KEY (tipo_empleado) REFERENCES tipo_empleado (id_tipo)
);
--usuario sistema
INSERT INTO Empleados (nombre, apellido, especialidad, tipo_empleado, email, contrasena) 
VALUES ('Admin', 'Sistema', 'Administración', 4, 'admin@gmail.com', '123456');


create table tipo_empleado (
    id_tipo int PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(255),
    descripcion TEXT
);
 INSERT INTO
    tipo_empleado (tipo, descripcion)
VALUES (
        'Médico',
        'Encargado de atender a los pacientes y realizar diagnósticos'
    ),
    (
        'Enfermero',
        'Asiste a los médicos y cuida a los pacientes'
    ),
    (
        'Recepcionista',
        'Gestiona las citas y la atención al cliente'
    ),
    (
        'Administrador',
        'Encargado de la administración y gestión del sistema'
    );



-- hecho
CREATE TABLE Citas (
    id_cita INT PRIMARY KEY AUTO_INCREMENT,
    id_paciente INT NOT NULL,
    id_empleado INT DEFAULT 1,
    id_servicio INT,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    motivo TEXT,
    estado INT DEFAULT 1,
    FOREIGN KEY(id_servicio) REFERENCES Servicio(id_servicio), -- Estado "Pendiente" por defecto (id_estado = 1)
    FOREIGN KEY (id_paciente) REFERENCES Pacientes (id_paciente),
    FOREIGN KEY (id_empleado) REFERENCES Empleados (id_empleado),
    FOREIGN KEY (estado) REFERENCES Estado (id_estado)
);


 -- Ordenado por fecha y hora más reciente



create table estado (
    id_estado int PRIMARY KEY AUTO_INCREMENT,
    denominacion VARCHAR(255)
);
INSERT INTO
    estado (denominacion)
VALUES ('Pendiente'),
    ('Confirmada'),
    ('Cancelada');
    


   

CREATE TABLE Testimonios (
    id_testimonio INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    testimonio TEXT NOT NULL
);








