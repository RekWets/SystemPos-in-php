<?php
$removed = 'se a eliminado con exito!';
$error = 'A ocurrido un error :';
$id = $_GET['id'];

$pdo = new PDO('mysql:host=localhost;dbname=cafetin', 'root', '');

$sql = "DELETE FROM usuario WHERE id = :id";
$stmt = $pdo->prepare($sql);

 $stmt->bindParam(':id', $id);
$stmt->execute();
if ($stmt->rowCount() > 0) {
  echo '<script>alert("' . $removed . '");</script>';
} else {
  echo '<script>alert("' . $error . '");</script>';
}

echo '<script>window.location.href="/cafetin/views/ajustes/administrar.php";</script>';

?>
