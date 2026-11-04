<?php 
require '../../app/cnx.php';
include_once '../../app/header.php';
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
    <title>Registro usuario</title>
    <link rel="stylesheet" href="/cafetin/css/estilos.css">
    <link href="/cafetin/css/select2.min.css" rel="stylesheet"/>
    <script src="/cafetin/js/select2.min.js"></script>
</head>
<body class="container fondo-bg2">
<p class=home>registro de Productos</p>
    <p class=estilo>Cafetin de el Hospital Dr. José Gregorio Hernández </p>
    <div class="container_Main" >
      <div class="addproductos">
        
                    <div class="a">
  
                    <div class="">
                    <form  id="formul" action="../../app/producto/registro_producto.php" method="post" class="">      
                <label id=nombre_proveedor class="">Proveedor
                <select class="js-example-basic-single" id="" name="nombre_proveedor" >
                  <option value="null">Ninguno</option>
                <?php    
                $c = "SELECT * FROM proveedores";
                $post =mysqli_query($conexion, $c);      
                    foreach ($post as $usuario) {
                            echo ' <option value='.$usuario['id'].'>' . $usuario['nombres']. '</option>' ;
                    }
                  ?>
                </select>
                <div class="a">
                                    </label>
                </div>
             </div class="a">
                        <span class="" id="">Descripción del producto</span>
                        <input class="" type="text" name="descripcion" class=""  autocomplete="off" required  placeholder="Jugos naturales" >
                      </div>
                      <div class="b">
                        <span class="" id="">Cantidad</span>
                        <input  type="decimal" name="existencia" class="" autocomplete="off" required placeholder="60" >
                      </div>
                      <div class="c">
                        <span class="" id="">Precio Compra</span>
                        <input  type="decimal" name="precio_compra" class="" autocomplete="off" required placeholder="26.45" >
                      </div>
                      <div class="d">
                        <span class="" id="">Precio Venta</span>
                        <input  type="decimal" name="precio_venta" class=""  autocomplete="off" required placeholder="28.40" >
                      </div>   
                                       <div class="e">
                        <span class="" id="">Al mayor</span>
                        <input  type="decimal" name="mayor" class=""  autocomplete="off" placeholder="28.40" >
                      </div>                    <div class="f">
                        <span class="" id="">Por paquete</span>
                        <input  type="decimal" name="paquete" class="" autocomplete="off" placeholder="28.40" >
                      </div>
                      <div class="a">
                      <button type="submit" class="rregistro">Registrar</button>
                      <a color="red" class="ar" href="/cafetin/views/producto/productos.php">Cancelar</a>
                      </div>
                </form>

            </div>     
    </div>
    <script src="/cafetin/js/select2_es.js"></script>
    <script src="../../js/validacion.js"></script>
    <script type="text/javascript">
document.addEventListener('DOMContentLoaded', function(){
let formulario = document.getElementById('formul');
formulario.addEventListener('refresh', function() {
formulario.reset();
});
});
$.fn.select2.defaults.set('language', 'es');

$('select').select2();
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    $(".js-example-language").select2({
  language: "es"
});
});
</script>

</body>

</html>