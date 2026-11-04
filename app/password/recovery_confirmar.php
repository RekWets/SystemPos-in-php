<?PHP
include_once '../../app/cnx.php';
$email  = $_GET ['e'];
$token = $_GET ['t'];

$c = "SELECT clave_nueva  FROM recovery_usuarios where email='$email' AND token='$token' LIMIT 1" ;
$f =mysqli_query($conexion , $c);
$a=mysqli_fetch_Assoc($f);

if(! $a){
    $_SESSION['error'] = 'solicitud no encontrada';
    header("LOCATION: ../cafetin/recuperar.php");
    die();
}

$clave =$a ['clave_nueva'];
$c2 = "UPDATE usuario SET clave=sha1('$clave') where email='$email' limit 1 ";
mysqli_query($conexion , $c2);

$c3 = "DELETE from recovery_usuarios where email='$email' limit 1";
mysqli_query($conexion , $c3);

$_SESSION['rta'] = 'contraseña actualizada con exito';
header ("location:/cafetin/index.php");
?>