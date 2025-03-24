<?php

include "../conexion/conexion.php";

$paciente = $_POST['id_paciente'];
$servicio = $_POST['id_servicio'];
$fecha = $_POST['fecha'];
$diagnostico = $_POST['diagnostico'];
$tratamiento = $_POST['tratamiento'];
$notas = $_POST['notas'];

$sql = "INSERT INTO Historial_Medico 
VALUES (NULL,$paciente,$servicio,'$fecha','$diagnostico','$tratamiento','$notas')";
$resultado = mysqli_query($conexion,$sql);

?>