


    SELECT* FROM PACIENTES;

SELECT 
    Citas.id_cita,
    Pacientes.nombre AS nombre_paciente,
    Pacientes.apellido AS apellido_paciente,
    Pacientes.email AS email_paciente,
    Empleados.nombre AS nombre_empleado,
    Empleados.apellido AS apellido_empleado,
    Empleados.especialidad AS especialidad_empleado,
    Citas.fecha,
    Citas.hora,
    Citas.motivo,
    Estado.denominacion AS estado_cita
FROM 
    Citas
JOIN 
    Pacientes ON Citas.id_paciente = Pacientes.id_paciente
JOIN 
    Empleados ON Citas.id_empleado = Empleados.id_empleado
JOIN 
    Estado ON Citas.estado = Estado.id_estado;


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

    SELECT 
    c.fecha,
    c.hora,
    s.nombre_servicio,
    p.nombre AS nombre_paciente,
    e.denominacion AS estado_cita
FROM Citas c
JOIN Pacientes p ON c.id_paciente = p.id_paciente
JOIN Servicio s ON c.id_empleado = s.id_empleado
JOIN Estado e ON c.estado = e.id_estado
WHERE p.id_paciente = 1 -- Aquí se reemplazará el ? con el ID del paciente
ORDER BY c.fecha DESC, c.hora DESC;


INSERT INTO
    estado (denominacion)
VALUES ('Pendiente'),
    ('Confirmada'),
    ('Cancelada'),
    ('Completada');


    SELECT 
    Citas.id_cita,
    Pacientes.nombre AS nombre_paciente,
    Pacientes.apellido AS apellido_paciente,
    Pacientes.email AS email_paciente,
    Empleados.nombre AS nombre_empleado,
    Empleados.apellido AS apellido_empleado,
    Empleados.especialidad AS especialidad_empleado,
    Servicio.nombre_servicio,
    Citas.fecha,
    Citas.hora,
    Citas.motivo,
    Estado.denominacion AS estado_cita
FROM 
    Citas
-- =========================================================================
-- Operación JOIN en SQL
-- =========================================================================
-- Descripción: Combina filas de dos o más tablas basándose en una condición 
-- relacionada entre ellas (columnas en común)
-- 
-- Tipos de JOIN:
-- INNER JOIN - Retorna registros cuando hay coincidencias en ambas tablas
-- LEFT JOIN  - Retorna todos los registros de la tabla izquierda y los que coincidan de la derecha
-- RIGHT JOIN - Retorna todos los registros de la tabla derecha y los que coincidan de la izquierda
-- FULL JOIN  - Retorna todos los registros cuando hay una coincidencia en cualquiera de las tablas
-- =========================================================================
JOIN 
    Pacientes ON Citas.id_paciente = Pacientes.id_paciente
JOIN 
    Empleados ON Citas.id_empleado = Empleados.id_empleado
LEFT JOIN 
    Servicio ON Citas.id_servicio = Servicio.id_servicio
JOIN 
    Estado ON Citas.estado = Estado.id_estado
ORDER BY 
    Citas.fecha DESC, Citas.hora DESC;

    INSERT INTO Empleados (nombre, apellido, especialidad, tipo_empleado, foto, email, contrasena) 
VALUES 
('Dr. Roberto', 'Sánchez', 'Medicina General', 1, 'roberto.jpg', 'roberto@gmail.com', '0000'),
('Lic. Carmen', 'Rodríguez', 'Enfermería', 2, 'carmen.jpg', 'carmen@gmail.com', '0000'),
('José', 'Gómez', 'Administración', 4, 'jose.jpg', 'jose@gmail.com', '1234');


INSERT INTO Pacientes (nombre, apellido, fecha_nacimiento, direccion, telefono, email, contrasena) 
VALUES 
('Juan', 'Pérez', '1990-05-15', 'Calle 123', '555-0123', 'juan@email.com', '0000'),
('María', 'García', '1985-08-22', 'Avenida 456', '555-0124', 'maria@email.com', '0000'),
('Carlos', 'López', '1978-03-10', 'Plaza 789', '555-0125', 'carlos@email.com', '0000'),
('Ana', 'Martínez', '1995-11-30', 'Boulevard 321', '555-0126', 'ana@email.com', '0000');
