<!DOCTYPE html>
<?php
require '../../app/cnx.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$id = $_POST['id'];
$tipo_rif = $_POST['tipo_rif'];
$rif = $_POST['rif'];
$nombres = $_POST['nombres'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$actualizado="correcto";
$error="error";
}

$consulta = "UPDATE proveedores SET
    rif='$rif',
    nombres='$nombres',
    direccion='$direccion',
    telefono = '$telefono', 
    tipo_rif =UPPER('$tipo_rif')
    WHERE ID='$id' ";

$resultado = mysqli_query($conexion, $consulta);  

    if ($resultado) {
      echo "<script>alert('$actualizado');</script>";
    } else {
    echo "<script>alert('$error');</script>". mysqli_error($conexion);
}
echo '<script>window.location.href = "/cafetin/views/proveedor/registro_proveedor.php";</script>';
?>