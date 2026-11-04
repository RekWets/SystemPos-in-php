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
  <title>REPORTES DE VENTAS</title>

  </head>
<body class="b container">
  
<main class="container_Main">
      <h1>REPORTES DE VENTAS</h1>
      <h3>Cafetin del hospital Dr. Jose Gregorio Hernandez.</h3>
      <div class="reporte ventas">      
      <div class=biopago>
  <span>Biopago</span>  
  <span class="" id="totalbiopago">0000000</span>
      </div>
      <div class=punto>
  <span>punto</span>  
  <span id="punto">0000000</span>
      </div>
      <div class=divisas>
  <span>divisas</span>  
  <span id="divisas">0000000</span>
      </div>
      <div class=efectivo>
  <span>efectivo</span>  
  <span id="efectivo">0000000</span>
      </div>
      <div class=otros>
  <span>otros</span>  
  <span id="otros">0000000</span>
      </div>
      <div class=totales>
  <span>total</span>  
  <span id="total">0000000</span>
      </div>

      </div>
      
    <div class="total">
    <select name="num_registros" id="num_registros" class="form-select"  >
    <label for="num_registros" class="col-form-label">registros </label>
        <option selected value="100000">Todos</option>
        <option  value="25">25</option>
        <option  value="50">50</option>
        <option  value="100">100</option>
        <option  value="100">250</option>
        <option  value="500">500</option>
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
        </div>
        </div>  
  
          </div>
        </div>
      </div>

      
        <div class="tab_title">  
        </div>
        </div>
        
        <div class="r"> 

        <table class="scroll" id="tblData"  style="height:390px">
         <thead>
            <tr class="t-head">
              <th class="">Nrº Ticket</th>
              <th>biopago</th>
              <th>punto</th>
              <th>divisas</th>
              <th>efectivo</th>
              <th>otros</th>
              <th style="width:55px;">total</th>
              <th style="width: 120px;text-align:right">fecha</th>
            </tr>
         </thead> 
          <tbody class="table_body"  id="content">
            
          </tbody>
        </table>
        </div>
      </div>

    </main>  
<div class="reporte left">
  <div class="content">
  <div class="" style="margin-top:12px;">
         <select  name="campo" id="campo" class="" >
    <label for="campo" class="campo">registros</label>
    <option value="">Filtrar por:</option>
        <option value="biopago">Biopago</option>
        <option value="punto_venta">punto</option>
        <option value="divisas">divisas</option>
        <option value="efectivo">efectivo</option>
        <option value="otros">otros</option>
    </select>
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
        <input id="fecha_hasta" type="date"></input>   
        </div>
        <div>
        <span>Ticket min</span>
        <input id="ticket_min" type="number" required></input>
</div>
        <div>
<span>Ticket max</span>
        <input id="ticket_max" type="number" required></input> 
        </div>
        <div class="img">
      <img src="../../images/export.svg" onclick="exportar()"></img>
    <img src="../../images/ventas-diarias.svg" onclick="exportardiarias()"></img>
</div>

</div>
    <script src="/cafetin/js/r-ventas.js">
      
    </script>
    