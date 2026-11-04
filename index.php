<!DOCTYPE html>
<?php
require_once 'app/cnx.php';
?>
<html lang="en">

<head>
  <title>Cafetin</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/normalize.css" rel="stylesheet">
  <link rel="shortcut icon" href="/cafetin/images/logo.svg">
  <link href="css/estilos.css" rel="stylesheet">
  <link href="/cafetin/css/sweetalert2.min.css" rel="stylesheet"> 
<link href="/cafetin/css/sweetalert2.css" rel="stylesheet"> 
</head>
<body class="index">

  <div class="portada">
  <img  src="/cafetin/images/Logo.svg" alt=""></img>

    <!-- <h1>Iniciar de Sesion</h1> -->
    <form action="app/conexion/login.php" method="POST" class="">
      <p>Usuario</p>
      <input type="text" name="name" maxlength="24" id="name" autocomplete="off" required placeholder=" Ejemplo =   Admin">
      <p>Contraseña</p>
      <input type="password" name="pass" maxlength="24" id="pass" autocomplete="off"  required placeholder=" ********">
      <button type="submit"  value="send">Ingresar</button>
      <a href="recuperar.php">Recuperar contraseña</a>
      
  </div>
  
</body>
  <script src="/cafetin/js/sweetalert2.all.min.js"></script>
<script src="/cafetin/js/sweetalert2.all.js"></script>
<script src="/cafetin/js/sweetalert2.js"></script>
<script src="/cafetin/js/sweetalert2.min.js"></script>
<script src="/cafetin/js/sweetalert2@9.js"></script>
<script>
 function error (){
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Usuario o clave invalida',
        showConfirmButton: false,
        timer: 1500
      });
    }
    </script>