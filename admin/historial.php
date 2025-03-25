<?php
include "./conexion/conexion.php";

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tratamientos - Clínica Dental</title>
    <link href="./recursos/bootstrap.min.css" rel="stylesheet">
    <link href="./recursos/all.css" rel="stylesheet">
    <link href="./css/main.css" rel="stylesheet">
    <link href="./css/paciente.css" rel="stylesheet">
    <link rel="stylesheet" href="./recursos/sweetalert2.css">
</head>

<body>
    <!-- Sidebar -->
    <?php include './componentes/Asidebar.php'; ?>

    <main class="contenido">
        <!-- Header con buscador -->
        <div class="header-container">
            <h1>Gestión de Tratamientos</h1>
            <div class="header-actions">
                
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-user-plus fas"></i> Nuevo Historial
                </button>
            </div>
        </div>

        <!-- Tabla de pacientes -->
        <div class="tabla-container">
            <table id="tablaPacientes">
                <thead style="position: sticky; top: 0; background-color: #fff; z-index: 1;">
                    <tr>
                       
                        <th>Nombre paciente</th>
                        <th>fecha</th>
                        <th>Servicio</th>
                        <th>Tratamiento</th>
                        <th>Notas</th>
                        <th colspan="2" class=".__acciones">Acciones</th>
                    </tr>
                </thead>
                <style>
                    .tabla-container {
                        max-height: 400px;
                        overflow-y: auto;
                    }
                </style>
                <tbody id="historial">
                    <!-- Los datos se cargarán dinámicamente -->
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
                    <form id="formHistorial" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">

                                <label class="form-label">Paciente</label>
                                <select class="form-select" name="id_paciente" required>
                                    <option value="">Seleccione un paciente</option>
                                    <?php
                                    $query = "SELECT id_paciente, nombre, apellido FROM Pacientes";
                                    $resultado = mysqli_query($conexion, $query);
                                    while($fila = mysqli_fetch_assoc($resultado)) {
                                        echo "<option value='{$fila['id_paciente']}'>{$fila['nombre']} {$fila['apellido']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Servicio</label>
                                <select class="form-select" name="id_servicio" required>
                                    <option value="">Seleccione un servicio</option>
                                    <?php
                                    $query = "SELECT id_servicio, nombre_servicio FROM Servicio";
                                    $resultado = mysqli_query($conexion, $query);
                                    while($fila = mysqli_fetch_assoc($resultado)) {
                                        echo "<option value='{$fila['id_servicio']}'>{$fila['nombre_servicio']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fecha</label>
                            <input type="date" class="form-control" name="fecha" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Diagnóstico</label>
                            <textarea class="form-control" name="diagnostico" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tratamiento</label>
                            <textarea class="form-control" name="tratamiento" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Notas Adicionales</label>
                            <textarea class="form-control" name="notas" rows="3"></textarea>
                        </div>

                        <button type="submit" class="form-control btn btn-primary">
                            Guardar
                        </button>
                    </form>
                    </div>
                   
                </div>
            </div>
        </div>


       
    </main>

    <script src="./recursos/bootstrap.bundle.min.js"></script>
    <script src="./js/historial.js"></script>
    <script src="./recursos/sweetalert2.all.js"></script>

</body>

</html>