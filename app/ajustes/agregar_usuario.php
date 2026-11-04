<?php
require '../../app/cnx.php';
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $usuario=$_POST['usuario'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $cedula=$_POST['cedula'];
    $telefono=$_POST ['telefono'];
    $clave=$_POST['clave'];
    $email=$_POST['email'];
    $pregunta=$_POST['pregunta'];
    $preguntab=$_POST['preguntab'];
    $rol_id=$_POST ['rol_id'];

    if (!$conexion) {
        die("no tienes conexion al servidor: " . mysqli_connect_error());
    }
    $existo="usuario agregado Exitosamente";
    $existe="usuario ya existente";
    $sql = "SELECT * FROM usuario WHERE usuario = '$usuario'";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result) > 0) {

    echo "<script>alert('$existe');</script>";
    echo '<script>window.location.href = "/cafetin/views/ajustes/administrar.php";</script>';

   return;
}
    $sql = "INSERT INTO usuario(usuario,nombre,apellido,cedula,telefono,clave,email,pregunta,preguntab,rol_id)
            VALUES('$usuario','$nombre','$apellido','$cedula','$telefono',sha1('$clave'),'$email','$pregunta','$preguntab','$rol_id')";
    $result = mysqli_query($conexion, $sql);
    if ($result) {
        echo "<script>alert('$existo');</script>";
    } else {

        echo "A ocurrido un error al agregar el proveedor " . mysqli_error($conexion);
    }
    echo '<script>window.location.href = "/cafetin/views/ajustes/administrar.php";</script>';

}
