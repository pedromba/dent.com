<?php 
include "../admin/conexion/conexion.php";


$sql = "SELECT 
    c.fecha,
    c.hora,
    s.nombre_servicio,
    p.nombre AS nombre_paciente,
    e.denominacion AS estado_cita
FROM Citas c
JOIN Pacientes p ON c.id_paciente = p.id_paciente
JOIN Servicio s ON c.id_empleado = s.id_empleado
JOIN Estado e ON c.estado = e.id_estado
WHERE p.id_paciente = 4 -- Aquí se reemplazará el ? con el ID del paciente
ORDER BY c.fecha DESC, c.hora DESC;"

?>