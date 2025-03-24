<?php 

include "../conexion/conexion.php";

$consulta = "SELECT s.nombre_servicio, s.descripcion, e.nombre FROM Servicio S 
INNER JOIN Empleados e ON s.id_empleado = e.id_empleado";
$resultado_consulta = mysqli_query($conexion, $consulta);

while($servicio = mysqli_fetch_assoc($resultado_consulta)){
    $servicios [] = $servicio;
}

echo json_encode($servicios);

?>