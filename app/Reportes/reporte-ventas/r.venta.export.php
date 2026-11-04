<?php

require_once '../../cnx.php';

$consulta = "SELECT * FROM reporte_venta order by fecha_venta DESC";

    
$resultado = mysqli_query($conexion, $consulta);

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename=reporte-venta.xlsx");

?>

<table>
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
    <td><?php echo $row ['num_ticket']; ?></td>
        <td><?php echo $row ['biopago']; ?></td>
        <td><?php echo $row ['punto_venta']; ?></td>
        <td><?php echo $row ['divisas']; ?></td>
        <td><?php echo $row ['efectivo']; ?></td>
        <td><?php echo $row ['otros']; ?> </td>
        <td><?php echo $row ['total_venta']; ?> </td>
        <td><?php echo $row ['fecha_venta']; ?> </td>
    </tr>
<?php } mysqli_free_result($resultado);?>
</table>
