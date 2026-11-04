<?php
$no="El proveedor aún tiene productos asociados. No se puede eliminar";
$removed = 'se a eliminado con exito!';
$error = 'A ocurrido un error :';
$db = new PDO('mysql:host=localhost;dbname=cafetin', 'root', '');
$id = $_GET['id'];

$query = "SELECT nombre_proveedor from productos WHERE nombre_proveedor='$id' ";
$resultado = $db->query($query);

if ($resultado->rowCount() > 0) {
  echo '<script>alert("'. $no . '");</script>';
  echo '<script>window.location.href="/cafetin/views/proveedor/registro_proveedor.php";</script>';
  (die);
} else {
  $sql = "DELETE FROM proveedores WHERE id = :id";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    echo '<script>alert("' . $removed . '");</script>';
  } else {
    echo '<script>alert("' . $error . '");</script>';
  }

  echo '<script>window.location.href="/cafetin/views/proveedor/registro_proveedor.php";</script>';
}
?>

