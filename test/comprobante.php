<?php
require '../configuracion.php';
require '../vendor/autoload.php'; // Carga FPDF desde Composer

use Fpdf\Fpdf;

$pdf = new Fpdf();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'Comprobante de Compra');
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Gracias por tu compra en Perfumería.', 0, 1);
$pdf->Cell(0, 10, 'Detalle:', 0, 1);
// Agrega más contenido dinámico aquí
$pdf->Cell(0, 10, 'Producto: Perfume X', 0, 1);
$pdf->Cell(0, 10, 'Cantidad: 1', 0, 1);
$pdf->Cell(0, 10, 'Precio: $100', 0, 1);

// Guarda el PDF en el servidor temporalmente
$archivoPdf = '../temp/comprobante.pdf';
$pdf->Output('F', $archivoPdf);
