<?php
include "../conexion/conexion.php";

// Verificar que se reciban los parámetros necesarios
if (!isset($_GET['id']) || !isset($_GET['estado'])) {
    echo json_encode(['error' => 'Parámetros incompletos']);
    exit;
}

$id_cita = $_GET['id'];
$estado = $_GET['estado'];

try {
    // Preparar la consulta para obtener el id_estado basado en la denominación
    $stmt = mysqli_prepare($conexion, "SELECT id_estado FROM Estado WHERE denominacion = ?");
    mysqli_stmt_bind_param($stmt, "s", $estado);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    
    if ($fila = mysqli_fetch_assoc($resultado)) {
        $id_estado = $fila['id_estado'];
        
        // Preparar la consulta de actualización
        $stmt_update = mysqli_prepare($conexion, "UPDATE Citas SET estado = ? WHERE id_cita = ?");
        mysqli_stmt_bind_param($stmt_update, "ii", $id_estado, $id_cita);
        
        if (mysqli_stmt_execute($stmt_update)) {
            echo json_encode(['success' => true, 'message' => 'Estado actualizado correctamente']);
        } else {
            echo json_encode(['error' => 'Error al actualizar el estado: ' . mysqli_error($conexion)]);
        }
        
        mysqli_stmt_close($stmt_update);
    } else {
        echo json_encode(['error' => 'Estado no encontrado']);
    }
    
    mysqli_stmt_close($stmt);
    
} catch (Exception $e) {
    echo json_encode(['error' => 'Error en el servidor: ' . $e->getMessage()]);
}

mysqli_close($conexion);
?>