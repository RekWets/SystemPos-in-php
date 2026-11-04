<!DOCTYPE html>
<?php
// include 'r-ventas-load.php';
require_once '../../app/cnx.php';
require_once '../../app/header.php';
if (!isset($_SESSION['user']) || !in_array($_SESSION['rol'], ['administrador', 'lector', ])) {
  header("Location: http://localhost/cafetin/index.php");
  exit;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>REPORTES DE COMPRAS POR PRODUCTOS</title>

  </head>
<body class="b container">
    
  
<main class="container_Main">
      <h1>REPORTES COMPRAS POR PRODUCTOS</h1>
      <h3>Cafetin del hospital Dr. Jose Gregorio Hernandez.</h3>
</div>
<div class="total">
    <select name="num_registros" id="num_registros" class="form-select"  >
    <label for="num_registros" class="col-form-label">registros </label>
        <option selected value="10">10</option>
        <option  value="50">50</option>
        <option  value="100">100</option>
        <option  value="250">250</option>
    </select>
</div>
   <div class="">
                <div class="">
                    <label id="lbl-total" hidden></label>
                </div>
                <div class="paginacion b" id="nav-paginacion" ></div>
                <input type="hidden" id="pagina" value="1">
                <input type="hidden" id="orderCol" value="0">
                <input type="hidden" id="orderType" value="asc">
                
                
            </div> 
        </div>
      <div class="r">
  
        <table class="r-compras scroll a" id="tblData">
          
         <thead>
            <tr class="t-head">
              <th>Nº Compra </th>
              <th>Proveedor</th>
              <th>Rif</th>
              <th>Productos</th>
              <th>total</th>
              <th>fecha</th>
            </tr>
         </thead> 
          <tbody class="table_body"  id="content">
<tr>
            
          </tbody>
        </table>
        </main>  
<div class="reporte left compras" style="width:250px;">
  
  <div class="content">
  <div>
    <input placeholder="Buscador" type="text" id="campo" name="campo" style="width: 170px;text-align: center;">
        </div>
        
<div>
  
  <span>Fecha inicial</span>
  <?php
    $fecha_actual = time();

    // Convertir la marca de tiempo a una fecha
    $fecha = date("Y-m-d", $fecha_actual);
echo "<input id='fecha_desde' type='date' value='$fecha'>";
?>
</div>
        <div>
<span>Fecha final</span>

        <input id="fecha_hasta" type="date" value=''></input>   
        </div>
        <div>
        <span>Nº Compra min</span>
        <input id="ticket_min" type="number" required></input>
</div>
        <div>
<span>Nº Compra max</span>
        <input id="ticket_max" type="number" required></input> 
        </div>
        <div class="img">
      <!-- <img src="../../images/export.svg" onclick="exportar()"></img> -->
</div>

</div>
        
        <script src="/cafetin/js/reporte_compra.js"></script>