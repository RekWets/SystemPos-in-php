<?php 
include_once '../app/header.php';
require_once '../app/cnx.php';
if (!isset($_SESSION['user']) || $_SESSION['rol'] != 'administrador') {
   header("Location: login.php");
   exit;
 }
?>
<html lang="en">
<head>
  <title>Registro</title>
  <meta charset="utf-8">
  <link href="/cafetin/css/estilos.css" rel="stylesheet"> 
</head>
<body class=fondo-bg2>
<p class=home>Registro</p>
<p class=estilo>Cafetin del Hospital Dr. Jose Gregorio Hernandez </p>
<a href="/cafetin/vistas/registro/registro_nuevo_producto.php">
<button class=productos>agregar producto </button></a>
<form action="buscar_productos.php" method="get" class="form_search">
<input type="text" name="busqueda" id="busqueda" class="productos" placeholder="Buscar producto..">
<!-- <button>buscar</button> -->
<input class="productos">
<table class="productos">

  <th  class=productos>#</th>
  <th  class=productos>descripcion</th>
  <th  class=productos>existencia</th>
  <th  class=productos>precio de compra</th>
  <th  class=productos>precio de venta</th>
  <th  class=productos>mayor</th>
  <th  class=productos>paquete</th>
  <th  class=productos>fecha</th>
  <th  class=productos>Opciones</th>
  <?php 
  
   $sql =("SELECT * from productos");
  $resultado = mysqli_query($conexion, $sql);
   while ($mostrar=$resultado->fetch_assoc()){
   
  ?>
<tr>
   <td  class=productos><?php echo $mostrar["codigo"]?>
   <td  class=productos><?php echo $mostrar["descripcion"]?>
   <td  class=productos><?php echo $mostrar["existencia"]?>
   <td  class=productos><?php echo $mostrar["precio_compra"]?>
   <td  class=productos><?php echo $mostrar["precio_venta"]?>
   <td  class=productos><?php echo $mostrar["mayor"]?>
   <td  class=productos><?php echo $mostrar["paquete"]?>
   <td  class=productos><?php echo $mostrar["fecha"]?>
   <td>
										<a href="?route=worker&method=edit&id=<?php echo $key['id']; ?>" class="btn btn-warning"><i class="bi-pencil"></i> Editar</a>
										<a href="?route=worker&method=delete&id=<?php echo $key['id']; ?>" class="btn btn-danger delete"><i class="bi-trash"></i> Eliminar</a>
									</td>
<?php 

   }
?>
   </tr>
   </table>
   </div>
<body>