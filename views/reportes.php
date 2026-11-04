<!DOCTYPE html>
<?php

require_once '../app/cnx.php';
require_once '../app/header.php';
if (!isset($_SESSION['user']) || !in_array($_SESSION['rol'], ['administrador', 'lector', ])) {
  header("Location: http://localhost/cafetin/index.php");
  exit;
}
?>
<html lang="en">
<head>
  <title>Cafetin</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div class="reportes-center">
<p class=home>Reportes</p>
<p class=estilo>Cafetin del Hospital Dr. Jose Gregorio Hernandez </p>
    <main class="reportes-home"></main>
      <ul class="reportes a"> 
        <li><a href="/cafetin/views/reportes/reporte-compras.php"><img  src="/cafetin/images/r-compras.svg"></img></a></li>
        <li><a href="/cafetin/views/reportes/reporte-compras-articulos.php"><img  src="/cafetin/images/r-c-articulos.svg"></img></a></li>       
        <li><a href="/cafetin/views/reportes/reporte-existencia.php"><img  src="/cafetin/images/r-existencia.svg"></img></a></li>
        <li><a href="/cafetin/views/reportes/reporte-ventas.php"><img src="/cafetin/images/r-ventas.svg"></a></li>
        <li><a href="/cafetin/views/reportes/reporte-ventas-articulos.php"><img  src="/cafetin/images/r-v-articulos.svg"></img></a></li>
      </ul> 
        <ul class="reportes b">
        <li><a href="/cafetin/views/reportes/reporte-averias.php"><img  src="/cafetin/images/r-averias.svg"></img></a></li>
      </ul>

</body>
<a href="/cafetin/views/reportes/reportes-ventas.php"></a>