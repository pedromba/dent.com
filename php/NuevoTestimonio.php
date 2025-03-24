<?php 
include "../admin/conexion/conexion.php";

$nombre = $_POST['nombre'];
$correo = $_POST['email'];
$mensaje = $_POST['mensaje'];

$sql = "INSERT INTO Testimonios VALUES (NULL, '$nombre', '$correo', '$mensaje')";
$respuesta = mysqli_query($conexion, $sql);
?>