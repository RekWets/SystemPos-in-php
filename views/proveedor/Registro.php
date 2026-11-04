
<body class="a">
<div class="masproveedor a">
                    <div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <img src="/cafetin/images/Vproveedor.svg">
                        <h3 >FORMULARIO DE REGISTRO</h3>
                            <div>
                            <label id=tipo_rif class="">
                <select class="" id="" name="tipo_rif" required>
                <?php    
                $c = "SELECT id,nombres FROM tipo_rif";

                $post =mysqli_query($conexion, $c);      
                    foreach ($post as $usuario) {
                            echo ' <option SELECTED value='.$usuario['nombres'].'>' . $usuario['nombres']. '</option>' ;
                    }
                  ?>
                </select>
                  </label>           
                            <span class="registro">RIF/Cedula :</span>
                                <input class="rif" type="number" name="rif" class="form-control" id="rif"  autocomplete="off" required  placeholder="0123456789" >
                              </div>
                              <div>
                                <span>Nombre/s :</span>
                                <input  class="nombre" type="text" name="nombres" class="form-control" id="nombres"  autocomplete="off" required placeholder="Confitería" >

                              </div>
                              <div >
                                <span>Dirección :</span>
                                <input class="localizacion" type="text" name="direccion" class="form-control" id="direccion"  autocomplete="off" required placeholder="Trujillo, cristobal mendoza" >
                              </div>
                              <div >
                                <span>Telefono :</span>
                                <input class="tlf" type="tel" pattern="\([0-9]{3}\) [0-9]{3}[ -][0-9]{4}" name="telefono" class="form-control"  id="telefono" autocomplete="off"  placeholder="04xx-xxxx" >
           
                               <form action="app/proveedor/registro_proveedor.php" method="POST" class="">
                              <button type="" class="rregistro">Registro</button>
                              <a color="red" class="rcancelar a" href="/cafetin/views/proveedor/registro_proveedor.php">Cancelar</a>
                        </form>
                        
                    </div>     
            </div>