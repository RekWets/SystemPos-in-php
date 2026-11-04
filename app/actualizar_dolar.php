<?php
require_once '../app/cnx.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $precio = $_POST['precio'];
    $actualizado = "correcto";
    $error = "error";
  }
  $consulta = "UPDATE precio_dolar SET
     
     Precio = '$precio' ";
  
$resultado = mysqli_query($conexion, $consulta);
  if ($resultado) {
    echo "<script>alert('$actualizado');</script>";
  } else {
    echo "<script>alert('$error');</script>" . mysqli_error($conexion);
  }
  echo '<script>window.location.href = "/cafetin/views/home.php";</script>';
  ?>