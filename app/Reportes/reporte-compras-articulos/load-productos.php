<?php
require "../../cnx.php";
$html= '';
$columns=['descripcion','codigo_producto'];
$table='productos';
$input= isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']): null;
$limit="limit 11";
$where="";
if($input!=null){
    $where= "WHERE ( ";

    for($i=0; $i<(count($columns));$i++){
        $where.= $columns[$i] . " LIKE '%" .$input . "%' OR ";
    }
    $where= substr_replace($where,"", -3);
    $where.=")";
}
$SQL = "SELECT " . implode(", ", $columns) . " FROM  $table $where $limit ";

$result = $conexion ->query($SQL);
$num_rows= $result-> num_rows;

while($row=$result -> fetch_assoc()){
    if($_POST["campo"]!=null)
        $html .= "<li style='background:#D4D9FE;border:1px solid #071E54;border-radius:4px;' id='new_element' data-name='" .$row['codigo_producto']. "' >" .$row['descripcion']. " </li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
?>