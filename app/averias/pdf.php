<?php
require '../cnx.php';
require '../../fpdf/fpdf.php';

$pdf = new FPDF($orientation = 'P', $unit = 'mm', array(80, 200));        
$pdf->AddPage();        
$pdf->setMargins(10,10,10);
//nombre del negocio
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(60, 6, 'ASOC COOP. FERGAVICA	 R.L',0,0,'C');
$pdf->Ln();
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(60, 6, "J-315125790",0,0,'C');  
$pdf->Ln();
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(60, 6, "SANTA ROSA  Av. Cristobal Mendoza,Trujillo",0,0,'C');  


$pdf->Ln();
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(60, 6, ("TICKET DE AVERIA"),0,0,'C');
$pdf->Ln();
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(60, 4, ("Reporte - " . $_GET['num_averia']),0,0,'C');

$pdf->Ln();
$pdf->Cell(60, 6, ("___________________________________________"),0,0,'C');
$pdf->Ln();


$total = 0;
$c1="SELECT * FROM factura_averia INNER JOIN productos ON factura_averia.id_producto_averia  = productos.codigo_producto WHERE factura_averia.id_factura   = {$_GET['num_averia']}";
$productos=mysqli_query($conexion,$c1);
$pdf->SetFont('Arial', '', 8);

foreach ($productos as $pro) {
    
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(5, 4,  (strtoupper(substr($pro["descripcion"], 0, 20))));
    $pdf->Cell(24, 4,  $pro["cantidad"], 0, 0, 'R');

    $pdf->Cell(5, 4, "X", 0, 0, 'R');

    $pdf->Cell(15, 4, "Bs:" . number_format($pro["precio"], 2, ".", ","), 0, 0, 'R');
    

    $pdf->Cell(15, 4,  "Bs:" . number_format($pro["precio"] * $pro["cantidad"], 2, ".", ","), 0, 0, "R");            

    $pdf->Ln();
    $pdf->Ln();

    $total += $pro["precio"] * $pro["cantidad"];

}


$pdf->Cell(20, 4, "Sub. Total:" );
$pdf->Cell(40, 4, "Bs: ". ROUND($total-$total*0.16),0, 0, 'R');
$pdf->Ln();
$pdf->Cell(20, 4, "I.V.A.(16%):" );
$pdf->Cell(40, 4, "Bs: ". ROUND($total*0.16,2),0, 0, 'R');
$pdf->Ln();
$pdf->Cell(20, 4, "TOTAL  PAGADO: ");
$pdf->Cell(40, 4, "Bs: ". ROUND($total,2),0, 0, 'R');
$pdf->Ln();

$pdf->Output();

?>
