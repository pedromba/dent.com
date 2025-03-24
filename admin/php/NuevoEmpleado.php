<?php 

include "../conexion/conexion.php";

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$especialidad = $_POST['especialidad'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];

// varialbles de la foto

$tipo = $_POST['tipoEmpleado'];
$destino = "../img/empleados/";
$nombreArchi = $_FILES['foto']['name'];
$dirTemporal = $_FILES['foto']['tmp_name'];



$arrayNombreArchi = explode('.', $nombreArchi);
$extesionArchivo = strtolower(end($arrayNombreArchi));
$arrayExtenAdmitidas = array('jpg', 'png', 'jpeg', 'gif');
if (in_array($extesionArchivo, $arrayExtenAdmitidas)) {
    //echo "Se admite este tipo de archivo";
    if (move_uploaded_file($dirTemporal, $destino . $nombreArchi)) {
        // echo "Archivo subido exitosamente";

       $consulta = "INSERT INTO Empleados VALUES (null, '$nombre', '$apellidos','$especialidad', '$tipo', '$nombreArchi','$email', '$contrasena')";
       $resultado = mysqli_query($conexion,$consulta);

    }
}

?>