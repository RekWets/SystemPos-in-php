<?php
require '../../cnx.php';

$columns = ['id_factura', 'productos.descripcion AS nombre_producto', 'cantidad', 'precio', "total", "fecha_averia"];
$table = "factura_averia";
$eljoin = " INNER JOIN productos ON factura_averia.id_producto_averia  = productos.codigo_producto";
$id = 'id_factura';
$campo = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : "";
$fecha_desde = isset($_POST['fecha_desde']) ? $conexion->real_escape_string($_POST['fecha_desde']) : "";
$fecha_hasta = isset($_POST['fecha_hasta']) ? $conexion->real_escape_string($_POST['fecha_hasta']) : "";
$min = isset($_POST['ticket_min']) ? $conexion->real_escape_string($_POST['ticket_min']) : "";
$max = isset($_POST['ticket_max']) ? $conexion->real_escape_string($_POST['ticket_max']) : "";
$limit = isset($_POST['registros']) ? $conexion->real_escape_string($_POST['registros']) : 10;
$pagina = isset($_POST['pagina']) ? $conexion->real_escape_string($_POST['pagina']) : 0;
$posicion = " ORDER BY id DESC";
$where = "";

if ($campo != "") {
    $where = "where productos.descripcion = '$campo'";
}
if ($fecha_desde != "") {
    $where .= " and fecha_averia >= '$fecha_desde'";
}
if ($fecha_hasta != "") {
    $where .= " and fecha_averia <= '$fecha_hasta'";
}
if ($min != "") {
    $where .= " and id_factura >= $min";
}
if ($max != "") {
    $where .= " and id_factura <= $max";
}

// Comprueba si $where está vacío
if (empty($where)) {
    // No se ha especificado ninguna condición
    $where = "";
}




if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
} else {
    $inicio = ($pagina - 1) * $limit;
}

$sLimit = "LIMIT $inicio , $limit";

$sOrder = "";
if (isset($_POST['orderCol'])) {
    $orderCol = $_POST['orderCol'];
    $oderType = isset($_POST['orderType']) ? $_POST['orderType'] : 'asc';

    $sOrder = "ORDER BY " . $columns[intval($orderCol)] . ' ' . $oderType;
}


$sql = "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", $columns) . "
FROM $table
$eljoin
$where

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

        $output['data'] .=  '<td style="width:140px;" ><a href="/cafetin/app/averias/pdf.php?num_averia= ' . $row['id_factura'] . '" target="_blank">' . $row['id_factura'] . '</a></td>';
        $output['data'] .= '<td style="width:140px;">' . $row['nombre_producto'] . '</td>';
        $output['data'] .= '<td id="cantidad" style="width:140px;">' . $row['cantidad'] . '</td>';
        $output['data'] .= '<td id="bs" style="width:140px;">' . $row['total'] . '</td>';
        $output['data'] .= '<td class="fecha">' . $row['fecha_averia'] . '</td>';
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

    if (($pagina - 1) > 1) {
        $numeroInicio = $pagina - 1;
    }

    $numeroFin = $numeroInicio + 2;

    if ($numeroFin > $totalPaginas) {
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
