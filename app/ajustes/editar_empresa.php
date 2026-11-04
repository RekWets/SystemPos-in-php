<!DOCTYPE html>
<?php
require '../../app/cnx.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $rif_tipo = $_POST['rif_tipo'];
  $id = $_POST['id'];
  $rif = $_POST['rif_empresa'];
  $nombres = $_POST['nombres'];
  $direccion = $_POST['direccion'];
  $telefono = $_POST['telefono'];

  $actualizado = "correcto";
  $error = "error";
}

$consulta = "UPDATE perfil SET
    rif_empresa='$rif',
    nombre_empresa='$nombres',
    direccion='$direccion',
    telefono = '$telefono',
    rif_tipo ='$rif_tipo'
    WHERE ID='$id' ";

$resultado = mysqli_query($conexion, $consulta);

if ($resultado) {
  echo "<script>alert('$actualizado');</script>";
} else {
  echo "<script>alert('$error');</script>" . mysqli_error($conexion);
}
echo '<script>window.location.href = "/cafetin/views/ajustes/perfil.php";</script>';
?>