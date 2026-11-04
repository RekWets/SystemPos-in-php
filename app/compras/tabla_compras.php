<?php
require "../cnx.php";
$columns=['codigo_producto', 	'descripcion', 	'existencia', 'precio_venta', 	'mayor', 	'paquete'];
$table='productos';
$input= isset($_POST['box']) ? $conexion->real_escape_string($_POST['box']): null;;


$SQL = "SELECT  * FROM  $table WHERE codigo_producto=".$input."";
$result = $conexion ->query($SQL);
$num_rows= $result-> num_rows;

while($row=$result -> fetch_assoc()){
    if($input!=null){
        $arr = array('codigo'=>$row['codigo_producto'],
        'nombre'=>$row['descripcion'],
        'existencia'=>$row['existencia'],
        'precio_venta'=>$row['precio_venta'],
        'paquete'=>$row['paquete'],
        'mayor'=>$row['mayor']); 
        

        $html=' <tr class="producto" id="'.$row['codigo_producto'].'">
        
        <th class="codigo_producto">'.$row['codigo_producto'].'</th>
        <th class="descripcion">'.$row['descripcion'].'</th>
        <th class="existencia">'.$row['existencia'].'</th>
        <th><input input[type="number"] {-moz-appearance:textfield;}  min="1"  class="nueva_compra input_value value" ></></th>
        <th class="nueva_existencia" id="nueva_existencia"> </th>
        <th><input input[type="number"]{-moz-appearance:textfield;} value="'.$row['precio_compra'].'" class="precio_compra input_value value" ></></th>
        <th><input input[type=number] {-moz-appearance:textfield;}  value="'.$row['precio_venta'].'" class="precio_venta input_value value" ></></th>
        <th><input input[type=number] {-moz-appearance:textfield;}  value="'.$row['paquete'].'" class="paquete input_value value" ></></th>
        <th><input input[type=number] {-moz-appearance:textfield;}  value="'.$row['mayor'].'" class="mayor input_value value" ></></th>
        <th><img src="/cafetin/images/papelera.svg"width="20" height="20" class="" data-name="'.$row['codigo_producto'].'" style="color: #e01b24;"></th>
      </tr>';
}
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
?>

