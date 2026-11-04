<?php
$email=$_POST['email'];
// Varios destinatarios
$para  = '$email' . ', ';

// título
$título = 'Recordatorio de cumpleaños para Agosto';

// mensaje
$mensaje = '
<html>
<head>
  <title>Recuperar contraseña</title>
</head>
<body>
  <p>hola $a[usuario]</p>
    <p>has solicitado recuperar tu contraseña  nueva : $clave_nueva</p>

    <p>para confirmar tu peticion por favor haz  click en esta dirección de url : </p>
    <a href=$link>

    <code>$link</code>
</body>
</html>
';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
$cabeceras .= 'From: Recordatorio <cumples@example.com>' . "\r\n";
$cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
$cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";

// Enviarlo
mail($para, $título, $mensaje, $cabeceras);
?>