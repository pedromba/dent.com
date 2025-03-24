<?php
include "./conexion/conexion.php";

$consulta  = "SELECT * FROM Pacientes";
$resultado = mysqli_query($conexion, $consulta);
$paciente = mysqli_fetch_array($resultado);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Pacientes - Clínica Dental</title>
    <link rel="stylesheet" href="./recursos/sweetalert2.css">
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
            <h1>Gestión de Pacientes</h1>
            <div class="header-actions">
                <div class="search-box">
                    <form action="" method="post">
                        <input class="form-control" type="text" id="buscarPaciente" placeholder="Buscar paciente...">
                        <i class="fas fa-search"></i>
                    </form>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-user-plus"></i> Nuevo Paciente
                </button>
            </div>
        </div>

        <!-- Tabla de pacientes -->
        <div class="tabla-container">
            <table id="tablaPacientes">
                <thead>
                    <tr>
                        <style>
                            .tabla-container {
                                width: 100%;
                                max-height: 400px;
                                overflow-y: auto;
                            }

                            #tablaPacientes thead th {
                                position: sticky;
                                top: 0;
                                background-color: #f8f9fa;
                                z-index: 1;
                            }
                        </style>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaPacientesBody">
                    <!-- codigo  -->
                </tbody>
            </table>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="formulario" action="" method="post" id="form_pacientes" enctype="multipart/form-data">
                            <div class="__nombre">
                                <input class="form-control" placeholder="Nombre:" type="text" name="nombre" id="__nombre">
                            </div>
                            <div class="__apellidos">
                                <input class="form-control" placeholder="Apellidos" type="text" name="apellidos" id="">
                            </div>
                            <div class="__fecha_nacimiento">
                                <input class="form-control" placeholder="Fecha de Nacimiento:" type="date" name="nacimiento" id="">
                            </div>
                            <div class="__direccion">
                                <input class="form-control" placeholder="Direccion:" type="text" name="direccion" id="">
                            </div>

                            <div class="__telefono">
                                <input class="form-control" placeholder="Telefono:" type="text" name="telefono" id="">
                            </div>

                            <div class="__email">
                                <input class="form-control" placeholder="Email:" type="email" name="email" id="">
                            </div>
                            <div class="__contrasena">
                                <input class="form-control" placeholder="Contraseña:" type="password" name="contrasena" id="">
                            </div>

                            <input class="form-control btn btn-outline-primary" type="submit" value="GUARDAR">
                        </form>
                    </div>

                </div>
            </div>
        </div>

     
       


        <!-- Modal -->
        <div class="modal fade" id="ModalActualizacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="formulario" action="" method="post" id="FormPacientes" enctype="multipart/form-data">
                            <div class="__id">
                                <input class="form-control" type="text" name="id" id="__id" disabled>
                            </div>
                            <div class="__nombre">
                                <input class="form-control" placeholder="Nombre:" type="text" name="nombre" id="nombre">
                            </div>
                            <div class="__apellidos">
                                <input class="form-control" placeholder="Apellidos" type="text" name="apellidos" id="apellido">
                            </div>
                            <div class="__fecha_nacimiento">
                                <input class="form-control" placeholder="Fecha de Nacimiento:" type="date" name="nacimiento" id="fecha_nacimiento">
                            </div>
                            <div class="__direccion">
                                <input class="form-control" placeholder="Direccion:" type="text" name="direccion" id="direccion">
                            </div>

                            <div class="__telefono">
                                <input class="form-control" placeholder="Telefono:" type="text" name="telefono" id="telefono">
                            </div>

                            <div class="__email">
                                <input class="form-control" placeholder="Email:" type="email" name="email" id="email">
                            </div>


                            <input class="form-control btn btn-primary" type="submit" value="GUARDAR">
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>

    </main>

    <script src="./recursos/bootstrap.bundle.min.js"></script>
    <script src="./js/paciente.js"></script>
    <script src="./recursos/sweetalert2.all.js"></script>
</body>

</html>