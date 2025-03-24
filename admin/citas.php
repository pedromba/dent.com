<?php
include "./conexion/conexion.php";

session_start();

$foto =  $_SESSION['foto'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
$id_empleado = $_SESSION['id_empleado'];

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Citas - Clínica Dental</title>
    <link href="./recursos/bootstrap.min.css" rel="stylesheet">
    <link href="./recursos/all.css" rel="stylesheet">
    <link href="./css/main.css" rel="stylesheet">
    <link href="./css/paciente.css" rel="stylesheet">
</head>

<body>
    <!-- Sidebar -->
    <?php include './componentes/Asidebar.php'; ?>

    <main class="contenido">
        <!-- Header con buscador -->
        <div class="header-container">
            <h1>Gestión de Citas</h1>
            <div class="header-actions">
                <div class="search-box">
                    <form action="" method="post">
                        <input type="text" id="buscarPaciente" placeholder="Buscar paciente...">
                        <i class="fa-search fas"></i>
                    </form>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-user-plus fas"></i> Nuevo Paciente
                </button>
            </div>
        </div>

        <!-- Tabla de pacientes -->
        <div class="tabla-container">
            <table id="tablaPacientes">
                <thead style="position: sticky; top: 0; background-color: #fff; z-index: 1;">
                    <tr>

                        <th>paciente</th>
                        <th>fecha</th>
                        <th>hora</th>
                        <th>Servicio</th>
                        <th>motivo</th>
                        <th>estado</th>
                        <th colspan="2" class=".__acciones">Acciones</th>
                    </tr>
                </thead>
                <style>
                    .tabla-container {
                        max-height: 400px;
                        overflow-y: auto;
                    }
                </style>
                <tbody id="tablaCitas">
                    <!-- Los datos se cargarán dinámicamente -->
                </tbody>
            </table>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="formulario" id="formlulario" action="" method="post" enctype="multipart/form-data">

                            <div class="paciente">
                                <select class="form-control" name="paciente" id="">
                                    <option value="">Paciente:</option>
                                    <?php
                                    $consulta = "SELECT * FROM pacientes";
                                    $resultado = mysqli_query($conexion, $consulta);
                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                    ?>
                                        <option value="<?php echo $fila['id_paciente'] ?>"><?php echo $fila['nombre'] . " " . $fila['apellido'] ?></option>

                                    <?php } ?>
                                </select>
                            </div>

                            <div class="empleado">
                                <select class="form-control" name="empleado" id="" disabled>

                                    <option value="<?php echo $id_empleado ?>"><?php echo $nombre . " " . $apellido ?></option>

                                </select>
                            </div>
                            <div class="fecha">
                                <input class="form-control" type="date" name="fecha" id="">
                            </div>
                            <div class="hora">
                                <input class="form-control" type="time" name="hora" id="">
                            </div>
                            <div class="servicio">
                                <select class="form-control" name="servicio" id="">
                                    <option selected>Secciona un servicio:</option>
                                    <?php
                                    $sql = "SELECT* FROM Servicio";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($fila = mysqli_fetch_array($result)) {

                                    ?>
                                        <option value="<?php echo $fila['id_servicio'] ?>"><?php echo $fila['nombre_servicio'] ?></option>

                                    <?php  } ?>
                                </select>
                            </div>

                            <div class="motivo">
                                <textarea class="form-control" name="motivo" id="" cols="30" rows="10"></textarea>
                            </div>

                            <div class="empleado">
                                <select class="form-control" name="estado" id="">
                                    <option value="">Estado:</option>
                                    <?php

                                    $estado = "SELECT * FROM estado";
                                    $resultado = mysqli_query($conexion, $estado);
                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                    ?>
                                        <option value="<?php echo $fila['id_estado'] ?>"><?php echo $fila['denominacion'] ?></option>

                                    <?php } ?>
                                </select>
                            </div>

                            <input class="btn btn-primary" type="submit" value="GUARDAR">
                        </form>
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> -->
                </div>
            </div>
        </div>



        <!-- modal de actualizacion -->

        <div class="modal fade" id="modalActualizacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="formulario" id="formAct" action="" method="post" enctype="multipart/form-data">
                            <div class="__id_cita">
                                <input class="form-control" type="text" name="id" id="__id_cita" disabled>
                            </div>
                            <div class="paciente">
                                <select class="form-control" name="paciente" id="pacienteAc">
                                    <option value="">Paciente:</option>
                                    <?php
                                    $consulta = "SELECT * FROM pacientes";
                                    $resultado = mysqli_query($conexion, $consulta);
                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                    ?>
                                        <option value="<?php echo $fila['id_paciente'] ?>"><?php echo $fila['nombre'] . " " . $fila['apellido'] ?></option>

                                    <?php } ?>
                                </select>
                            </div>

                            <div class="empleado">
                                <select class="form-control" name="empleado" id="EmpleadoAc">
                                    <option value="">Empleado:</option>
                                    <?php

                                    $empleados = "SELECT * FROM Empleados";
                                    $resultado = mysqli_query($conexion, $empleados);
                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                    ?>
                                        <option value="<?php echo $fila['id_empleado'] ?>"><?php echo $fila['nombre'] . " " . $fila['apellido'] ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                            <div class="fecha">
                                <input class="form-control" type="date" name="fecha" id="FechaAc">
                            </div>
                            <div class="hora">
                                <input class="form-control" type="time" name="hora" id="HoraAc">
                            </div>

                            <div class="motivo">
                                <textarea class="form-control" name="motivo" id="MotivoAct" cols="10" rows="2"></textarea>
                            </div>

                            <div class="empleado">
                                <select class="form-control" name="estado" id="EstadoAc">
                                    <option value="">Estado:</option>
                                    <?php

                                    $estado = "SELECT * FROM estado";
                                    $resultado = mysqli_query($conexion, $estado);
                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                    ?>
                                        <option value="<?php echo $fila['id_estado'] ?>"><?php echo $fila['denominacion'] ?></option>

                                    <?php } ?>
                                </select>
                            </div>

                            <input class="btn btn-primary" type="submit" value="GUARDAR">
                        </form>
                    </div>
                    <!-- <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <button type="button" class="btn btn-primary">Save changes</button>
               </div> -->
                </div>
            </div>
        </div>
    </main>

    <script src="./recursos/bootstrap.bundle.min.js"></script>
    <script src="./js/citas.js"></script>

</body>

</html>