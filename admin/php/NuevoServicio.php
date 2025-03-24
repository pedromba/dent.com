<?php 
include "../conexion/conexion.php";

// variables.
$nombre = $_POST['servicio'];
$descripcion = $_POST['descripcion'];
$empleado = $_POST['empleado'];

$sql = "INSERT INTO Servicio VALUES (NULL, '$nombre', '$descripcion', $empleado)";
$result_sql = mysqli_query($conexion, $sql);

?>