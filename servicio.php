<?php
$servicios = [
    'limpieza-dental' => [
        'titulo' => 'Limpieza Dental Profesional',
        'icono' => 'tooth',
        'descripcion_corta' => 'Mantén tu sonrisa brillante y saludable con nuestros tratamientos profesionales.',
        'descripcion_larga' => 'Nuestro servicio de limpieza dental profesional utiliza tecnología de última generación para eliminar la placa bacteriana y el sarro, dejando tus dientes limpios y brillantes.',
        'beneficios' => [
            'Eliminación de placa y sarro',
            'Prevención de caries y enfermedades periodontales',
            'Detección temprana de problemas dentales',
            'Aliento más fresco',
            'Sonrisa más brillante'
        ],
        'precio' => 'Desde 15.000 FCFA',
        'duracion' => '45-60 minutos'
    ],
    'ortodoncia' => [
        'titulo' => 'Tratamiento de Ortodoncia',
        'icono' => 'teeth',
        'descripcion_corta' => 'Alineación dental perfecta con brackets tradicionales o invisibles.',
        'descripcion_larga' => 'Ofrecemos diferentes opciones de tratamiento ortodóntico para corregir la alineación de tus dientes y mejorar tu mordida.',
        'beneficios' => [
            'Alineación dental perfecta',
            'Mejora de la mordida',
            'Facilita la higiene dental',
            'Previene problemas futuros',
            'Aumenta la confianza'
        ],
        'precio' => 'Desde 15.000 FCFA',
        'duracion' => 'Variable según el caso'
    ],
    'implantes' => [
        'titulo' => 'Implantes Dentales',
        'icono' => 'crown',
        'descripcion_corta' => 'Recupera tu sonrisa con implantes de última generación.',
        'descripcion_larga' => 'Los implantes dentales son la solución más avanzada para reemplazar dientes perdidos, proporcionando una alternativa permanente y natural.',
        'beneficios' => [
            'Apariencia natural',
            'Función dental completa',
            'Solución permanente',
            'Previene pérdida ósea',
            'Mejora la calidad de vida'
        ],
        'precio' => 'Desde 15.000 FCFA',
        'duracion' => '2-3 sesiones'
    ]
];

$id = $_GET['id'] ?? '';
$servicio = $servicios[$id] ?? null;

if (!$servicio) {
    header('Location: index.php#servicios');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $servicio['titulo']; ?> - Clínica Dental</title>
    <link href="./recursos/bootstrap.min.css" rel="stylesheet">
    <link href="./recursos/all.css" rel="stylesheet">
    <link href="./css/main.css" rel="stylesheet">
    <link href="./css/servicio.css" rel="stylesheet">
</head>
<body>
    <?php include "./componentes/header.php"; ?>

    <main class="servicio-detalle py-5">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="index.php#servicios">Servicios</a></li>
                    <li class="breadcrumb-item active"><?php echo $servicio['titulo']; ?></li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-lg-8">
                    <div class="servicio-content">
                        <h1><?php echo $servicio['titulo']; ?></h1>
                        <div class="servicio-icon mb-4">
                            <i class="fas fa-<?php echo $servicio['icono']; ?> fa-3x"></i>
                        </div>
                        <p class="lead"><?php echo $servicio['descripcion_larga']; ?></p>
                        
                        <h3 class="mt-5">Beneficios</h3>
                        <ul class="beneficios-list">
                            <?php foreach ($servicio['beneficios'] as $beneficio): ?>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <?php echo $beneficio; ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="servicio-sidebar">
                        <div class="info-card">
                            <h3>Información del Servicio</h3>
                            <ul>
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <span>Duración: <?php echo $servicio['duracion']; ?></span>
                                </li>
                                <li>
                                    <i class="fas fa-tag"></i>
                                    <span>Precio: <?php echo $servicio['precio']; ?></span>
                                </li>
                            </ul>
                            <a href="./formularios.php" class="btn btn-primary btn-block">
                                <i class="fas fa-calendar-check"></i> Agendar Cita
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include "./componentes/footer.php"; ?>
    
    <script src="./recursos/bootstrap.bundle.min.js"></script>
</body>
</html>