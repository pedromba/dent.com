<?php

session_start();

$foto =  $_SESSION['foto'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Clínica Dental</title>
    <link href="./recursos/bootstrap.min.css" rel="stylesheet">
    <link href="./recursos/all.css" rel="stylesheet">
    <link href="./css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="./recursos/sweetalert2.css">
</head>

<body>

    <style>
        .tabla-responsive {
            height: 300px;
            overflow-y: auto;
        }

        .tabla-citas thead {
            position: sticky;
            top: 0;
            background: white;
            z-index: 1;
        }
    </style>
    <!-- Sidebar-->
    <?php include "./componentes/Asidebar.php" ?>

    <!-- Contenido principal -->
    <main class="contenido">

        <!-- Offcanvas Sidebar para móvil -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="menuOffcanvas">
            <div class="offcanvas-header">
                <div class="logo-container">
                    <img src="../img/logo.png" alt="Logo Clínica" class="logo">
                    <h2>ClínicaDental</h2>
                </div>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <nav class="menu-mobile">
                    <ul>
                        <li class="active">
                            <a href="dashboard.php">
                                <i class="fa-home fas"></i>
                                <span>Inicio</span>
                            </a>
                        </li>
                        <li>
                            <a href="pacientes.php">
                                <i class="fa-users fas"></i>
                                <span>Pacientes</span>
                            </a>
                        </li>
                        <li>
                            <a href="citas.php">
                                <i class="fa-calendar-check fas"></i>
                                <span>Citas</span>
                            </a>
                        </li>
                        <li>
                            <a href="tratamientos.php">
                                <i class="fa-tooth fas"></i>
                                <span>Tratamientos</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Header  -->
        <header class="header">
            <button class="menu-toggle" data-bs-toggle="offcanvas" data-bs-target="#menuOffcanvas">
                <i class="fa-bars fas"></i>
            </button>
            <div class="usuario">
                <span><?php echo $nombre . " " . $apellido ?></span>
                <img src="./img/empleados/<?php echo $foto ?>" alt="Usuario">
            </div>
            <a href="./php/session_des.php" class="__cerrar"><i class="fa-arrow-right-from-bracket fa-solid"></i></a>
        </header>

        <br>

        <!-- Cards de información -->
        <div class="cards-container">

            <?php
            include "./conexion/conexion.php";
            $count_pacientes = "SELECT *  FROM pacientes";
            $resultado = mysqli_query($conexion, $count_pacientes);
            $numero_pacientes = mysqli_num_rows($resultado);


            $count_citas_hoy = "SELECT * FROM CITAS WHERE CITAS.fecha = CURDATE() AND CITAS.estado = (SELECT id_estado FROM Estado WHERE denominacion = 'Confirmada')";
            $resultado = mysqli_query($conexion, $count_citas_hoy);
            $numero_citas = mysqli_num_rows($resultado);

            $consultas_pendientes = "SELECT 
    Citas.*,
    Servicio.nombre_servicio,
    Estado.denominacion AS estado_cita
    FROM 
    Citas
    JOIN Servicio ON Citas.id_empleado = Servicio.id_empleado
    JOIN Estado ON Citas.estado = Estado.id_estado
    WHERE 
    Estado.denominacion = 'Pendiente' AND Citas.fecha = CURDATE()";
            $resultado = mysqli_query($conexion, $consultas_pendientes);
            $numero_pendientes = mysqli_num_rows($resultado);

            $sql_trat = "SELECT * FROM historial_medico";
            $result = mysqli_query($conexion, $sql_trat);
            $numero_trat = mysqli_num_rows($result);
            ?>
            <div class="card-info bg-azul">
                <i class="fa-user-friends fas"></i>
                <div>
                    <h3>Pacientes</h3>
                    <p><?php echo $numero_pacientes ?></p>
                </div>
            </div>
            <div class="card-info bg-verde">
                <i class="fa-calendar-check fas"></i>
                <div>
                    <h3>Citas Hoy</h3>
                    <p><?php echo $numero_citas ?></p>
                </div>
            </div>
            <div class="card-info bg-naranja">
                <i class="fa-clock fas"></i>
                <div>
                    <h3>Pendientes</h3>
                    <p><?php echo $numero_pendientes ?></p>
                </div>
            </div>
            <div class="card-info bg-morado">
                <i class="fa-tooth fas"></i>
                <div>
                    <h3>Tratamientos</h3>
                    <p><?php echo $numero_trat ?></p>
                </div>
            </div>
        </div>

        <!-- Citas del día -->
        <section class="citas-hoy">
            <h2>Citas de Hoy</h2>
            <div class="tabla-responsive">
                <table class="tabla-citas">
                    <thead>

                        <tr>
                            <th>Hora</th>
                            <th>Paciente</th>
                            <th>Tratamiento</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        $sql = "SELECT c.hora, p.nombre, s.nombre_servicio, e.denominacion
                            FROM Citas c
                            JOIN Pacientes p ON c.id_paciente = p.id_paciente
                            JOIN Servicio s ON c.id_servicio = s.id_servicio 
                            JOIN Estado e ON c.estado = e.id_estado
                            WHERE c.fecha = CURDATE() 
                            AND e.denominacion = 'Confirmada'
                            ORDER BY c.hora ASC";

                        $resultado = mysqli_query($conexion, $sql);
                        while ($fila = mysqli_fetch_array($resultado)) {


                        ?>
                            <tr>
                                <td><?php echo $fila['hora'] ?></td>
                                <td><?php echo $fila['nombre'] ?></td>
                                <td><?php echo $fila['nombre_servicio'] ?></td>
                                <td><?php echo $fila['denominacion'] ?></td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script src="./recursos/bootstrap.bundle.min.js"></script>
    <script src="./recursos/sweetalert2.all.js"></script>
    <script src="./js/main.js"></script>
</body>

</html>