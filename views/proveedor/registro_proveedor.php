<?php 
include_once '../../app/header.php';
require '../../app/proveedor/registro_proveedor.php';

$roles = array('administrador');
if (!isset($_SESSION['user']) || !in_array($_SESSION['rol'], $roles)) {
  header("Location: /cafetin/index.php");
  exit;
}
?>

<head>
  <title>Registro de Proveedor(es)</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/cafetin/css/estilos.css" rel="stylesheet">
  <link rel="shortcut icon" href="#">
  <script src="/cafetin/js/jquery.min.js"></script>
</head>

<body class="b">
  <div class=movimiento>
    <p class=home>Proveedores/ Registro</p>
    <p class=estilo>Cafetin de el Hospital Dr. José Gregorio Hernández </p>
    <?php include_once 'busqueda.php'?>
    <div class="col">
      <table class="proveedor a">
        <thead>
          <th class="sort asc">RIF/Cedula</th>
          <th class="sort asc">Nombre del proveedor</th>
          <th class="sort asc">Telefono</th>
          <th class="sort asc">
          <th>
            
        </thead>
        <tbody id="content">
        </tbody>
      </table>
      <?php include_once 'Registro.php'?>
</body>
<script src="/cafetin/js/tabla.proveedor.js"></script>

</html>