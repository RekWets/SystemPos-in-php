<?php
require '../../cnx.php';

$columns = ['id_compra','id_productos','cantidad_comprada','fecha'];
$nombre_proveedor = "proveedor";
$table = "factura_compras";
$id = 'id_compra';

$campo = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : null;
$fecha_desde = isset($_POST['fecha_desde']) ? $conexion->real_escape_string($_POST['fecha_desde']) : "";
$fecha_hasta = isset($_POST['fecha_hasta']) ? $conexion->real_escape_string($_POST['fecha_hasta']) : "";
$posicion="ORDER BY id_compra DESC";
$where = "";
$fecha ="";
if($campo != null){
    $where ="where id_productos LIKE '$campo' ";
}if ($fecha_desde != "") {
    $fecha = "WHERE fecha >= '$fecha_desde'";
}
if ($fecha_hasta != "") {
    $fecha .= "where fecha <= '$fecha_hasta'";
}
if ($fecha_desde != "" && $fecha_hasta != "") {
    $fecha = "WHERE fecha >= '$fecha_desde' AND fecha <= '$fecha_hasta'";
}
if ($campo != "" && $fecha_desde != "") {
    $where = "WHERE $campo > 0 AND fecha >= '$fecha_desde'";
    $fecha = "";
}
if ($campo != "" && $fecha_hasta != "") {
    $where = "WHERE $campo > 0 AND fecha <= '$fecha_hasta'";
    $fecha = "";
}
if ($campo != "" && $fecha_hasta != "" && $fecha_desde != "") {
    $where = "WHERE $campo > 0 AND fecha >= '$fecha_desde' AND fecha <= '$fecha_hasta'";
    $fecha = "";
}


$limit = isset($_POST['registros']) ? $conexion->real_escape_string($_POST['registros']) : 10;
$pagina = isset($_POST['pagina']) ? $conexion->real_escape_string($_POST['pagina']) : 0;

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
} else {
    $inicio = ($pagina - 1) * $limit;
}

$sLimit = "LIMIT $inicio , $limit";

 $sOrder = "";
 if(isset($_POST['orderCol'])){
    $orderCol = $_POST['orderCol'];
    $oderType = isset($_POST['orderType']) ? $_POST['orderType'] : 'asc';
    
    $sOrder = "ORDER BY ". $columns[intval($orderCol)] . ' ' . $oderType;
 }


$sql = "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", $columns) . "
FROM $table
$where
$fecha
$posicion
$sLimit ";
$resultado = $conexion->query($sql);
$num_rows = $resultado->num_rows;

$sqlFiltro = "SELECT FOUND_ROWS()";
$resFiltro = $conexion->query($sqlFiltro);
$row_filtro = $resFiltro->fetch_array();
$totalFiltro = $row_filtro[0];

$sqlTotal = "SELECT count($id) FROM $table ";
$resTotal = $conexion->query($sqlTotal);
$row_total = $resTotal->fetch_array();
$totalRegistros = $row_total[0];

$output = [];
$output['totalRegistros'] = $totalRegistros;
$output['totalFiltro'] = $totalFiltro;
$output['data'] = '';
$output['paginacion'] = '';

if ($num_rows > 0) {
   
    while ($row = $resultado->fetch_assoc()) {
       
        $output['data'] .=  '<td ><a href="/cafetin/app/cpdf.php?id_factura_compra= '. $row['id_compra'] . '" target="_blank">' .$row['id_compra'].'</a></td>';
        $output['data'] .= '<td>' . $row['id_productos'] . '</td>';
        $sqldescripcion = "SELECT descripcion FROM productos WHERE productos.codigo_producto = '" . $row['id_productos'] . "'";
        $resultadodescripcion = $conexion->query($sqldescripcion);
        $rowdescripcion = $resultadodescripcion->fetch_assoc();
        $output['data'] .= '<td>' . $rowdescripcion['descripcion'] . '</td>';
        $output['data'] .= '<td>' . $row['cantidad_comprada'] . '</td>';
        $output['data'] .= '<td class="fecha">' . $row['fecha'] . '</td>';
        $output['data'] .= '</tr>';
    }

} else {
    $output['data'] .= '<tr>';
    $output['data'] .= '<td colspan="5">Sin resultados</td>';
    $output['data'] .= '</tr>';
}

if ($output['totalRegistros'] > 0) {
    $totalPaginas = ceil($output['totalRegistros'] / $limit);

    $output['paginacion'] .= '<nav>';
    $output['paginacion'] .= '<ul class="pagination">';

    $numeroInicio = 1;

    if(($pagina - 1) > 1){
        $numeroInicio = $pagina - 1;
    }

    $numeroFin = $numeroInicio + 2;

    if($numeroFin > $totalPaginas){
        $numeroFin = $totalPaginas;
    }

    for ($i = $numeroInicio; $i <= $numeroFin; $i++) {
        if ($pagina == $i) {
            $output['paginacion'] .= '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
        } else {
            $output['paginacion'] .= '<li class="page-item"><a class="page-link" href="#" onclick="nextPage(' . $i . ')">' . $i . '</a></li>';
        }
    }

    $output['paginacion'] .= '</ul>';
    $output['paginacion'] .= '</nav>';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
