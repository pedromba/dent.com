<?php 
include "../admin/conexion/conexion.php";

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$FechaNacimiento = $_POST['fecha'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];


      $sql = "INSERT INTO pacientes
      VALUES (null,'$nombre','$apellidos','$FechaNacimiento','$direccion','$telefono','$email','$contrasena')";
      $resultado = mysqli_query($conexion, $sql);

      header("Location:../formularios.php");
?>