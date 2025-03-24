<?php 
include "../conexion/conexion.php";

  $sql = "SELECT * FROM Testimonios";
  $resultado = mysqli_query($conexion, $sql);

  while($fila = mysqli_fetch_array($resultado)){
    $datos[] = $fila;
  }

  echo json_encode($datos);

?>