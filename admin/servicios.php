<?php
include "./conexion/conexion.php";
session_start();
$id_usuario_conectado = $_SESSION['id_empleado'];
$usuario_conectado = $_SESSION['nombre'];

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Servicios - Clínica Dental</title>
    <link href="./recursos/bootstrap.min.css" rel="stylesheet">
    <link href="./recursos/all.css" rel="stylesheet">
    <link href="./css/main.css" rel="stylesheet">
    <link href="./css/paciente.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/serviciosBackend.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

</head>

<body>
    <!-- Sidebar -->
    <?php include './componentes/Asidebar.php'; ?>

    <main class="contenido">
        <!-- Header con buscador -->
        <div class="header-container">
            <h1>Gestión de Servicios</h1>
            <div class="header-actions">
                <div class="search-box">
                    <form action="" method="post">
                        <input type="text" id="buscarPaciente" placeholder="Buscar paciente...">
                        <i class="fa-search fas"></i>
                    </form>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-user-plus fas"></i> Nuevo Servicio
                </button>
            </div>
        </div>

        <!-- Reemplazar la tabla por este contenedor de tarjetas -->
        <div class="servicios-container">
            <div id="serviciosGrid" class="row g-4">
                <!-- Las tarjetas se cargarán dinámicamente -->
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
                        <form class="formulario" id="formlulario" action="" method="post" enctype="multipart/form-data">

                            <div class="__nombre_servicio">
                                <input class="form-control" placeholder="Nombre del servicio" type="text" name="servicio" id="">
                            </div>


                            <div class="__descripcion">
                                <textarea class="form-control" placeholder="Descripcion" name="descripcion" id="" cols="10" rows="10"></textarea>
                            </div>

                            <div class="empleado">
                                <select class="form-control" name="empleado" id="">
                                    <option value="<?php echo $id_usuario_conectado ?>"><?php echo $usuario_conectado ?></option>
                                </select>
                            </div>

                            <input class="btn btn-primary" type="submit" value="GUARDAR">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <script src="./recursos/bootstrap.bundle.min.js"></script>
    <script src="./js/servicios.js"></script>
    <!-- Agregar al final del body antes de los scripts -->
    <div class="modal fade" id="modalDescripcion" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDescripcionTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalDescripcionBody"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>