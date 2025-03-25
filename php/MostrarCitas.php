<?php 
include "../admin/conexion/conexion.php";


$consulta = "SELECT 
    c.fecha,
    c.hora,
    s.nombre_servicio,
    e.denominacion as estado_cita
FROM Citas c
JOIN Servicio s ON c.id_servicio = s.id_servicio
JOIN Estado e ON c.estado = e.id_estado
WHERE c.id_paciente = $id_pacientePaciente";

$resultado = mysqli_query($conexion, $consulta);
while ($fila = mysqli_fetch_array($resultado)) {
    
}