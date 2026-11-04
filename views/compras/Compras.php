<?php

require_once '../../app/header.php';
require_once '../../app/cnx.php';
$sql =("SELECT num_compra FROM reporte_compra ORDER BY num_compra DESC LIMIT 1");
$post1 = mysqli_query($conexion, $sql);

if (mysqli_num_rows($post1) > 0) {
    foreach ($post1 as $num) {
        echo '<input hidden class="ultimo_ticket" id="ultimo_ticket" value='.$num['num_compra'].' </input> ';
    }
} else {
 echo '<input hidden class="ultimo_ticket" id="ultimo_ticket" value="0000000000" </input> ';

}
  
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/cafetin/css/select2.min.css" rel="stylesheet"/>
    <script src="/cafetin/js/select2.min.js"></script>
  <title>Compras productos</title>
</head>
<body class="b container">
<main class="container_Main"> 
      <h1>Compras</h1>
      <h3>Cafetin del hospital Dr. Jose Gregorio Hernandez.</h3>
     <div class="listado_productos">
        <div style="width:95%; margin:10px;  position:relative;">
          <form id="formE" method="post" class="add_Search" style="width:100%;">
            <input id="box" type="text" name="box" placeholder="Buscar Producto" autocomplete="off">
          </form>
          <div class="box__ON box__OFF" id="content__Search">
          </div>
      </div>
        <div class="tab_title">  

          <h5 class="items" id="items">Items: 0</h5>
        </div>
        <table>
         <thead>
            <tr class="table_head">
              <th> # </th>
              <th>producto</th>
              <th>existencia</th>
              <th>Cantidad Comprada</th>
              <th>Nueva Existencia</th>
              <th>Precio Compra</th>
              <th>Precio Venta</th>
              <th>paquete</th>
              <th>Mayor</th>
              <th>borrar</th>
            </tr>
         </thead> 
          <tbody class="table_body" id="tb">
            

          </tbody>
        </table>
      </div>
</main>
     <div Class="buy_proveedor">
      
    <H3>Datos del Proveedor</H3>
      <label id="formul" class="" style="margin-left:10px;">Proveedor
      <select class="js-example--single" id="nombre_proveedor" >
          <option class="proveedor"value="null">Ninguno</option >
          <?php

          $c = "SELECT * FROM proveedores";
          $post = mysqli_query($conexion, $c);
          foreach ($post as $usuario) {
            echo ' <option class="proveedor"  value=' . $usuario['id'] . '>' . $usuario['nombres']   .'</option>';
          }

          ?>
        </select>
      </label>
      </div>
      <div class="listado_factura ">
      <div class="date_1">
      <div class="bill_1">     
        <h2 style="
    margin-left: 11px;
">Factura:</h2>
        <h2 class="num_ticket" id="num_ticket" style="
    width: 210px;
    border: 1px solid #071E54;
    border-radius: 10px;
    text-align: center;
    height: 36px;
    margin-right: 11px;"></h2>

      </div>
      </div>
      <div class="subtotal">   
        <h4 style="margin-left: 11px">Parcial</h4>
        <h3 id="parcial" style="margin-right: 11px;">0.00</h3>
        <h4 style="margin-left: 11px">Iva</h4>
        <h3 id="iva" style="margin-right: 11px;">0.00</h3>
      </div>
      <div class="bill_Total">
        <div>
          <h2 style="margin-left: 11px;">Total a Pagar:</h2>
          <h2 class="price" id="Pay_total" style="font-size:53px;">0</h2>
        </div>
        <div>
        <h2 style="margin-right: 11px;">Total en dolares</h2>
        <h2 class="totaldolares" id="totaldolares" style="color:#D8AF1D !important;">$0</h2>
      </div>
        </div>
      <div class="container_submit">

          <button type="submit" class="submit" id="submit" >Realizar Venta</button>          
        </div>
        <?php
$sql =("SELECT Precio from precio_dolar");
$post1 = mysqli_query($conexion, $sql);
foreach ($post1 as $usuario) {
  
        echo '<input disabled optional hidden class="dolarprecio" id="dolarprecio" type="" name="dolarprecio" value='.$usuario['Precio'].' </input> ' ;      
 }
   ?>
</body>

</html>
   <script src="/cafetin/js/select2_es.js"></script>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function(){
let formulario = document.getElementById('formul');
formulario.addEventListener('refresh', function() {
formulario.reset();
});
});
$.fn.select2.defaults.set('language', 'es');

$('select').select2();
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    $(".js-example-language").select2({
  language: "es"
});
});
</script>
<script src="/cafetin/js/add_compra.js"></script>
<script src="/cafetin/js/select2_es.js"></script>

