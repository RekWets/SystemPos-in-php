<!DOCTYPE html>
<?php
require '../../app/cnx.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];

  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $cedula = $_POST['cedula'];
  $telefono = $_POST['telefono'];

  $actualizado = "correcto";
  $error = "error";
}

$consulta = "UPDATE usuario SET
    nombre='$nombre',
    apellido='$apellido',
    cedula='$cedula',
    telefono = '$telefono'
    WHERE ID='$id' ";

$resultado = mysqli_query($conexion, $consulta);

if ($resultado) {
  echo "<script>alert('$actualizado');</script>";
} else {
  echo "<script>alert('$error');</script>" . mysqli_error($conexion);
}
echo '<script>window.location.href = "/cafetin/views/ajustes/perfil.php";</script>';
?>