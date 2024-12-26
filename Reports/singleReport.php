<?php
require_once('../FPDF/fpdf.php');

include_once('../Models/conexion.php');
$conexion = new Conexion();
$con = $conexion->conectar();
$id = $_GET['id'];
$query = "SELECT * FROM estudiantes WHERE CED_EST='$id'";
$result = $con->execute_query($query);

$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont('Arial','B', 16);

$pdf->Cell(0,10, 'Reporte de estudiantes',0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 10, 'Cedula', 1, 0, 'C');
$pdf->Cell(30, 10, 'Nombre', 1, 0, 'C');
$pdf->Cell(30, 10, 'Apellido', 1, 0, 'C');
$pdf->Cell(30, 10, 'Telefono', 1, 0, 'C');
$pdf->Cell(30, 10, 'Direccion', 1, 1, 'C');

$pdf->SetFont('Arial', '', 12);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(30, 10, $row['CED_EST'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['NOM_EST'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['APE_EST'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['TLF_EST'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['DIR_EST'], 1, 1, 'C');
    }
} else {
     $pdf->Cell(70, 10, 'No hay estudiantes', 1, 1, 'C');
}

$pdf->Output('I','estudiante.pdf');
