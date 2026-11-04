<?php
require 'cnx.php';
require '../fpdf/fpdf.php';

$pdf = new FPDF($orientation = 'P', $unit = 'mm', array(72,150));        
$pdf->AddPage();        
$pdf->setMargins(2,0,0);
//nombre del negocio
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(65, 4, 'ASOC COOP. FERGAVICA	 R.L',0,0,'C');

$pdf->Ln();
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(65, 4, "SANTA ROSA  Av. Cristobal Mendoza,Trujillo",0,0,'C');  

$pdf->Ln();
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 4, ("TICKET DE VENTA"),0,0,'C');
$pdf->Ln();
$pdf->SetFont('Arial', '', 9);
$c="SELECT * FROM reporte_venta WHERE num_ticket = {$_GET['id_venta']}";
$productos=mysqli_query($conexion,$c);
foreach ($productos as $pro) {
$pdf->Cell(0, 4,  $pro["fecha_venta"],0, 0, 'C');
$pdf->Ln();
}

$pdf->Cell(60, 4, ("_______________________________________________"),0,0,'C');
$pdf->Ln();

$total = 0;
$c1="SELECT * FROM factura_ventas INNER JOIN productos ON factura_ventas.id_productos = productos.codigo_producto WHERE factura_ventas.id_venta = {$_GET['id_venta']}";
$productos=mysqli_query($conexion,$c1);
$pdf->SetFont('Arial', '', 8);
foreach ($productos as $pro) {
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(9,4,  (strtoupper(substr($pro["descripcion"], 0, 20,))));
    $pdf->Cell(24, 4,  $pro["cantidad"], 0, 0, 'R');

    $pdf->Cell(4, 4, "X", 0, 0, 'R');

    $pdf->Cell(13, 4, "Bs:" . number_format($pro["precio_unidad"], 2, ".", ","), 0, 0, 'R');
    
    $pdf->Cell(4, 4, "=", 0, 0, 'R');
    $pdf->Cell(13, 4,  "Bs:" . number_format($pro["precio_unidad"] * $pro["cantidad"], 2, ".", ","), 0, 0, "R");            
    $pdf->Ln();
    $total += $pro["precio_unidad"] * $pro["cantidad"];
    
}
$pdf->Cell(60, 4, ("_____________________________________________________"),0,0,'C');
$pdf->Ln();

$c="SELECT * FROM reporte_venta WHERE num_ticket = {$_GET['id_venta']}";
$productos=mysqli_query($conexion,$c);
foreach ($productos as $pro) {
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(20, 4, "Sub. Total:" );
$pdf->Cell(40, 4, "Bs: ". number_format(round($total - ($total * 0.16), 2), 2, '.', ','), 0, 0, 'R');
$pdf->Ln();
$pdf->Cell(20, 4, "I.V.A.(16%):" );
$pdf->Cell(40, 4, "Bs: ". number_format(round($total * 0.16, 2), 2, '.', ','), 0, 0, 'R');
$pdf->Ln();
$pdf->Cell(20, 4, "TOTAL A PAGAR: ");
$pdf->Cell(40, 4, "Bs: ". number_format(round($total, 2), 2, '.', ','), 0, 0, 'R');
$pdf->Ln();
$pdf->Cell(60, 6, ("_____________________________________________________"),0,0,'C');
$pdf->Ln();
$pdf->Cell(70, 4, ("METODO DE PAGO "),0,0,'C');
$pdf->Ln();
$pdf->Cell(20, 4, "BIOPAGO:" );
$pdf->Cell(40, 4, "Bs: ".$pro["biopago"],0, 0, 'R');
$pdf->Ln();
$pdf->Cell(20, 4, "PUNTO VENTA" );
$pdf->Cell(40, 4, "Bs: ". $pro["punto_venta"],0, 0, 'R');
$pdf->Ln();
$pdf->Cell(20, 4, "DIVISAS:" );
$pdf->Cell(40, 4, "Bs: ".$pro["divisas"],0, 0, 'R');
$pdf->Ln();
$pdf->Cell(20, 4, "EFECTIVO:" );
$pdf->Cell(40, 4, "Bs: ". $pro["efectivo"],0, 0, 'R');
$pdf->Ln();
$pdf->Cell(20, 4, "OTROS:" );
$pdf->Cell(40, 4, "Bs: ". $pro["otros"],0, 0, 'R');
$pdf->Ln();
$pdf->Output();
}
?>
