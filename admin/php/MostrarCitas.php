<?php 
include "../conexion/conexion.php";

$consulta = "SELECT 
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
JOIN 
    Pacientes ON Citas.id_paciente = Pacientes.id_paciente
JOIN 
    Empleados ON Citas.id_empleado = Empleados.id_empleado
LEFT JOIN 
    Servicio ON Citas.id_servicio = Servicio.id_servicio
JOIN 
    Estado ON Citas.estado = Estado.id_estado
ORDER BY 
    Citas.fecha DESC";

    $resultado = mysqli_query($conexion,$consulta);
    while($cita = mysqli_fetch_array($resultado)) {
        $citas [] = $cita;
    }

    echo json_encode($citas);