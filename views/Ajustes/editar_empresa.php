<!DOCTYPE html>
<?php 
include_once '../../app/conexion/session.php';
if (!isset($_SESSION['user']) || $_SESSION['rol'] != 'administrador') {
  header("Location: /cafetin/index.php");
  exit;
}

include_once '../../app/header.php';
require '../../app/cnx.php';
$id = $_SESSION['user'];

$consulta = "SELECT * FROM perfil";
$post = mysqli_query($conexion, $consulta);
$usuario = mysqli_fetch_assoc($post);
$rif_tipo = $_GET['rif_tipo'];
$c1 = "SELECT nombres FROM tipo_rif WHERE nombres != '$rif_tipo'";
$post1 = mysqli_query($conexion, $c1);

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
    <form action="/cafetin/app/ajustes/editar_empresa.php" method="POST" class="">
      <h3>FORMULARIO DE ACTUALIZACIÓN</h3>
      <div>
      <label id="rif_tipo" class="">
                <select class="" id="rif_tipo" name="rif_tipo" >
                <?php    
    
                    foreach ($post1 as $usuario) {
                      
                            echo '  <option  value='.$usuario['nombres'].'>' . $usuario['nombres']. '</option>' ;
                            
                     } ?>
                      <?php
                  foreach ($post as $usuario)    { 
                    echo ' <option  selected value='.$usuario['rif_tipo'].'>' . $usuario['rif_tipo']. '</option>' ; ?>
                </select>
                  </label> 
                  <div>
        <span class="registro">RIF:</span>
        <input class="rif" type="varchar"  name="rif_empresa" required value="<?php echo $usuario ['rif_empresa']; ?>">
      </div>
      <div>
        <span>Nombre de la empresa :</span>
        <input class="nombre" autocompleted="off" type="text" name="nombres" id="nombres"
          value="<?php echo $usuario ['nombre_empresa']; ?>">

      </div>
      <div>
        <span>Dirección :</span>
        <input class="localizacion" name="direccion"  id="direccion" required
          value="<?php echo $usuario['direccion']; ?>">
      </div>
      <div>
        <span>Teléfono :</span>
        <input class="tlf" type="number" name="telefono" id="telefono" required
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