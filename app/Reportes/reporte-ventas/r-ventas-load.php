<?php
require '../../cnx.php';

$columns = ['num_ticket', 'descripcion', 'biopago', 'punto_venta', 'divisas', 'efectivo', 'otros', 'total_venta', 'fecha_venta'];
$factura = "factura_ventas";
$table = "reporte_venta";
$id = 'num_ticket';
$fecha_desde = isset($_POST['fecha_desde']) ? $conexion->real_escape_string($_POST['fecha_desde']) : "";
$fecha_hasta = isset($_POST['fecha_hasta']) ? $conexion->real_escape_string($_POST['fecha_hasta']) : "";
$campo = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : "";
$min = isset($_POST['ticket_min']) ? $conexion->real_escape_string($_POST['ticket_min']) : "";
$max = isset($_POST['ticket_max']) ? $conexion->real_escape_string($_POST['ticket_max']) : "";
$limit = isset($_POST['registros']) ? $conexion->real_escape_string($_POST['registros']) : 10;
$pagina = isset($_POST['pagina']) ? $conexion->real_escape_string($_POST['pagina']) : 0;
$where = "";
$fecha="";
$ticket="";
if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
} else {
    $inicio = ($pagina - 1) * $limit;
}

if ($fecha_desde != "") {
    $fecha = "where fecha_venta >= '$fecha_desde'";
}
if ($fecha_hasta != "") {
    $fecha .= " and fecha_venta <= '$fecha_hasta'";
}
if ($min != "") {
    $ticket .= " and num_ticket >= $min";
}
if ($max != "") {
    $ticket .= " and num_ticket <= $max";
}if ($campo != "") {
    $where = "and $campo > 0";
}

$sLimit = " LIMIT $inicio , $limit";
$sOrder = " ORDER BY num_ticket desc ";
$sql = "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", $columns) . "
FROM $table

$fecha
$where
$ticket
$sOrder
$sLimit";
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

        $output['data'] .= '<td ><a href="/cafetin/app/pdf.php?id_venta= ' . $row['num_ticket'] . '" target="_blank">' . $row['num_ticket'] . '</a></td>';
        $output['data'] .= '<td class="bio">' . $row['biopago'] . '</td>';
        $output['data'] .= '<td class="puntoz">' . $row['punto_venta'] . '</td>';
        $output['data'] .= '<td class="divisasz">' . $row['divisas'] . '</td>';
        $output['data'] .= '<td class="efectivoz" >' . $row['efectivo'] . '</td>';
        $output['data'] .= '<td class="otrosz">' . $row['otros'] . '</td>';
        $output['data'] .= '<td class="totalz">' . $row['total_venta'] . '</td>';
        $output['data'] .= '<td class="fecha">' . $row['fecha_venta'] . '</td>';

        $output['data'] .= '</tr>';
    }


    if ($output['totalRegistros'] > 0) {
        $totalPaginas = ceil($totalFiltro / $limit);

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
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
