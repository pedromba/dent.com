<?php 
include "../conexion/conexion.php";
$sql = "SELECT 
    h.id_historial,
    p.nombre AS nombre_paciente,
    p.apellido AS apellido_paciente,
    p.email AS email_paciente,
    s.nombre_servicio,
    s.descripcion AS descripcion_servicio,
    h.fecha,
    h.diagnostico,
    h.tratamiento,
    h.notas
FROM Historial_Medico h
JOIN Pacientes p ON h.id_paciente = p.id_paciente
JOIN Servicio s ON h.id_servicio = s.id_servicio;";
$resultado = mysqli_query($conexion,$sql);

while($fila = mysqli_fetch_array($resultado)){
    $datos[] = $fila;
}


echo json_encode($datos);
?>