<!DOCTYPE html>
<?php
require '../../app/cnx.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $clave = $_POST['clave'];
  $email = $_POST['email'];
  $pregunta = $_POST['pregunta'];
  $preguntab = $_POST['preguntab'];

  $actualizado = "correcto";
  $error = "error";
}
$consulta = "UPDATE usuario SET
    clave=sha1('$clave'),
    email='$email',
    pregunta='$pregunta',
    preguntab='$preguntab'
    WHERE ID='$id' ";

$resultado = mysqli_query($conexion, $consulta);

if ($resultado) {
  echo "<script>alert('$actualizado');</script>";
} else {
  echo "<script>alert('$error');</script>" . mysqli_error($conexion);
}
echo '<script>window.location.href = "/cafetin/views/ajustes/opciones.php";</script>';
?>