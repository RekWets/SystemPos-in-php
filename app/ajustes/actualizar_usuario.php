<?php
require '../../app/cnx.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!$conexion) {
    die("no tienes conexion al servidor: " . mysqli_connect_error());
  }
  $id = $_POST['id'];
  $usuario = $_POST['usuario'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $cedula = $_POST['cedula'];
  $telefono = $_POST['telefono'];
  $clave = $_POST['clave'];
  $email = $_POST['email'];
  $pregunta = $_POST['pregunta'];
  $preguntab = $_POST['preguntab'];
  $rol_id = $_POST['rol_id'];
  $actualizado = "usuario actualizado Exitosamente";
  $error = "a ocurrido un error";
  $sql = "UPDATE usuario SET 
    usuario='$usuario',
     nombre='$nombre',
   apellido='$apellido',
     cedula='$cedula',
   telefono='$telefono',
      clave=sha1('$clave'),
      email='$email',
   pregunta='$pregunta',
  preguntab='$preguntab',
     rol_id='$rol_id'
   WHERE id='$id'";
  $resultado = mysqli_query($conexion, $sql);

  if ($resultado) {
    echo "<script>alert('$actualizado');</script>";
  } else {
    echo "<script>alert('$error');</script>" . mysqli_error($conexion);
  }
}
echo '<script>window.location.href = "/cafetin/views/ajustes/administrar.php";</script>';
