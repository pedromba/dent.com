<?php
include "../conexion/conexion.php";

$id = $_GET['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellidos'];
$fecha_nacimiento = $_POST['nacimiento'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];

$consulta = "UPDATE pacientes SET nombre='$nombre', apellido='$apellido', fecha_nacimiento='$fecha_nacimiento', direccion='$direccion', telefono='$telefono', email='$email' WHERE id_paciente = $id";
$resultado = mysqli_query($conexion,$consulta);

