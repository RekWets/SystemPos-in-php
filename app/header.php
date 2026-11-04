<!DOCTYPE html>
<?php 
require_once "conexion/conexiones.php";
date_default_timezone_set('America/caracas');
$role = $_SESSION["rol"];
?>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/cafetin/css/normalize.css" rel="stylesheet"> 
<link rel="shortcut icon" href="/cafetin/images/logoempresa.svg">
<link href="/cafetin/css/estilos.css" rel="stylesheet"> 
<link href="/cafetin/css/sweetalert2.min.css" rel="stylesheet"> 
<link href="/cafetin/css/sweetalert2.css" rel="stylesheet"> 

</head>
<body>
<nav class="header">
        <div class="logo">
            <img src="/cafetin/images/logoempresa.svg" alt="" class="img"></a>
            <h4>Asoc. Coop. Fergavica.R.L</h4>
            </div>
        <?php if ($_SESSION["rol"] == "administrador") {

   echo '<li class="list_item"> <div class="list_button">
   <img src="/cafetin/images/home.svg"width="14" height="14" class="list_img" alt="">
   <a href="/cafetin/views/home.php" class="nav_link">home</a></li> 
   </div>';

   echo '<li class="list_item">
   <div class="list_button">
   <img src="/cafetin/images/ventas.svg"width="14" height="14" class="list_img" alt="">
   <a href="/cafetin/views/ventas.php" class="nav_link">Ventas</a></li>
   </div>';

    echo '<li class="list_item">
    <div class="list_button">
          <img src="/cafetin/images/compras.svg"width="14" height="14" class="list_img" alt="">
          <a href="/cafetin/views/compras/compras.php" class="nav_link">Compras</a></li> 
   </div>';

     echo'<li class="list_item">
   <div class="list_button">
           <img src="/cafetin/images/registro.svg"width="14" height="14" class="list_img" alt="">
           <a href="/cafetin/views/producto/Productos.php" class="nav_link">Productos</a></li> 
           </div>';

     echo'<li class="list_item">
     <div class="list_button">
           <img src="/cafetin/images/reportes.svg"width="14" height="14" class="list_img" alt="">
          <a href="http://localhost/cafetin/views/reportes.php" class="nav_link">Reportes</a></li> 
          </div>';

     echo'<li class="list_item">
     <div class="list_button">
           <img src="/cafetin/images/proveedores.svg"width="14" height="14" class="list_img" alt="">
           <a href="/cafetin/views/proveedor/registro_proveedor.php" class="nav_link">Proveedores</a></li> 
   </div>';
   echo'<li class="list_item">
   <div class="list_button">
          <img src="/cafetin/images/averia.svg "width="14" height="14" class="list_img" alt="">
          <a href="/cafetin/views/averias.php" class="nav_link">Averias</a>
          </li>
    </div>';

 echo'<li class="list_item">
    <div class="list_button">
           <img src="/cafetin/images/cfg.svg "width="14" height="14" class="list_img" alt="">
           <a href="/cafetin/views/ajustes/perfil.php" class="nav_link">Ajustes</a>
           </li>
     </div>';
       
    } else if ($_SESSION["rol"] == "vendedor") {
        echo '<li class="list_item">
        <div class="list_button">
        <img src="/cafetin/images/ventas.svg"width="14" height="14" class="list_img" alt="">
        <a href="/cafetin/views/ventas.php" class="nav_link">Ventas</a></li>
        </div>';


    } else if ($_SESSION["rol"] == "lector") {
      echo '<li class="list_item"> <div class="list_button">
      <img src="/cafetin/images/home.svg"width="14" height="14" class="list_img" alt="">
      <a href="/cafetin/views/home.php" class="nav_link">home</a></li> 
      </div>';
      echo '<li class="list_item">
      <div class="list_button">
      <img src="/cafetin/images/ventas.svg"width="14" height="14" class="list_img" alt="">
      <a href="/cafetin/views/ventas.php" class="nav_link">Ventas</a></li>
      </div>';
      echo'<li class="list_item">
      <div class="list_button">
            <img src="/cafetin/images/reportes.svg"width="14" height="14" class="list_img" alt="">
           <a href="http://localhost/cafetin/views/reportes.php" class="nav_link">Reportes</a></li> 
           </div>';
           
        }
        echo '<li class="list_item salir">
        <div class="list_button">
        <img src="/cafetin/images/salir.svg" width="14" height="14" class="" alt="">
        </img>
        <a href="/cafetin/app/conexion/logout.php" class="nav_link">Salir</a>
        </li>
        
        </div>';
        ?>    
</nav>
             </body>
             </html>
<script src="/cafetin/js/jquery-3.5.1.js"></script>
<script src="/cafetin/js/main.js"></script>
<script src="/cafetin/js/sweetalert2.all.min.js"></script>
<script src="/cafetin/js/sweetalert2.all.js"></script>
<script src="/cafetin/js/sweetalert2.js"></script>
<script src="/cafetin/js/sweetalert2.min.js"></script>
<script src="/cafetin/js/sweetalert2@9.js"></script>
   </script>
   </html>