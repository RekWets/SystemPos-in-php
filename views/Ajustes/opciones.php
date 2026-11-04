<!DOCTYPE html>
<?php 
include_once '../../app/conexion/session.php';
include_once '../../app/header.php';
              include_once '../../app/cnx.php';
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
  <title>Ajustes Administrador</title>
  </head>
<body class="b">
    <p class=home>Ajustes / Seguridad</p>
    <p class=estilo>Cafetin de el Hospital Dr. José Gregorio Hernández </p>
<div class="ajustes a">
    <div class="opciones a">
    <a href="/cafetin/views/ajustes/perfil.php"  class="">Perfil</a>
    <a href="/cafetin/views/ajustes/administrar.php"  class="">Administrar Usuarios</a>

    <a:active href="/cafetin/views/ajustes/opciones.php"  class="">Contraseña </a>
    </div>
</div>

<div class="opciones b"> 
<form action="/cafetin/app/ajustes/usuario_actualizar.php" method="POST" class="">
      <h5>Seguridad del Administrador</h5>
      <?php 
              $id = $_SESSION['user'];
              
              $c = "SELECT * FROM usuario WHERE usuario = '$id'";
              $post = mysqli_query($conexion, $c);
              foreach($post as $key){
              ?>
      <div class="">
      <input class="" type="hidden" name="id" id="id" required value="<?php echo $key ['id']; ?>">
      <span>Contraseña:</span>
      <input class="" type="password" name="clave" id="clave" required placeholder="*******">
      <span>Pregunta Mascota(A):</span>
      <input class="" type="text" name="pregunta" id="pregunta" required value="<?php echo $key ['pregunta']; ?>">
      <div class="c">
      <span>Correo:</span>
      <input class="" type="email" name="email" id="email" required value="<?php echo $key ['email']; ?>">
      <span>Pregunta Color (B):</span>
      <input class="" type="text" name="preguntab" id="preguntab" required value="<?php echo $key ['preguntab']; ?>">
      </div>
      <div class="opciones d" style="border-top:0px;">
      <div class="f"  style="margin-top:20px;position:relative;margin-left:300px;" >
        <button class="rregistro"> Actualizar </button>
              </form>
      <?php } ?>
</body>

</html>
