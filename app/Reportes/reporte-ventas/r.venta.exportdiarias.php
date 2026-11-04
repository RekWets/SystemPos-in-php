<?php

require_once '../../cnx.php';
$max= isset($_GET['ticket_min']) ? $conexion->real_escape_string($_GET['ticket_min']) :"";
$min= isset($_GET['ticket_max']) ? $conexion->real_escape_string($_GET['ticket_max']) :"";

$ordenar="order by fecha_venta DESC";
$where="";
if($min != ""){
    $where="WHERE num_ticket <= $min";
}
if($max != ""){
    $where="WHERE num_ticket >= $max";
}if($max != "" && $min != ""){
    $where="WHERE num_ticket <= $min and num_ticket >= $max";
}

$consulta = "SELECT * FROM reporte_venta $where $ordenar";
$resultado = mysqli_query($conexion, $consulta);

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename=reporte-venta-diarias.xlsx");

?>

<table border="1">
    <td align="center">=COUNT(A3:A1000)</td>
    <td align="center"> =sum(B3:b1000)</td>
    <td align="center"> =sum(c3:c1000)</td>
    <td align="center"> =sum(d3:d1000)</td>
    <td align="center"> =sum(e3:e1000)</td>
    <td align="center"> =sum(f3:f1000)</td>
    <td align="center"> =sum(g3:g1000)</td>
    <tr>
        
        <th>num_ticket</th>
        <th>Biopago</th>
        <th>punto_venta</th>
        <th>divisas</th>
        <th>efectivo</th>
        <th>otros</th>
        <th>total</th>
        <th>Fecha</th>
    </tr>
<?php

while ($row=mysqli_fetch_assoc($resultado)) {

?>
    <tr >
    <td align="center"><?php echo $row ['num_ticket']; ?></td>
        <td align="center"><?php echo  number_format($row ['biopago'], 2, ',', ''); ?></td>
        <td align="center"><?php echo  number_format($row ['punto_venta'], 2, ',', ''); ?></td>
        <td align="center"><?php echo  number_format($row ['divisas'], 2, ',', ''); ?></td>
        <td align="center"><?php echo  number_format($row ['efectivo'], 2, ',', ''); ?> </td>
        <td align="center"><?php echo  number_format($row ['otros'], 2, ',', ''); ?></td>
        <td align="center"><?php echo  number_format($row ['total_venta'], 2, ',', ''); ?> </td>
        <td align="center"><?php echo $row ['fecha_venta']; ?> </td>
</tr>
<?php } mysqli_free_result($resultado);?>
</table>
