<?php 
require_once('../cnx.php');
$name = $_POST['name'];
$password = $_POST['pass'];
$password=hash('sha1', $password);
$query = "SELECT u.id, u.clave,  r.nombre_rol as rol FROM usuario u left join roles r ON u.rol_id = r.nombre_rol where usuario = '$name' AND clave = '$password' ";

$result = $conexion->query($query);
$row = $result->fetch_assoc();

if($result->num_rows > 0){
  session_start();
    $_SESSION['user'] = $name;
    $_SESSION['rol'] = $row['rol'];
    if ($row['rol'] === 'administrador') {
      header('Location: ../../views/home.php');
    } else if ($row['rol'] === 'vendedor') {
      header('Location: ../../views/ventas.php');
    } else if ($row['rol'] === 'lector') {
      header('Location: ../../views/reportes.php');
    } else {
      // Redirect the user to the default page.
      header('Location: /cafetin/index.php');
    }
}else{
  echo "<script> alert ('datos incorrectos')</script>";
  echo '<script>window.location.href = "/cafetin/index.php";</script>';
}
?>
