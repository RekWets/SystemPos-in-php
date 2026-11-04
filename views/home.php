<!DOCTYPE html>
<?php

require_once '../app/cnx.php';
require_once '../app/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>

</head>
<body class=b>
<img  src="/cafetin/images/home.jpg" alt="" type="img" style="position: absolute;top: 0px;left: 181px;width: 900px;height: 100%;"></img>

  <!-- <div class="home-center">
  <div class="tab_container">
        
        <div class="tab_title">  
          <h2>TOP DE PRODUCTOS</h2>
        </div>
    <table class="topproductos" id="tblData"></div>

         <thead>
            <tr class="table_head">
              <th>Codigo</th>
              <th>Descripcion</th>
              <th>Vendidos</th>
              <th>Existencia</th>
            </tr>
         </thead> 
          <tbody class="table_body"  id="tb">
            

          </tbody>
        </table>
</div>
</div> -->
<div class="nav-right-home">
  <div class="dolar">
      <img  class="editar" id="editar" src="/cafetin/images/editar.svg" width="18" height="18" type="img"></img>
  <label>
    <form  action="../app/actualizar_dolar.php" method="POST" class="">
      <?php
   $sql =("SELECT Precio from precio_dolar");
  $post1 = mysqli_query($conexion, $sql);
  foreach ($post1 as $usuario) {
    
          echo '<input class="preciodolar"  disabled optional id="precio" type="" name="precio" required autocomplete="off" placeholder='.$usuario['Precio'].' </input> ' ;
   }
   ?>
      <button class="actualizardolar" disabled  id="submit" type="submit">Actualizar</button> 
    </form>
    
  </label>

</div>
<h3 style="height:10px;">Recordatorio</h3>
<div> 
  
      <?php
 if ($_SESSION["rol"] == "administrador") {
$recordatorios = $conexion->query("SELECT * FROM recordatorios  limit 5 " );

?>  

<table class="" style="border:1px solid #071E54;background:#D4D9FE;border-radius:12px;margin-left:10px;">
  <thead>
    <tr>
<th></th>

    </tr>
  </thead>
  <tbody id="content">
    <?php foreach ($recordatorios as $recordatorio) :
          $id = $recordatorio['id'];
          $_GET['id'] = $id; ?>
      <tr> 
      <td><a onclick="advertencia(event)" href="/cafetin/app/recordatorios/eliminar.php?id=<?php echo $id; ?>" . ><img src="/cafetin/images/papelera.svg"width="20" height="20"></a></td>
       <td style="width: 218px;height: 27px; "><?php echo $recordatorio['recordatorio']; ?></td>
      

      </tr>
    <?php endforeach;
     ?>
  </tbody>
</table>
<?php } ?>

<div>
<form  action="/cafetin/app/recordatorios/crear.php" method="POST" class="">

  <input name="comentario"  maxlength="32"placeholder="Comentario" required style="
    margin-top:20px;
    border-radius: 8px;
    text-align: center;
"></input>
  <button style="
    background: #071E54;
    border-radius: 8px;
    COLOR: white;
    padding: 10px 20px 10px 20px;
    margin: 5px;">enviar</button>
  </form>
</div>

</body>
</html>

<script>
const priceInput = document.getElementById("precio");
const editIcon = document.querySelector("#editar");

editIcon.addEventListener("click", function() {
  priceInput.disabled = !priceInput.disabled;
});

                function onlyiff()
            {
                var a = document.getElementById('precio').value;
                var b = "";
                console.log(a,b);
                if (a = b) {                
                     document.getElementById('submit').disabled = false;
                    document.getElementById('precio').disabled = false;
                 }
                  else {
                    document.getElementById('precio').disabled = false;
                    document.getElementById('submit').disabled = false;
                }};
                document.getElementById("precio").addEventListener("change", (e) => {
 onlyiff();
                });

               
</script>


</script>

