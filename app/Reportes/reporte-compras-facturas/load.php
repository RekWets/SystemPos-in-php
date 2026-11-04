<?php
require '../../cnx.php';

$columns = ['num_compra','total_compra','proveedor','fecha_compra'];
$nombre_proveedor = "proveedor";
$table = "reporte_compra";
// $categoria='tipo_rif';
$id = 'num_compra';

// $campo = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : null;


$where = '';



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
        $output['data'] .= '<td>' . $row['num_compra'] . '</td>';
        if ($row['proveedor'] != 0) {
            
            $sqlProveedor = "SELECT nombres,tipo_rif,rif FROM proveedores WHERE id = '" . $row['proveedor'] . "'";
            $resultadoProveedor = $conexion->query($sqlProveedor);
            $rowProveedor = $resultadoProveedor->fetch_assoc();
            $output['data'] .= '<td>' . $rowProveedor['nombres'] . '</td>';
            $output['data'] .= '<td>' . $rowProveedor['tipo_rif'] ."-". $rowProveedor['rif'] .'</td>';
            
        } else {
            $output['data'] .= '<td>No Registrado</td>';
            $output['data'] .= '<td>No Registrado</td>';
        }
        $canti = "SELECT COUNT(factura_compras.id_compra) AS cantidad FROM factura_compras where factura_compras.id_compra=" . $row['num_compra'] . "";
        // var_dump($canti);
        $cantid = $conexion->query($canti);
        $cantidad = $cantid->fetch_assoc(); 
        $output['data'] .= '<td>' . $cantidad['cantidad'] . '</td>';
        $output['data'] .= '<td>' . $row['total_compra'] . '</td>';
        $output['data'] .= '<td>' . $row['fecha_compra'] . '</td>';
        
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
