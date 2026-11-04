<?php
require '../../app/cnx.php';
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $comentario=$_POST['comentario'];
    if (!$conexion) {
        die("no tienes conexion al servidor: " . mysqli_connect_error());
    }
    $existo="Comentario agregado Exitosamente";
    $existe="Mensaje existente";
    $sql = "SELECT * FROM recordatorios WHERE recordatorio = '$comentario'";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result) > 0) {

    echo "<script>alert('$existe');</script>";
    echo '<script>window.location.href = "/cafetin/views/home.php";</script>';

   return;
}
    $sql = "INSERT INTO recordatorios(recordatorio)
            VALUES('$comentario')";
    $result = mysqli_query($conexion, $sql);
    if ($result) {
        echo "<script>alert('$existo');</script>";
    } else {

        echo "A ocurrido un error al agregar el Comentario " . mysqli_error($conexion);
    }
    echo '<script>window.location.href = "/cafetin/views/home.php";</script>';

}
