<?php
require '../../cnx.php';

$columns = ['codigo_producto','descripcion','existencia','fecha','nombre_proveedor'];
$table = "productos";
$id = 'codigo_producto';

$campo = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : null;
$min = isset($_POST['ticket_min']) ? $conexion->real_escape_string($_POST['ticket_min']) : "";
$max = isset($_POST['ticket_max']) ? $conexion->real_escape_string($_POST['ticket_max']) : "";
$where = '';
$exist = '';
if($campo != null){
    $where ="where descripcion LIKE '%$campo%'";
}
if ($min != "") {
    $exist = "where existencia >= $min";
}
if ($max != "") {
    $exist .= " and existencia <= $max";
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
$exist
$sOrder
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
        $output['data'] .= '<td style="width:60px;">' . $row['codigo_producto'] . '</td>';
        $output['data'] .= '<td style="width:300px;">' . $row['descripcion'] . '</td>';
        $output['data'] .= '<td>' . $row['existencia'] . '</td>';
        $output['data'] .= '<td class="fecha">' . $row['fecha'] . '</td>';
        $output['data'] .= '<td><a href="/cafetin/views/compras/compras.php?codigo=' . $row['codigo_producto']. '"><img src="/cafetin/images/carrito.svg"width="20" height="20" ></a>';
        $output['data'] .= '<a href="/cafetin/views/producto/editar.php?id=' . $row['codigo_producto']  . '&proveedor='.$row['nombre_proveedor'] .'"><img src="/cafetin/images/editar.svg"width="20" height="20" ></a></td>';
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
