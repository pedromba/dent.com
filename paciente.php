<?php
include "./admin/conexion/conexion.php";
session_start();

$nombrePaciente = $_SESSION['nombre'];
$id_pacientePaciente = $_SESSION['id_paciente'];



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Paciente - Clínica Dental</title>
    <link href="./recursos/bootstrap.min.css" rel="stylesheet">
    <link href="./recursos/all.css" rel="stylesheet">
    <link href="./css/paciente.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <style>
        tbody {
            display: block;
            max-height: 300px;
            overflow-y: auto;
        }

        thead,
        tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }
    </style>


    <nav class="navbar navbar-dark navbar-expand-lg bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="./img/logo.png" alt="Logo" class="nav-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link">
                            <?php echo $nombrePaciente ?>

                        </span>
                    </li>
                    <li class="nav-item">
                        <a href="./php/DestSes.php" class="nav-link">
                            <i class="fa-sign-out-alt fas"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="container mt-4">
        <h2 class="text-center mb-4">Panel de Paciente</h2>

        <!-- Botón Nueva Cita -->
        <div class="text-center mb-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-plus fas"></i> Solicitar Nueva Cita
            </button>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="h5 mb-0">Mis Citas</h3>
            </div>
            <div class="card-body p-0 p-md-3">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <!-- ... resto del código ... -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Servicio</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>

                            <tbody id="tablaCitas">
                                <?php
                                $consulta = "SELECT 
    c.fecha,
    c.hora,
    s.nombre_servicio,
    e.denominacion as estado_cita
FROM Citas c
JOIN Servicio s ON c.id_servicio = s.id_servicio
JOIN Estado e ON c.estado = e.id_estado
WHERE c.id_paciente = $id_pacientePaciente
ORDER BY c.fecha DESC, c.hora DESC limit 4";

                                $resultado = mysqli_query($conexion, $consulta);
                                while ($fila = mysqli_fetch_array($resultado)) {

                                ?>
                                   <tr>
    <td data-label="Fecha"><?php echo $fila['fecha'] ?></td>
    <td data-label="Hora"><?php echo $fila['hora'] ?></td>
    <td data-label="Servicio"><?php echo $fila['nombre_servicio'] ?></td>
    <td data-label="Estado"><?php echo $fila['estado_cita'] ?></td>
    <br>
</tr>
                                <?php } ?>



                            </tbody>
                        </table>
                </div>
            </div>
        </div>
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
                    <form class="formulario_paciente" id="formlulario" action="./php/NuevaCita.php" method="post" enctype="multipart/form-data">

                        <div class="paciente">
                            <select class="form-control" name="paciente" id="">
                                <option value="<?php echo $id_pacientePaciente ?>"><?php echo $nombrePaciente ?></option>
                            </select>
                        </div>

                        <div class="fecha">
                            <input class="form-control" type="date" name="fecha" id="">
                        </div>

                        <div class="hora">
                            <input class="form-control" type="time" name="hora" id="">
                        </div>


                        <div class="motivo">
                            <textarea class="form-control" name="motivo" id="" cols="15" rows="5"></textarea>
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

                        <input class="btn btn-primary" type="submit" value="GUARDAR">
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php include "./componentes/footer.php" ?>
    <script src="./js/MostrarCitas.js"></script>
    <script src="./recursos/bootstrap.bundle.min.js"></script>

</body>

</html>