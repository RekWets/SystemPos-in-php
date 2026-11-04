<!DOCTYPE html>
<?php
require '../../app/cnx.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$id = $_POST['codigo_producto'];
$proveedor = $_POST['nombre_proveedor'];
$descripcion = $_POST['descripcion'];
$existencia = $_POST['existencia'];
$precio_compra = $_POST['precio_compra'];

$precio_venta = $_POST['precio_venta'];
$mayor = $_POST['mayor'];
$paquete = $_POST['paquete'];
$actualizado="correcto";
$error="error";
}

$consulta = "UPDATE productos SET
descripcion='$descripcion',
existencia='$existencia',
precio_compra='$precio_compra',
precio_venta='$precio_venta',
mayor = '$mayor', 
paquete ='$paquete',
nombre_proveedor ='$proveedor'
    WHERE codigo_producto='$id' ";
var_dump($consulta);
$resultado = mysqli_query($conexion, $consulta);  
    if ($resultado) {
      echo "<script>alert('$actualizado');</script>";
    } else {
    echo "<script>alert('$error');</script>". mysqli_error($conexion);
}
echo '<script>window.location.href = "/cafetin/views/producto/Productos.php";</script>';
?>