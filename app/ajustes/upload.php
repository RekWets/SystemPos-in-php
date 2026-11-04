<?php
require '../cnx.php';
// Obtén los datos del archivo
$data = file_get_contents('data.sql');

// Inserta los datos en la base de datos
$sql = "$data";
mysqli_query($conexion, $sql);
// Cierra la conexión a la base de datos
mysqli_close($conexion);

?>
