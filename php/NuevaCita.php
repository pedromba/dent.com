<?php

include "../admin/conexion/conexion.php";


$paciente = $_POST['paciente'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$motivo = $_POST['motivo'];
$servicio = $_POST['servicio'];


$sql = "INSERT into citas(id_paciente,id_servicio,fecha,hora,motivo)
VALUES ($paciente,$servicio,'$fecha','$hora','$motivo')";

$resultado = mysqli_query($conexion,$sql);

header("Location:../paciente.php");
