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
  <title>REPORTES EXISTENCIA POR PRODUCTOS</title>

  </head>
<body class="b container">
    
  
<main class="container_Main">
      <h1>REPORTES EXISTENCIA POR PRODUCTOS</h1>
      <h3>Cafetin del hospital Dr. Jose Gregorio Hernandez.</h3>
</div>        <div class="total">
    <select name="num_registros" id="num_registros">
    <label for="num_registros" class="col-form-label">registros </label>
        <option  selected value="12">12</option>
        <option   value="25">25</option>
        <option   value="50">50</option>
        <option   value="100">100</option>
        <option   value="250">250</option>
        <option value="1000">todos</option>
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
              <th  class="sort asc" style="width: 60px;">#</th>
              <th  class="sort asc" style="width: 300px;">Descripcion</th>
              <th  class="sort asc">Cantidad</th>
              <th  class="sort asc" style="width:160px">Fecha</th>
              <th>Acción</th>
            </tr >
         </thead> 
          <tbody class="table_body"  id="content">
<tr>
            
          </tbody>
        </table>
      </div>
</main>
<div class="reporte left compras" style="width:220px;top:129px;height:300px;">
  
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
        <span>Existencia Minima</span>
        <input id="ticket_min" type="number" required></input>
</div>
        <div>
<span>Existencia maxima</span>
        <input id="ticket_max" type="number" required></input> 
        </div>
        <div class="img">
      <!-- <img src="../../images/export.svg" onclick="exportar()"></img> -->
</div>

</div>
        <script src="/cafetin/js/reporte_existencia.js"></script>