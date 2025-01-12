<?php
require_once('../FPDF/fpdf.php');

include_once('../Models/conexion.php');
$conexion = new Conexion();
$con = $conexion->conectar();
$id = $_GET['id'];
$query = "SELECT * FROM estudiantes WHERE CED_EST='$id'";
$result = $con->execute_query($query);

class PDF extends FPDF
{
    // Encabezado
    function Header()
    {
        // Logo UTA izquierda
        $this->Image('../Img/logo.png', 10, 10, 40);
        // Logo FISEI derecha
        $this->Image('../Img/logofisei.png', 170, 10, 40);
        // Título
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, utf8_decode('REPORTE DE ESTUDIANTE'), 0, 1, 'C');
        $this->Ln(20);
    }

  
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Ajuste para centrar la tabla correctamente
$margen_izquierdo = ($pdf->GetPageWidth() - 190) / 2;
$pdf->SetX($margen_izquierdo);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(200, 200, 200);
$pdf->Cell(38, 10, 'Cedula', 1, 0, 'C', true);
$pdf->Cell(38, 10, 'Nombre', 1, 0, 'C', true);
$pdf->Cell(38, 10, 'Apellido', 1, 0, 'C', true);
$pdf->Cell(38, 10, 'Telefono', 1, 0, 'C', true);
$pdf->Cell(38, 10, 'Direccion', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 12);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->SetX($margen_izquierdo);
        $pdf->Cell(38, 10, $row['CED_EST'], 1, 0, 'C');
        $pdf->Cell(38, 10, utf8_decode($row['NOM_EST']), 1, 0, 'C');
        $pdf->Cell(38, 10, utf8_decode($row['APE_EST']), 1, 0, 'C');
        $pdf->Cell(38, 10, $row['TLF_EST'], 1, 0, 'C');
        $pdf->Cell(38, 10, utf8_decode($row['DIR_EST']), 1, 1, 'C');
    }
} else {
    $pdf->SetX($margen_izquierdo);
    $pdf->Cell(190, 10, 'No hay estudiantes', 1, 1, 'C');
}

$pdf->Output('I','estudiante.pdf');
?>
