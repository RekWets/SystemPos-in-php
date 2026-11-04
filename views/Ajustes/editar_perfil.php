<!DOCTYPE html>
<?php 
include_once '../../app/conexion/session.php';
if (!isset($_SESSION['user']) || $_SESSION['rol'] != 'administrador') {
  header("Location: login.php");
  exit;
}
include_once '../../app/header.php';
$id = $_SESSION['user'];
// $rif_tipo = $_GET['rif_tipo'];
require '../../app/cnx.php';
$consulta = "SELECT * FROM usuario where usuario ='$id' ";
$post = mysqli_query($conexion, $consulta);
$usuario = mysqli_fetch_assoc($post);
$c = "SELECT nombre_rol FROM roles  where  id='$id'";
$post1 = mysqli_query($conexion, $c);

?>
<head>
  <title>Actualización de Proveedor(es)</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/cafetin/css/estilos.css" rel="stylesheet">
  <link rel="shortcut icon" href="#">
  <script src="/cafetin/js/jquery.min.js"></script>
</head>

<body class=b>

  <div class="masproveedor b" style="left:480px;">
<div>
<img src="/cafetin/images/Vproveedor.svg">
    <form action="/cafetin/app/ajustes/editar_perfil.php" method="POST" class="">
      <h3>FORMULARIO DE ACTUALIZACIÓN</h3>
      <div>

                      <?php
                  foreach ($post as $usuario)    { ?>
        <span class="registro">Nombre:</span>
        <input class="rif" type="varchar" name="nombre" id="nombre" required value="<?php echo $usuario ['nombre']; ?>">
      </div>
      <div>
        <span>Apellido :</span>
        <input class="nombre" autocompleted="off" type="text" name="apellido" id="apellido"
          value="<?php echo $usuario ['apellido']; ?>">

      </div>
      <div>
        <span>Cédula :</span>
        <input class="localizacion" name="cedula"  id="cedula" required
          value="<?php echo $usuario['cedula']; ?>">
      </div>
      <div>
        <span>Teléfono :</span>
        <input class="tlf" type="tel" name="telefono" id="telefono" required pattern="[0-9]{11}"
          value="<?php echo $usuario['telefono']; ?>">
      </div>
      <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
      <?php ;
                }
              ?>

      <button type="sumbit" class="rregistro a">Actualizar</button>
      <a color="red" class="rcancelar a" href="/cafetin/views/ajustes/perfil.php">Cancelar</a>
    </form>

  </div>
  </div>
  </div>
  <script src="../../js/validacion.js"></script>