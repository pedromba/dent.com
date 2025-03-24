<?php 
include "../conexion/conexion.php";

$sql = "SELECT * FROM pacientes";
$resultado = mysqli_query($conexion, $sql);

while($paciente = mysqli_fetch_array($resultado)){
    $pacientes[] = $paciente;

}

echo json_encode($pacientes);

?>