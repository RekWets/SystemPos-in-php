<!DOCTYPE html>
<?php 
include_once '../../app/header.php';
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
  <script src="/cafetin/js/jquery.min.js"></script>
  <title>Ajustes Administrador</title>
  </head>
<body class="b">
  
  <div>
    <p class=home>Ajustes / Administrar Usuarios</p>
    <p class=estilo>Cafetin de el Hospital Dr. José Gregorio Hernández </p>
</div>
<div class="ajustes a">
    <div class="opciones a">
    <div>
    <a href="/cafetin/views/ajustes/perfil.php"  class="">Perfil</a>
    </div>
    <div>
    <a:active href="/cafetin/views/ajustes/administrar.php"  class="">Administrar Usuarios</a>
    </div>
    <div>
    <a href="/cafetin/views/ajustes/opciones.php"  class="">Contraseña </a>
    </div>
    
</div>
<div class="opciones b">
      <h5>Administrar Usuarios</h5>
      
     <a href="agregar_usuario.php"  class="usuarios">Añadir Usuario</a>
<div class="opciones  c">
<?php include_once 'busqueda.php'?>
      <table class="usuarios">
        <thead>
          <th class="sort asc">Nombre y Apellido</th>
          <th class="sort asc">Correo</th>
          <th class="sort asc">contraseña</th>
          <th class="sort asc">usuario</th>
          <th class="sort asc">telefono</th>
          <th class="sort asc">Tipo</th>
          <th class="sort asc">
          <th>
        </thead>
        <tbody id="content">
        </tbody>
      </table>
     
</div>
</body>
<script src="/cafetin/js/tabla.usuarios.js"></script>
</html>