<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empleados - Clínica Dental</title>
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
            <h1>Gestión de Empleados</h1>
            <div class="header-actions">
                
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-user-plus"></i> Nuevo Empleado
                </button>
            </div>
        </div>

        <!-- Tabla de pacientes -->
        <div class="tabla-container">
            <table id="tablaPacientes">
                <thead>
                    <tr>
                        <th>foto</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>especialidad</th>
                        <th>Tipo Empleado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaEmpleados">
                    
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
                            <div class="nombre">
                                <input class="form-control" placeholder="Nombre:" type="text" name="nombre">
                            </div>
                            <div class="apellidos">
                                <input class="form-control" placeholder="Apellidos:" type="text" name="apellidos" id="">
                            </div>
                            <div class="especialidad">
                                <input class="form-control" placeholder="Especialidad:" type="text" name="especialidad" id="">
                            </div>
                            <div class="__email">
                                <input class="form-control" placeholder="email:" type="email" name="email" id="">
                            </div>
                            <div class="__contrasenia">
                                <input class="form-control" placeholder="Contraseña:" type="password" name="contrasena" id="">
                            </div>
                            <div class="tipo">
                                <select class="form-control" name="tipoEmpleado" id="">
                                    <option value="">Tipo de empleado</option>
                                    <?php
                                    include "./conexion/conexion.php";
                                    $consulta = "SELECT * FROM tipo_empleado";
                                    $resultado = mysqli_query($conexion, $consulta);
                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                    ?>
                                        <option value="<?php echo $fila['id_tipo'] ?>"><?php echo $fila['tipo'] ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                            <div class="foto">
                                <input class="form-control" type="file" name="foto" id="">
                            </div>

                            <input class="btn btn-primary" type="submit" value="GUARDAR">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <script src="./recursos/bootstrap.bundle.min.js"></script>
    <script src="./js/Empleados.js"></script>
</body>

</html>