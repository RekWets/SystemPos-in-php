<?php
include_once '../../app/cnx.php';

function session_activa(){
    if(isset($_SESSION['administrador'])){
        header('Location:vistas/inicio.php');
    }
}
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $descripcion=$_POST['descripcion'];
    $existencia=$_POST['existencia'];
    $precio_compra=$_POST['precio_compra'];
    $precio_venta=$_POST['precio_venta'];
    $paquete=$_POST['paquete'];
    $mayor=$_POST['mayor'];
    $pk_proveedor=$_POST['nombre_proveedor'];
    if (!$conexion) {
        die("no tienes conexion al servidor: " . mysqli_connect_error());
    }
    $existo="producto agregado Exitosamente";
    $existe="producto ya existente";
    $sql = "SELECT * FROM productos WHERE descripcion = '$descripcion'";
    $result = mysqli_query($conexion, $sql);
    
    if (mysqli_num_rows($result) > 0) {
    
        echo "<script>alert('$existe');</script>";
        echo '<script>window.location.href="/cafetin/views/producto/Productos.php";</script>';

    }
    $insertar="INSERT INTO productos(descripcion,existencia,precio_compra,precio_venta,mayor,paquete,nombre_proveedor)
    values('$descripcion','$existencia','$precio_compra',' $precio_venta', '$paquete','$mayor','$pk_proveedor')";
    
    if (mysqli_query($conexion, $insertar)) {
        echo "<script>alert('$existo');</script>";
    } else {
        echo "no se pudo agregar por el error: " . mysqli_error($conexion);
    }
    mysqli_close($conexion);
    }
    echo '<script>window.location.href="/cafetin/views/producto/Productos.php";</script>';

    
    ?>