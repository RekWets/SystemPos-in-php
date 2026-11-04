<!DOCTYPE html>
<html lang="en">
<?php 
include_once '../../app/header.php';
include_once '../../app/conexion/session.php';
if (!isset($_SESSION['user']) || $_SESSION['rol'] != 'administrador') {
  header("Location: /cafetin/index.php");
  exit;
}
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajustes Administrador</title>
</head>

<body class="b">
  <div>
    <p class=home>Ajustes / Perfil</p>
    <p class=estilo>Cafetin de el Hospital Dr. José Gregorio Hernández </p>
  </div>
  <div class="ajustes a">
    <div class="opciones a">
      <a href="/cafetin/views/ajustes/perfil.php" class="">Perfil</a>
      <a href="/cafetin/views/ajustes/administrar.php" class="">Administrar Usuarios</a>
      <a href="/cafetin/views/ajustes/opciones.php" class="">Contraseña </a>
      <!-- <a href="/cafetin/views/ajustes/cargas.php" class="">Base de datos </a> -->
    </div>
    <div class="opciones b">
      <a href="editar_perfil.php"><img src="/cafetin/images/editar.svg" width="20" height="20"></a>
      <h5>Mi Perfil</h5>
      <?php 
              include_once '../../app/cnx.php';
              $id = $_SESSION['user'];
              $c = "SELECT * FROM usuario WHERE usuario = '$id'";
              $post = mysqli_query($conexion, $c);
              foreach($post as $key){
              ?>
      <div class="">
        <span class="">Nombre Completo:</span>
        <input class="" disabled id="" name="" value="<?php echo $key ['nombre'].'  ' .$key ['apellido'];  ?>">
        <span class="">Cédula:</span>
        <input class="" disabled id="" value="<?php echo $key ['cedula'];  ?>">
      </div>
      <div class="c">
        <span class="">Telefono:</span>
        <input class="" disabled id="" value="<?php echo $key ['telefono'];  ?>">
       
      </div>
      <?php } ?>

      <div class="opciones d">
        <form method="POST">
        <?php 
              $c = "SELECT * FROM perfil";
              $post1 = mysqli_query($conexion, $c);
              foreach($post1 as $key){
              ?>
        <a style="margin-top:25px;"href="editar_empresa.php?rif_tipo=<?php echo $key['rif_tipo']; ?>"><img src="/cafetin/images/editar.svg" width="20" height="20"></a>
        <h5 style="margin-top:30px">Datos de la empresa</h5>
       
        <div class="e">
          <span class="">Nombre:</span>
          <input class="" disabled id="nombre" name="nombre" value="<?php echo $key ['nombre_empresa'];  ?>">
          <span class="">RIF:</span>
          <input class="" disabled id="" value="<?php echo $key ['rif_tipo'] . '-' .  $key ['rif_empresa'];  ?>">
          <input type="hidden" disabled id="rif_tipo" name="rif_tipo" value="<?php echo $key ['rif_tipo'] ?>">
        </div>
        <div class="f">
          <span>Dirección:</span>
          <input class="" disabled id="" value="<?php echo $key ['direccion'];  ?>">
          <span class="">Telefono:</span>
          <input class="" disabled id="" value="<?php echo $key ['telefono'];  ?>">
        </div>
              </form>
      </div>
      <?php } ?>
</body>

</html>