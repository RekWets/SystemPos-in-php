<!DOCTYPE html>
<?php
if (isset($_SESSION['error'])){
  $class='error';
  $mensaje = $_SESSION['error'];
  unset($_SESSION['error']);
}else if (isset($_SESSION['rta'])) {
  $class='ok';
  $mensaje='Ingrese los datos para verificar su identidad';
}
else{
  $class='info';
  $mensaje='Ingrese los datos para verificar su identidad';
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
  <title>Cafetin</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/estilos.css" rel="stylesheet">
  <link rel="shortcut icon" href="/cafetin/images/logo invertido.svg">
</head>

<body class="index">
  <div class="portada b">
        <img src="/cafetin/images/Logo.svg" alt=""></img>
        <h1><?php echo $mensaje; ?></h1>
        <form action="app/password/recovery.php" method="POST" class="">
            <div>
              <p>Pregunta secreta A</p>
              <input type="password" class="box-usuario" maxlength="200" id="name"  name="name" required="" placeholder="Pregunta Secreta" autocomplete="off">

                    </div>
                    <div>
                    <p>Pregunta secreta B</p>
                    <input type="password" class="box-usuario" maxlength="200" id="name1" name="name1" required="" placeholder="Pregunta Secreta" autocomplete="off">

</div>
              <p>correo Electronico</p>
                  <input  type="email" id="email" name="email" class="box-confirmar" maxlength="200" required="" autocomplete="off"
                    placeholder="usuario@mail.com">
                  <button type="submit" class="ingresar" value="send">Ingresar</button>
</form>
<a href="index.php">Regresar</a>
              </div>
              
</body>