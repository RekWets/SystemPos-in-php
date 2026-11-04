<?php
require_once '../app/header.php';
require_once "../app/cnx.php";
$sql =("SELECT num_ticket FROM reporte_venta ORDER BY fecha_venta DESC LIMIT 1");
$post1 = mysqli_query($conexion, $sql);

if (mysqli_num_rows($post1) > 0) {
    foreach ($post1 as $num) {
        echo '<input hidden class="ultimo_ticket" id="ultimo_ticket" value='.$num['num_ticket'].' ></input> ';
    }
} else {
 echo '<input hidden class="ultimo_ticket" id="ultimo_ticket" value="0000000000" </input> ';
}
   ?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Ventas</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../css/estilos.css" rel="stylesheet">
</head>
<body class="b container">
<main class="container_Main">
      <h1>Ventas</h1>
      <h3>Cafetin del hospital Dr. Jose Gregorio Hernandez.</h3>
      <div class="add">
        <div style="width:100%; margin:0; position:relative;">
          <form id="formE" method="post" class="add_Search" style="width:95%;">
            <input id="box" type="text" name="box"  placeholder="Buscar Producto " autocomplete="off">
          </form>
          <div class="box__ON box__OFF" id="content__Search" style="display: block;">

          </div>
        </div>
      </div>
      <div class="tab_container">
        <div class="tab_title">  
          <h2>Lista de productos</h2>
          <img  src="/cafetin/images/limpiar.svg" class=""  alt="" style="position:static;"  onclick="limpiar(event)">
          <h5 class="items" id="items">Items: 0 </h5>
          
        </div>
        <table class="">
         <thead>
            <tr class="table_head">
              <th>Codigo</th>
              <th>Descripcion</th>
              <th>Cantidad</th>
              <th>Precio de venta</th>
              <th>Existencia</th>
              <!-- <th>Tipo de venta</th> -->

              <th>Borrar</th>
              
            </tr>
         </thead> 
          <tbody class="table_body"  id="tb">
            

          </tbody>
        </table>
      </div>
    </main>
      
    <aside class="container_Bill">
      
        <div class="date_1">
      <div class="bill_1">
        <h2>Venta actual</h2>
      </div>
      <div class="bill_Number">
        <h2>Nro:</h2>
        <div> 
        <h3 class="bill_Number--h3 num_ticket" id="num_ticket"></h2>
        </div>
      </div>
      <h3>Datos de Facturacion</h3>
      <div class="subtotal">   
        <h4>Parcial</h4>
        <h3  id="parcial">0.00</h3>
        <h4>Iva</h4>
        <h3 id="iva">0.00</h3>
      </div>
      <h2>Tipo de Pago</h2>
      <div class="bill_Payment">
          <div>

            <input class="pago" type="decimal" id="biopago" value="" placeholder="Biopago">
          </div>
          <div>
            <input class="pago" type="decimal" id="punto_venta" value="" placeholder="Punto de venta">
          </div>
          <div>
            <input class="pago" type="decimal" id="Divisas" value="" placeholder="Divisas">
          </div>
          <div>
            <input class="pago" type="decimal" id="Efectivo" value="" placeholder="Efectivo">
          </div>
            <div>
            <input class="pago" type="decimal" id="Otros" value="" placeholder="Otros">
          </div>
          <h3 hidden class="sumapagos" id="sumapagos" style="color:#2A7039!important;">0</h3>
      </div>
      </div>
      <div class="bill_Total">
        <div>
          <h2>Total a Pagar Bs:</h2>
          <h2 class="price" id="Pay_total" style="color:#2A7039!important;font-size:53px;">0</h2>
        </div>
        <div>
          <h2>Total en dolares:</h2>
            <h2 class="totaldolares"  id="totaldolares" style="color:#D8AF1D !important;">$0</h2>
        </div>
      </div>
        <div class="container_submit">

          <button type="submit" class="submit"   id="submit"    style="margin-top: 20px;"
>Realizar Venta</button>          
        </div>
  </aside>
  <?php
$sql =("SELECT Precio from precio_dolar");
$post1 = mysqli_query($conexion, $sql);
foreach ($post1 as $usuario) {
  
        echo '<input disabled optional hidden class="dolarprecio" id="dolarprecio" type="" name="dolarprecio" value='.$usuario['Precio'].' </input> ' ;      
 }
   ?>
  <script src="../js/ventas.js">
   </script>
</body>
</html>

