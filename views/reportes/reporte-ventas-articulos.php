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
  <title>REPORTES DE VENTAS POR ARTICULOS</title>

  </head>
<body class="b container">
    
  
<main class="container_Main">
      <h1>REPORTES VENTAS POR ARTICULOS</h1>
      <h3>Cafetin del hospital Dr. Jose Gregorio Hernandez.</h3>
      
</div>

<div class="total">
    <select name="num_registros" id="num_registros" class="form-select" style="position:relative;top:-6px;padding:2px">
    <label for="num_registros" class="col-form-label">registros </label>
        <option selected  value="1000">1000</option>
        <option  value="500">500</option>
        <option  value="250">250</option>
        <option  value="100">100</option>
        <option  value="50">50</option>
        <option  value="25">25</option>
    </select>
  <span style="position:relative;left:200px;font-size:larger;
    background-color: white;
    border-radius:4px;
    color: green;
    top:-6px;
    padding:5px;"id="cantidadtotal">Cantidad:</span>  
  <span  style="position:relative;left:230px;font-size: larger;  background-color: white;
    border-radius:4px;
    color: green;
   top:-6px;
    padding:5px" id="bstotal">Total:</span>  
 
</div>


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
              <th style="width:140px;">Ticket venta</th>
              <th style="width:140px;">descripcion</th>
              <th style="width:140px;">cantidad</th>
              <th style="width:140px;">total bs</th>
              <th style="width:140px;">fecha</th>
            </tr>
         </thead> 
          <tbody class="table_body"  id="content">
<tr>
            
          </tbody>
        </table>
        
        
</main>
<div class="reporte left compras" style="width:220px;top:129px;height:440px;">
  
  <div class="content">
    
  <div>
  <div class="">
          <form id="formE" method="post" class="">
            <input id="campo" type="text" name="campo" placeholder="Buscar Producto" autocomplete="off">
          </form>
          <div class="box__ON box__OFF" id="content__Search" style="width: 222px;height:30px;left:-10px;">
          </div>
      </div>
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
      <!-- <img src="../../images/export.svg" onclick="exportar()"></img> -->
</div>

</div>
        
        <script src="/cafetin/js/reporte-ventas-articulos.js"></script>

