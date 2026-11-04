<!DOCTYPE html>
<?php
include_once '../../app/header.php';
if (!isset($_SESSION['user']) || $_SESSION['rol'] != 'administrador') {
  header("Location: login.php");
  exit;
}
$id = $_GET['id'];
$tipo_rif = $_GET['tipo_rif'];
require '../../app/cnx.php';
$consulta = "SELECT * FROM proveedores where id ='$id' ";
$post = mysqli_query($conexion, $consulta);
$usuario = mysqli_fetch_assoc($post);
$c = "SELECT nombres FROM tipo_rif  where nombres !='$tipo_rif'";
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

  <div class="masproveedor b">
<div>
<img src="/cafetin/images/Vproveedor.svg">
    <form action="/cafetin/app/proveedor/editar.php" method="POST" class="">
      <h3>FORMULARIO DE ACTUALIZACION</h3>
      <div>
      <label id=tipo_rif class="">
                <select class="" id="" name="tipo_rif" required>
                <?php    
    
                    foreach ($post1 as $usuario) {
                      
                            echo '  <option  value='.$usuario['nombres'].'>' . $usuario['nombres']. '</option>' ;
                     } ?>
                      <?php
                  foreach ($post as $usuario)    { 
                    echo ' <option  selected value='.$usuario['tipo_rif'].'>' . $usuario['tipo_rif']. '</option>' ; ?>
                  
                </select>
                  </label> 
        <span class="registro">RIF/Cedula :</span>
        <input class="rif" type="varchar" name="rif" id="rif" required value="<?php echo $usuario ['rif']; ?>">
      </div>
      <div>
        <span>Nombre/s :</span>
        <input class="nombre" autocompleted="off" type="text" name="nombres" class="form-control" id="nombres"
          value="<?php echo $usuario ['nombres']; ?>">

      </div>
      <div>
        <span>Dirección :</span>
        <input class="localizacion" name="direccion" class="form-control" id="direccion" required
          value="<?php echo $usuario['direccion']; ?>">
      </div>
      <div>
        <span>Telefono :</span>
        <input class="tlf" type="number" name="telefono" class="form-control" id="telefono" required
          value="<?php echo $usuario['telefono']; ?>">
      </div>
      <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
      <?php ;
                }
              ?>

      <button type="sumbit" class="rregistro a">Actualizar</button>
      <a color="red" class="rcancelar a" href="/cafetin/views/proveedor/registro_proveedor.php">Cancelar</a>
    </form>

  </div>
  </div>
  </div>
  <script src="../../js/validacion.js"></script>