<?php 
include "../conexion/conexion.php";

$sql = "SELECT EMPLEADOS.ID_EMPLEADO,EMPLEADOS.FOTO, EMPLEADOS.NOMBRE, EMPLEADOS.APELLIDO, EMPLEADOS.ESPECIALIDAD, TIPO_EMPLEADO.TIPO
FROM EMPLEADOS
JOIN TIPO_EMPLEADO ON EMPLEADOS.TIPO_EMPLEADO = TIPO_EMPLEADO.ID_TIPO;";
$resultado = mysqli_query($conexion, $sql);

while($empleado = mysqli_fetch_array($resultado)){
    $empleados[] = $empleado;

}

echo json_encode($empleados);

?>