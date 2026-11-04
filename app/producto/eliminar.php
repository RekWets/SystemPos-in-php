<?php
$removed = 'se a eliminado con exito!';
$error = 'A ocurrido un error :';
$db = new PDO('mysql:host=localhost;dbname=cafetin', 'root', '');
$id = $_GET['id'];

  $sql = "DELETE FROM productos WHERE codigo_producto = :id";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    echo '<script>alert("' . $removed . '");</script>';
  } else {
    echo '<script>alert("' . $error . '");</script>';
  }
  echo '<script>window.location.href="/cafetin/views/producto/Productos.php";</script>';
?>

