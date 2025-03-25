<?php 

include "../conexion/conexion.php";

$paciente = $_POST['paciente'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$motivo = $_POST['motivo'];
$servicio = $_POST['servicio'];
$estado = $_POST['estado'];


$consulta = "INSERT INTO citas (id_paciente,id_servicio,fecha,hora,motivo,estado)
values ($paciente,$servicio, '$fecha', '$hora', '$motivo',$estado)";
$resultado = mysqli_query($conexion,$consulta);

