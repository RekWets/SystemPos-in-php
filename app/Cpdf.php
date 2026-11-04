<?php
require 'cnx.php';
require '../fpdf/fpdf.php';

$pdf = new FPDF($orientation = 'P', $unit = 'mm', array(100, 200));        
$pdf->AddPage();        
$pdf->setMargins(20,20,20);
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
$pdf->Cell(60, 6, ("TICKET DE COMPRA"),0,0,'C');
$pdf->Ln();
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(60, 4, ("Reporte - " . $_GET['id_factura_compra']),0,0,'C');
$pdf->Ln();
$pdf->Cell(60, 6, ("_________________________________________________________________________________________________________________________________"),0,0,'C');
$pdf->setMargins(10,10,10);
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(79, 4, ("|        PRECIOS        |"),0,0,'C');
$pdf->Ln();
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(4, 4, ("DESCRIPCION     | COMPRA |   VENTA   | CANTIDAD | TOTAL  "),0,0,'l');
$pdf->Ln();
$total = 0;
$c1="SELECT * FROM factura_compras INNER JOIN productos ON factura_compras.id_productos = productos.codigo_producto WHERE factura_compras.id_compra = {$_GET['id_factura_compra']}";
$productos=mysqli_query($conexion,$c1);


foreach ($productos as $pro) {

    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(1, 4,  (strtoupper(substr($pro["descripcion"], 0,15))));
    $pdf->Cell(35,4,  $pro["nuevo_precio_compra"], 0, 0, 'R');
    $pdf->Cell(15,4,  $pro["nuevo_precio_venta"], 0, 0, 'R');
    $pdf->Cell(5, 4, "X", 0, 0, 'R');
    $pdf->Cell(10, 4, number_format($pro["cantidad_comprada"], 2, ".", ","), 0, 0, 'R'); 
    $pdf->Cell(5, 4, "=", 0, 0, 'R');
    $pdf->Cell(10, 4, number_format($pro["cantidad_comprada"] * $pro["nuevo_precio_compra"], 2, ".", ","), 0, 0, "R");            
    $pdf->Ln();
    $total += $pro["nuevo_precio_compra"] * $pro["cantidad_comprada"];

}
$pdf->Cell(80, 4, ("______________________________________________________________________________________"),0,0,'C');
$pdf->Ln();
$pdf->SetFont('Arial', 'b', 9);
$pdf->Cell(10, 4, "Sub. Total Bs: " ,0, 0, 'C');
$pdf->Cell(70, 4,number_format($total-$total*0.16,2),0, 0, 'R');
$pdf->Ln();
$pdf->Cell(80, 4, ("______________________________________________________________________________________"),0,0,'C');
$pdf->Ln();

$pdf->Cell(10, 4, "I.V.A.(16%) Bs: " ,0, 0, 'C');
$pdf->Cell(70, 4, number_format($total*0.16,2),0, 0, 'R');
$pdf->Ln();
$pdf->Cell(80, 4, ("______________________________________________________________________________________"),0,0,'C');
$pdf->Ln();
$pdf->Cell(20, 4, "TOTAL  PAGADO BS: ",0, 0, 'C');
$pdf->Cell(60, 4, number_format($total,2),0, 0, 'R');
$pdf->Ln();

$pdf->Output();

?>
