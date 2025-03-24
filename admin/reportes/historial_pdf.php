<?php
require('../fpdf/fpdf.php');
include "../conexion/conexion.php";

class PDF extends FPDF {
    // Colores corporativos
    private $colorPrimario = [41, 128, 185];  // Azul
    private $colorSecundario = [46, 204, 113]; // Verde
    private $colorAcento = [155, 89, 182];     // Morado
    private $colorTexto = [52, 73, 94];        // Gris oscuro
    private $colorFondo = [236, 240, 241];     // Gris claro

    function Header() {
        // Fondo del encabezado
        $this->SetFillColor(...$this->colorPrimario);
        $this->Rect(0, 0, 220, 50, 'F');
        
        // Logo
        $logo_path = dirname(__FILE__) . '/../img/logo.png';
        if(file_exists($logo_path)) {
            $this->Image($logo_path, 10, 5, 45);
        }
        
        // Título principal
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 24);
        $this->Cell(60); // Espacio después del logo
        $this->Cell(0, 25, utf8_decode('HISTORIAL CLÍNICO'), 0, 1, 'C');
        
        // Fecha y código
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 5, utf8_decode('Fecha de emisión: ') . date('d/m/Y'), 0, 1, 'R');
        
        $this->Ln(20);
        $this->SetTextColor(0, 0, 0);
    }

    function Footer() {
        $this->SetY(-30);
        
        // Línea decorativa
        $this->SetDrawColor(...$this->colorPrimario);
        $this->SetLineWidth(0.8);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        
        // Información del pie
        $this->SetY(-25);
        $this->SetTextColor(...$this->colorTexto);
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(0, 10, utf8_decode('DISFARCO - Clínica Dental Especializada'), 0, 1, 'C');
        $this->Cell(0, 5, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function SeccionTitulo($titulo) {
        $this->SetFillColor(...$this->colorPrimario);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, ' ' . utf8_decode($titulo), 1, 1, 'L', true);
        $this->SetTextColor(...$this->colorTexto);
        $this->Ln(2);
    }

    function FilaInfo($etiqueta, $valor, $alternate = true) {
        if($alternate) {
            $this->SetFillColor(...$this->colorFondo);
        }
        
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(50, 8, utf8_decode($etiqueta . ': '), 0, 0, 'L', $alternate);
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(0, 8, utf8_decode($valor), 0, 'L', $alternate);
    }

    function ContenidoSeccion($texto) {
        $this->SetFont('Arial', '', 11);
        $this->SetTextColor(...$this->colorTexto);
        $this->MultiCell(0, 7, utf8_decode($texto), 0, 'L');
    }

    function AgregarFirma() {
        $this->Ln(20);
        $this->SetDrawColor(...$this->colorPrimario);
        $this->SetLineWidth(0.5);
        $this->Line(65, $this->GetY(), 145, $this->GetY());
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 5, utf8_decode('Dr. ____________________'), 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 5, utf8_decode('Especialista Tratante'), 0, 1, 'C');
        $this->Cell(0, 5, utf8_decode('No. Registro: ____________'), 0, 1, 'C');
    }
}

try {
    if (!isset($_GET['id'])) {
        throw new Exception('ID no especificado');
    }

    $id_historial = mysqli_real_escape_string($conexion, $_GET['id']);

    // Consulta SQL (la misma que tenías)
    $query = "SELECT 
        h.id_historial,
        p.nombre AS nombre_paciente,
        p.apellido AS apellido_paciente,
        p.email AS email_paciente,
        p.fecha_nacimiento,
        p.telefono,
        s.nombre_servicio,
        s.descripcion AS descripcion_servicio,
        h.fecha,
        h.diagnostico,
        h.tratamiento,
        h.notas
    FROM Historial_Medico h
    JOIN Pacientes p ON h.id_paciente = p.id_paciente
    JOIN Servicio s ON h.id_servicio = s.id_servicio
    WHERE h.id_historial = ?";

    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_historial);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $historial = mysqli_fetch_assoc($resultado);

    if (!$historial) {
        throw new Exception('Historial no encontrado');
    }

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    // Datos del Paciente
    $pdf->SeccionTitulo('INFORMACIÓN DEL PACIENTE');
    $pdf->FilaInfo('Nombre', $historial['nombre_paciente'] . ' ' . $historial['apellido_paciente'], true);
    $pdf->FilaInfo('Email', $historial['email_paciente'], false);
    $pdf->FilaInfo('Teléfono', $historial['telefono'], true);
    $pdf->FilaInfo('Fecha de Nacimiento', date('d/m/Y', strtotime($historial['fecha_nacimiento'])), false);

    // Detalles del Servicio
    $pdf->Ln(8);
    $pdf->SeccionTitulo('DETALLES DEL SERVICIO');
    $pdf->FilaInfo('Tipo de Servicio', $historial['nombre_servicio'], true);
    $pdf->FilaInfo('Descripción', $historial['descripcion_servicio'], false);
    $pdf->FilaInfo('Fecha de Atención', date('d/m/Y', strtotime($historial['fecha'])), true);

    // Diagnóstico
    $pdf->Ln(8);
    $pdf->SeccionTitulo('DIAGNÓSTICO CLÍNICO');
    $pdf->ContenidoSeccion($historial['diagnostico']);

    // Plan de Tratamiento
    $pdf->Ln(8);
    $pdf->SeccionTitulo('PLAN DE TRATAMIENTO');
    $pdf->ContenidoSeccion($historial['tratamiento']);

    // Notas Adicionales
    if (!empty($historial['notas'])) {
        $pdf->Ln(8);
        $pdf->SeccionTitulo('OBSERVACIONES ADICIONALES');
        $pdf->ContenidoSeccion($historial['notas']);
    }

    // Agregar firma
    $pdf->AgregarFirma();

    // Generar nombre del archivo
    $nombre_archivo = 'Historial_' . 
                     preg_replace('/[^A-Za-z0-9]/', '_', $historial['nombre_paciente']) . '_' . 
                     preg_replace('/[^A-Za-z0-9]/', '_', $historial['apellido_paciente']) . 
                     '.pdf';

    // Generar PDF
    $pdf->Output('I', $nombre_archivo);

} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}