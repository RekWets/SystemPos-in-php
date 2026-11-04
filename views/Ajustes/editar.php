<!DOCTYPE html>
<?php 
include_once '../../app/conexion/session.php';
include_once '../../app/header.php';
              include_once '../../app/cnx.php';
if (!isset($_SESSION['user']) || $_SESSION['rol'] != 'administrador') {
  header("Location: /cafetin/app/conexion/logout.php");
  exit;
 }

 $a = "administrador";
 $id = $_GET['id'];
 $rol_id = $_GET['rol_id'];
 $c = "SELECT nombre_rol FROM roles where nombre_rol !='$rol_id' AND nombre_rol != '$a'";
 $post = mysqli_query($conexion, $c);
$c1 = "SELECT * FROM usuario where id='$id'";
$post1=mysqli_query($conexion,$c1);
?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/cafetin/css/estilos.css" rel="stylesheet">
  <title>Editando usuario</title>
</head>

<body class="b">
  <div>
    <p class=home>Ajustes /Editar Usuario</p>
    <p class=estilo>Cafetin de el Hospital Dr. José Gregorio Hernández </p>
  </div>
  <div class="ajustes a">
    <div class="opciones a">
      <a href="/cafetin/views/ajustes/perfil.php" class="">Perfil</a>
      <a href="/cafetin/views/ajustes/administrar.php" class="">Administrar Usuarios</a>
      <a:active href="/cafetin/views/ajustes/perfil.php" class="">Editando Usuario</a>
        <a href="/cafetin/views/ajustes/opciones.php" class="">Contraseña </a>
</div>
      <div class="info">
        <div class="rol">
        <form action="/cafetin/app/ajustes/actualizar_usuario.php" method="post">
            
          <h5>FORMULARIO DE EDITAR USUARIO</h5>
          <label id=rol_id class="">
            <span class="rol">Rol:</span>
              <select class="rol" id="rol_id" name="rol_id" required>
              <?php    
    
    foreach ($post as $usuario) {
                      
        echo ' <option value=' . $usuario['nombre_rol'] . '>' . $usuario['nombre_rol'] . '</option>';
}
  ?>
              <?php    
    
    foreach ($post1 as $usuario) {
                      
        echo ' <option SELECTED value='.$usuario['rol_id'].'>' . $usuario['rol_id']. '</option>' ;
  ?>
              </select>
          </label>
          
          <span class="usuario">Nombre de Usuario:</span>
            <input class="usuario" type="" name="usuario"  id="usuario" autocomplete="off" required value="<?php echo $usuario ['usuario']; ?>">
                  </div>
                  <div>
              <span class="nombre">Nombre:</span>
              <input class="nombre" type="" name="nombre"  id="nombre" autocomplete="off" required value="<?php echo $usuario ['nombre']; ?>">
              <span class="apellido">Apellido:</span>
              <input class="apellido" type="" name="apellido" id="apellido" autocomplete="off" required value="<?php echo $usuario ['apellido']; ?>">
                  </div>
                <div>
                <span class="cedula">Cedula:</span>
                <input class="cedula" type="number" name="cedula"  id="cedula" autocomplete="off" require value="<?php echo $usuario ['cedula']; ?>">
                <span class="telefono">Telefono:</span>
                <input class="telefono" type="number" name="telefono"  id="telefono" autocomplete="off" required value="<?php echo $usuario ['telefono']; ?>">
                  </div>
                  <div class="">
                    <h5>SEGURIDAD</h5>
                    <span class="pass">Contraseña:</span>
                    <input class="pass" type="password" name="clave" id="clave" autocomplete="off" required placeholder="********************************">
                    <span class="email">Correo Electronico:</span>
                    <input class="email" type="email" name="email" id="email" autocomplete="off" required value="<?php echo $usuario ['email']; ?>">
                    <div>
                      <span class="a">Pregunta Secreta(A):</span>
                      <input class="a" type="" name="pregunta"  id="pregunta" autocomplete="off" value="<?php echo $usuario ['pregunta']; ?>">
                      <span class="b">Pregunta Secreta(B):</span>
                      <input class="b" type="" name="preguntab" id="preguntab" autocomplete="off" value="<?php echo $usuario ['preguntab']; ?>">
<div>                     <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                      <button type="submit" class="rregistro">Guardar</button>
                      <a class="rcancelar" href="/cafetin/views/ajustes/administrar.php">Cancelar</a>
        </form>
<?php }?>
      </div>
    </div>

</html>

</body>