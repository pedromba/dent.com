<?php
include "./admin/conexion/conexion.php";

?>
<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link style="border-radius: 50%;" rel="icon" type="image/png" sizes="32x50" href="./img/logo.png">
    <title>Clínica Dental - Tu mejor sonrisa</title>
    <meta name="description" content="Clínica dental especializada en ortodoncia, implantes y estética dental">
    <link href="./recursos/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/BtnFlotante.css">
    <link rel="stylesheet" href="./recursos/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Navbar-->
    <?php include "./componentes/header.php" ?>

    <!-- presentacion Section -->
    <header id="inicio" class="hero-section">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-md-6">
                    <h1 class="animate__animated animate__fadeInUp">Tu Sonrisa, Nuestra Prioridad</h1>
                    <p class="animate__animated animate__fadeInUp animate__delay-1s">
                        Expertos en odontología con más de 15 años de experiencia.
                        Tecnología de vanguardia para tu mejor sonrisa.
                    </p>
                    <div class="hero-buttons animate__animated animate__fadeInUp animate__delay-2s">
                        <a href="./formularios.php" class="btn btn-primary me-3">Agenda tu cita</a>
                        <br>
                        <a href="#servicios" class="btn btn-outline-light">Conoce nuestros servicios</a>
                    </div>
                </div>
                
            </div>
        </div>
    </header>

    <!-- Servicios -->
    <section id="servicios" class="py-5">
        <div class="container">
            <h2 class="section-title">Nuestros Servicios</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <i class="fas fa-tooth"></i>
                        <h3>Limpieza Dental</h3>
                        <p>Mantén tu sonrisa brillante y saludable con nuestros tratamientos profesionales.</p>
                        <a href="servicio.php?id=limpieza-dental" class="btn btn-outline-primary btn-sm mt-3">Más información</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <i class="fas fa-teeth"></i>
                        <h3>Ortodoncia</h3>
                        <p>Alineación dental perfecta con brackets tradicionales o invisibles.</p>
                        <a href="servicio.php?id=ortodoncia" class="btn btn-outline-primary btn-sm mt-3">Más información</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <i class="fas fa-crown"></i>
                        <h3>Implantes Dentales</h3>
                        <p>Recupera tu sonrisa con implantes de última generación.</p>
                        <a href="servicio.php?id=implantes" class="btn btn-outline-primary btn-sm mt-3">Más información</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--estadísticas -->
    <section class="estadisticas py-5 bg-primary text-white">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="estadistica-item">
                        <i class="fas fa-smile-beam fa-3x mb-3"></i>
                        <h3>
                            <span class="contador" data-objetivo="5000" data-sufijo="+">0</span>
                        </h3>
                        <p>Pacientes Felices</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="estadistica-item">
                        <i class="fas fa-award fa-3x mb-3"></i>
                        <h3>
                            <span class="contador" data-objetivo="15" data-sufijo="+">0</span>
                        </h3>
                        <p>Años de Experiencia</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="estadistica-item">
                        <i class="fas fa-user-md fa-3x mb-3"></i>
                        <h3>
                            <span class="contador" data-objetivo="20" data-sufijo="+">0</span>
                        </h3>
                        <p>Especialistas</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="estadistica-item">
                        <i class="fas fa-certificate fa-3x mb-3"></i>
                        <h3>
                            <span class="contador" data-objetivo="50" data-sufijo="+">0</span>
                        </h3>
                        <p>Certificaciones</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Doctores -->
    <section id="doctores" class="py-5">
        <div class="container">
            <h2 class="section-title">Nuestros Especialistas</h2>
            <div class="row">

                <?php
                $sql = "SELECT e.*, t.tipo as tipo_empleado_denominacion
                    FROM Empleados e 
                    INNER JOIN tipo_empleado t ON e.tipo_empleado = t.id_tipo 
                    WHERE t.tipo = 'Médico'
                    ORDER BY e.id_empleado desc
                    LIMIT 3";
                $result = mysqli_query($conexion, $sql);

                while ($fila = mysqli_fetch_array($result)) {

                ?>
                 <div class="col-md-4 mb-4">
                        <div class="testimonio-card">
                            <div class="testimonio-texto">
                                <i class="fas fa-quote-left"></i>
                                <p><?php echo $fila['especialidad']?></p>
                            </div>
                            <div class="testimonio-autor">
                                <img src="./admin/img/empleados/<?php echo $fila['foto']?>" alt="Paciente">
                                <div>
                                    <h4><?php echo $fila['nombre']?></h4>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                <?php  } ?>
           

            </div>
        </div>
    </section>



    <!--testimonios -->
    <section id="testimonios" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title">Lo Que Dicen Nuestros Pacientes</h2>
            <div class="row">

                <?php

                $sql = "SELECT * FROM Testimonios ORDER BY id_testimonio DESC LIMIT 3";
                $resultado = mysqli_query($conexion, $sql);
                while ($fila = mysqli_fetch_array($resultado)) {

                ?>
                    <div class="col-md-4 mb-4">
                        <div class="testimonio-card">
                            <div class="testimonio-texto">
                                <i class="fas fa-quote-left"></i>
                                <p></p>
                            </div>
                            <div class="testimonio-autor">
                                <img src="./img/descarga (12).jpeg" alt="Paciente">
                                <div>
                                    <h4><?php echo $fila['Nombre'] ?></h4>
                                    <p><?php echo $fila['testimonio'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php   } ?>



              

            </div>
        </div>
    </section>



    <!--contacto -->
    <section id="contacto" class="contacto py-5">
        <div class="container">
            <h2 class="section-title">Comentario</h2>
            <div class="row">
                <!-- caja de contacto -->
                <div class="col-md-4 mb-4">
                    <div class="info-contacto">
                        <h3>Información de Contacto</h3>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h4>Ubicación:</h4>
                                <p> Av. Ikunde, Bata</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <h4>Teléfono:</h4>
                                <p>+240 222 144 858</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h4>Email:</h4>
                                <p>DentClinica@clinicadental.com</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h4>Horario:</h4>
                                <p>Lun - Vie: 9:00 - 20:00</p>
                                <p>Sáb: 9:00 - 14:00</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Formulario de contacto -->
                <div class="col-md-8">
                    <div class="formulario-contacto">
                        <form action="" method="POST" id="formTest">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre completo" id="nombre">
                                    <div id="alerta_nombre"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="email" class="form-control" name="email" placeholder="Correo electrónico" id="email">
                                    <div id="alerta_email"></div>
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea class="form-control" name="mensaje" rows="5" placeholder="Mensaje" id="mensaje"></textarea>
                                    <div id="alerta_mensaje"></div>
                                </div>
                                <div class="col-12">
                                    <input class="form-control btn btn-primary" type="submit" value="Enviar Mensaje">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Footer actualizado -->
    <?php include "./componentes/BtnFlotante.php" ?>
    <?php include "./componentes/footer.php" ?>

    <script src="./js/estadisticas.js"></script>
    <script src="./recursos/bootstrap.bundle.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/testimonio.js"></script>
</body>

</html>