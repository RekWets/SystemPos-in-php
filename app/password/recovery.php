<?php
include_once '../../app/cnx.php';
$email=$_POST['email'];
$name =$_POST['name'];
$name1 =$_POST['name1'];
$c = "SELECT id,pregunta,preguntab, IFNULL(usuario,'usuario') as usuario from usuario where email='$email' && pregunta='$name' && preguntab='$name1' LIMIT 1 ";
$f =mysqli_query($conexion, $c);
$a=mysqli_fetch_Assoc($f);

if(! $a){
    echo "<script> alert ('datos incorrectos')</script>";
    echo '<script>window.location.href = "/cafetin/recuperar.php";</script>';
    die();
}
$clave_nueva = rand(10000000, 99999999);
$token= md5 ($a ['id'] . time() . rand(1000, 9999));

$c2= "INSERT INTO  recovery_usuarios SET email='$email' , token='$token' , fecha=now(), clave_nueva='$clave_nueva' 
ON DUPLICATE KEY UPDATE token='$token' ,clave_nueva='$clave_nueva'";
mysqli_query($conexion, $c2);
$link = "http://localhost/cafetin/app/password/recovery_confirmar.php?e=$email&t=$token";

    $mensaje = <<<EMAIL
    
    <p>hola $a[usuario]</p>
    <p>has solicitado recuperar tu contraseña  nueva : $clave_nueva</p>

    <p>para confirmar tu peticion por favor haz  click en esta dirección de url : </p>
    <a href=$link>

    <code>$link</code>
    EMAIL;
echo $mensaje;

?>