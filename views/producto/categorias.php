<?php 
include_once '../../app/header.php';
require '../../app/producto/registro_producto.php';
if (!isset($_SESSION['user']) || $_SESSION['rol'] != 'administrador') {
  header("Location: login.php");
  exit;
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Categoria</title>
    <link rel="stylesheet" href="/cafetin/css/estilos.css">
</head>
<body class="fondo-bg2">
    <div class="addproductos" >
                    <div class="">
  
                    <div class="">
                    <form action="/cafetin/app/producto/registro_categoria.php" method="post">
                        <span class="" id="">Nombre de la categoria</span>
                        <input  type="text" name="nombre" class=""  autocomplete="off" required  placeholder="Refrescos" >
                      <button type="submit" class="rregistro ">Registro</button>
                      <a color="red" class="rcancelar" href="/cafetin/views/producto/registro_categoria.php">Regresar</a>
                </form>

            </div>     
    </div>
</body>

</html>