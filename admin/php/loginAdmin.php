<?php 
include "../conexion/conexion.php";

$email = $_POST['email'];
$password = $_POST['password'];

$consulta = "SELECT * FROM Empleados
WHERE email = '$email' AND contrasena = '$password'";
$resultado = mysqli_query($conexion, $consulta);
$fila = mysqli_fetch_array($resultado);

if($fila['email'] == $email && $fila['contrasena'] == $password){
    session_start();

    $_SESSION['email'] = $fila['email'];
    $_SESSION['nombre'] = $fila['nombre'];
    $_SESSION['apellido'] = $fila['apellido'];
    $_SESSION['tipo_empleado'] = $fila['tipo_empleado'];
    $_SESSION['id_empleado'] = $fila['id_empleado'];
    $_SESSION['especialidad'] = $fila['especialidad'];
    $_SESSION['foto'] = $fila['foto'];


    header("Location:../dashboard.php");
}else{
    header("Location:../index.php");
}


