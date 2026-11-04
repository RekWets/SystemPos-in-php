<?php
require "../cnx.php";
$html= '';
$columns=['codigo_producto', 'descripcion', 	'existencia', 	'precio_compra', 	'precio_venta', 	'mayor', 	'paquete', 	'nombre_proveedor', 'fecha'];
$table='productos';
$input= isset($_POST['box']) ? $conexion->real_escape_string($_POST['box']): null;
$where="";
if($input!=null){
    $where= "WHERE ( ";

    for($i=0; $i<(count($columns));$i++){
        $where.= $columns[$i] . " LIKE '%" .$input . "%' OR ";
    }
    $where= substr_replace($where,"", -3);
    $where.=")";
}
$SQL = "SELECT " . implode(", ", $columns) . " FROM  $table $where limit 10 ";

$result = $conexion ->query($SQL);
$num_rows= $result-> num_rows;

while($row=$result -> fetch_assoc()){
    if($_POST["box"]!=null)
        $html .= "<li  id='new_element' data-name='" .$row['codigo_producto']. "' >" .$row['descripcion']. " -- Existencia:  ".$row["existencia"]." </li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
?>