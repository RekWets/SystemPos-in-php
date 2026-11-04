<!DOCTYPE html>
<?php

require_once '../../app/cnx.php';
require_once '../../app/header.php';
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
<p class=home>Carga Base de datos</p>
<p class=estilo>Cafetin del Hospital Dr. Jose Gregorio Hernandez </p>
      <ul class="reportes a"> 
        <form>
        <input type="file" id="subir"></input>
       
        </form>
        <button onclick=cargardb()>Subir</button>
      </ul> 
        <ul class="reportes b">
        <form action="/cafetin/app/ajustes/export.php" method="post">
  <input type="submit" name="exportar" value="Exportar">
</form>
      </ul>

</body>
<script src="../../js/cargarbd.js"></script>