<?php 
include "../conexion/conexion.php";

$id = $_GET['id'];
$estado = $_POST['estado_cita'];


$consulta = "UPDATE Citas
SET estado = (SELECT id_estado FROM Estado WHERE denominacion = '$estado')
WHERE id_cita = $id";

$resultado = mysqli_query($conexion,$consulta);


?>

