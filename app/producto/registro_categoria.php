<?php
require '../../app/cnx.php';
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $nombre=$_POST['nombre'];

    if (!$conexion) {
        die("no tienes conexion al servidor: " . mysqli_connect_error());
    }
    $existo="Categoria agregado Exitosamente";
    $existe="Categoria ya existente";
    $sql = "SELECT * FROM categorias WHERE nombre = '$nombre'";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result) > 0) {
    echo "<script>alert('$existe');</script>";
    echo '<script>window.location.href = "/cafetin/views/producto/categorias.php";</script>';

   return;
}
    $sql = "INSERT INTO categorias(nombre) VALUES ('$nombre')";
    $result = mysqli_query($conexion, $sql);
    if ($result) {
        echo "<script>alert('$existo');</script>";
    } else {
        echo "A ocurrido un error al agregar el proveedor " . mysqli_error($conexion);
    }
    echo '<script>window.location.href = "/cafetin/views/producto/categorias.php";</script>';

}
?>