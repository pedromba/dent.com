<?php

include "../admin/conexion/conexion.php";

$email = $_POST['email'];
$password = $_POST['password'];


$sql = mysqli_query($conexion, "SELECT * FROM Pacientes WHERE email = '$email' AND contrasena = '$password'");
$fila = mysqli_fetch_array($sql);

if (mysqli_num_rows($sql) == 1) {

    if($fila['email'] == $email && $fila['contrasena'] == $password) {
        session_start();

        $_SESSION['id_paciente'] = $fila['id_paciente'];
        $_SESSION['nombre'] = $fila['nombre'];
        $_SESSION['apellido'] = $fila['apellido'];
        $_SESSION['fecha_nacimiento'] = $fila['fecha_nacimiento'];
        $_SESSION['telefono'] = $fila['telefono'];
        $_SESSION['direccion'] = $fila['direccion'];
        $_SESSION['email'] = $fila['email'];
        $_SESSION['contrasena'] = $fila['contrasena'];

        
    }

}

?>




