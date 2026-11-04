<?php
require '../../app/cnx.php';
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $rif=$_POST['rif'];
    $nombres=$_POST['nombres'];
    $direccion=$_POST['direccion'];
    $telefono=$_POST['telefono'];
    $tipo=$_POST ['tipo_rif'];

    if (!$conexion) {
        die("no tienes conexion al servidor: " . mysqli_connect_error());
    }
    $existo="provedor(es) agregado Exitosamente";
    $existe="proveedor(es) ya existe";
    $sql = "SELECT * FROM proveedores WHERE rif = '$rif'";
$result = mysqli_query($conexion, $sql);

if (mysqli_num_rows($result) > 0) {

    echo "<script>alert('$existe');</script>";
   return;
}
    $sql = "INSERT INTO proveedores (rif, nombres, direccion, telefono, tipo_rif)
            VALUES ('$rif', '$nombres', '$direccion', '$telefono', UPPER('$tipo'))";

    $result = mysqli_query($conexion, $sql);
    
    if ($result) {
        echo "<script>alert('$existo');</script>";
    } else {

        echo "A ocurrido un error al agregar el proveedor " . mysqli_error($conexion);
    }


}

$post= conexion()->prepare("SELECT *
FROM proveedores
");
$post->execute();
$post=$post->fetchAll();

?>