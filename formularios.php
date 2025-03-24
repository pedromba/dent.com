<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso - Clínica Dental</title>
    <link href="./recursos/bootstrap.min.css" rel="stylesheet">
    <link href="./recursos/all.css" rel="stylesheet">
    <link rel="stylesheet" href="./recursos/sweetalert2.css">
    <link href="./css/formulario.css" rel="stylesheet">
</head>

<body>


    <div class="__alertas" id="__alertas">
        <div class="__alert" id="__alerta"></div>


        <div class="auth-container">

            <div class="back-button-container">
                <a href="index.php" class="btn-back">
                    <i class="fas fa-chevron-left"></i>
                    <span>Volver al inicio</span>
                </a>
            </div>
            <div class="auth-box">
                <div class="auth-header">
                    <img src="./img/logo.png" alt="Logo Clínica" class="auth-logo">
                    <h2>Bienvenido</h2>
                </div>

                <!-- Tabs de navegación -->
                <ul class="nav nav-tabs" id="authTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#login">
                            Iniciar Sesión
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#registro">
                            Registrarse
                        </button>
                    </li>
                </ul>

                <!-- Contenido de los tabs -->
                <div class="tab-content" id="authTabsContent">
                    <!-- Tab de Login -->
                    <div class="active fade show tab-pane" id="login">
                        <form id="loginForm" action="./php/login.php" method="POST">
                            <div class="form-group">
                                <label for="loginEmail">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa-envelope fas"></i>
                                    </span>
                                    <input type="email" class="form-control" id="loginEmail" name="email">

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="loginPassword">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa-lock fas"></i>
                                    </span>
                                    <input type="password" class="form-control" id="loginPassword" name="password">
                                </div>
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="recordar">
                                <label class="form-check-label" for="recordar">Recordarme</label>
                            </div>

                            <input class="form-control btn btn-primary" type="submit" value="INICIAR SESSION">
                        </form>

                    </div>


                    <!-- Tab de Registro -->
                    <div class="fade tab-pane" id="registro">
                        <form id="registroForm" action="" method="POST">

                            <div class="__nombre">
                                <div class="form-group">
                                    <label for="regNombre">Nombre:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa-user fas"></i>
                                        </span>
                                        <input type="text" class="form-control" id="regNombre" name="nombre" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="regNombre">Apellidos:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa-user fas"></i>
                                        </span>
                                        <input type="text" class="form-control" id="regNombre" name="apellidos" required>
                                    </div>
                                </div>

                            </div>

                            <div class="__segundo_grupo">
                                <div class="form-group">
                                    <label for="regNombre">Fecha Nacimiento:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa-calendar-check fa-regular"></i>
                                        </span>
                                        <input class="form-control" type="date" name="fecha" id="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="regNombre">Direccion:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa-location-arrow fa-solid"></i>
                                        </span>
                                        <input class="form-control" type="text" name="direccion" id="">
                                    </div>
                                </div>

                            </div>

                            <div class="__tercer_grupo">
                                <div class="form-group">
                                    <label for="regTelefono">Teléfono:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa-phone fas"></i>
                                        </span>
                                        <input type="text" class="form-control" id="regTelefono" name="telefono" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="regEmail">Email:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa-envelope fas"></i>
                                        </span>
                                        <input type="email" class="form-control" id="regEmail" name="email" required>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="regPassword">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa-lock fas"></i>
                                    </span>
                                    <input type="password" class="form-control" id="regPassword" name="contrasena" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./recursos/sweetalert2.all.js"></script>
    <script src="./recursos/bootstrap.bundle.min.js"></script>
    <script src="./js/formularios.js"></script>

</body>

</html>