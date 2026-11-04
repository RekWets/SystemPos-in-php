<?php 
include_once '../../app/header.php';
include_once '../../app/cnx.php';
$roles = array('administrador');
if (!isset($_SESSION['user']) || !in_array($_SESSION['rol'], $roles)) {
  header("Location: /cafetin/index.php");
  exit;
}
?>
<head>
  <title>Productos</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/cafetin/css/estilos.css" rel="stylesheet">
  <script src="/cafetin/js/jquery.min.js"></script>
</head>
<body class="b">
    <p class=home>Productos</p>
    <p class=estilo>Cafetin de el Hospital Dr. José Gregorio Hernández </p>
    <div class="productos">
    <div class="opciones">

    <a href="registro_producto.php">Producto (s) </a>
    <!-- <a  href="categorias.php">Categoria (s)</a> -->
<div class="referencias">
  
<?php 
$id = $_SESSION['user'];

$c = "SELECT COUNT(*) AS total_productos FROM productos";
$post = mysqli_query($conexion, $c);
$row = $post->fetch_assoc();

$total_productos = $row['total_productos'];

foreach($post as $key){
?>
  <span class="green">total de productos:</span>  
  <input disabled class="green" value="<?php echo $total_productos; ?>"></input>
<?php }
$c = "SELECT COUNT(*) AS total_productos FROM productos WHERE existencia <= 10";
$post = mysqli_query($conexion, $c);
$row = $post->fetch_assoc();

$under = $row['total_productos'];

foreach($post as $key){
?>

  <span class="red">Poca existencia:</span>
  <input  disabled class="red" value="<?php echo $under;  ?>"></input>
    <?php }
$current_date = date("Y-m-d");
$dias= date("Y-m-d", strtotime("$current_date - 30 days"));

$c = "SELECT COUNT(*) AS total_productos FROM productos WHERE fecha < '$dias'";
$post = mysqli_query($conexion, $c);
$row = $post->fetch_assoc();

$total_productos = $row['total_productos'];

foreach($post as $key){
?>

  <span class="blue">Sin Actualizar: </span>
  <input disabled class="blue" value="<?php echo $total_productos; ?>"></input>
<?php }?>

</div>

</div>
</div>

</div>

<?php include_once 'busqueda.php'?>
    <div class="col">

<table class="r-compras scroll a" id="tblData" style="position:absolute;width:1000px;top:240px;left:260px;">

 <thead>
    <tr class="t-head">
    <th class="sort asc" style="width:30px;">#</th>
          <th class="sort asc" style="width:250px;">descripcion</th>
          <th class="sort asc" style="width:40px;">existencia</th>
          <th class="sort asc" style="width:100px;">Precio Compra</th>
          <th class="sort asc" style="width:100px;">Precio Venta</th>
          <th class="sort asc">Proveedor</th>
          <th class="sort asc" style="width:180px;">Fecha</th>
          <th class="sort asc" style="width:100px;">Accion</th>

            
    </tr>
 </thead> 
  <tbody class="table_body"  id="content" style="height:270px;">
<tr>
    
  </tbody>
</table>
</body>
<script src="/cafetin/js/tabla.productos.js"></script>

</html>