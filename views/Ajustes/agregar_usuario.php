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
  <link href="/cafetin/css/estilos.css" rel="stylesheet">
  <title>Registro de usuario</title>
</head>

<body class="b">
  <div>
    <p class=home>Ajustes /Registro de Usuario</p>
    <p class=estilo>Cafetin de el Hospital Dr. José Gregorio Hernández </p>
  </div>
  <div class="ajustes a">
    <div class="opciones a">
      <a href="/cafetin/views/ajustes/perfil.php" class="">Perfil</a>
      <a href="/cafetin/views/ajustes/administrar.php" class="">Administrar Usuarios</a>
      <a:active href="/cafetin/views/ajustes/perfil.php" class="">Registrando Usuario</a>
        <a href="/cafetin/views/ajustes/opciones.php" class="">Contraseña </a>
</div>
      <div class="info">
        <div class="rol">
        <form action="/cafetin/app/ajustes/agregar_usuario.php" method="post">
          <h5>FORMULARIO DE REGISTRO DE USUARIO</h5>
          <label id=rol_id class="">
            <span class="rol">Rol:</span>
              <select class="rol" id="rol_id" name="rol_id" required>
                <?php    
                $c = "SELECT nombre_rol FROM roles where nombre_rol !='administrador'" ;

                $post =mysqli_query($conexion, $c);      
                    foreach ($post as $usuario) {
                      
                            echo ' <option SELECTED value='.$usuario['nombre_rol'].'>' . $usuario['nombre_rol']. '</option>' ;
                    }
                  ?>
              </select>
          </label>
          <span class="usuario">Nombre de Usuario:</span>
            <input class="usuario" type="" name="usuario" class="form-control" id="usuario" autocomplete="off" required
              placeholder="">
                  </div>
                  <div>
              <span class="nombre">Nombre:</span>
              <input class="nombre" type="" name="nombre" class="form-control" id="nombre" autocomplete="off" required
                placeholder="">
              <span class="apellido">Apellido:</span>
              <input class="apellido" type="" name="apellido" class="form-control" id="apellido" autocomplete="off" required
                placeholder="">
                  </div>
                <div>
                <span class="cedula">Cedula:</span>
                <input class="cedula" type="number" name="cedula" class="form-control" id="cedula" autocomplete="off" required
                  placeholder="">
                <span class="telefono">Telefono:</span>
                <input class="telefono" type="number" name="telefono" class="form-control" id="telefono" autocomplete="off" required
                  placeholder="">
                  </div>
                  <div class="">
                    <h5>SEGURIDAD</h5>
                    <span class="pass">Contraseña:</span>
                    <input class="pass" type="password" name="clave" class="form-control" id="clave" autocomplete="off" required
                      placeholder="">
                    <span class="email">Correo Electronico:</span>
                    <input class="email" type="email" name="email" class="form-control" id="email" autocomplete="off" required
                      placeholder="">
                    <div>
                      <span class="a">Pregunta Secreta(A):</span>
                      <input class="a" type="" name="pregunta" class="form-control" id="pregunta" autocomplete="off"
                        required placeholder="">
                      <span class="b">Pregunta Secreta(B):</span>
                      <input class="b" type="" name="preguntab" class="form-control" id="preguntab" autocomplete="off"
                        required placeholder="">
<div>
                      <button type="submit" class="rregistro">Guardar</button>
                      <a class="rcancelar" href="/cafetin/views/ajustes/administrar.php">Cancelar</a>
        </form>
      </div>
    </div>

</html>

</body>