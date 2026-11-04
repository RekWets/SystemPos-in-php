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
        'precio_mayor'=>$row['mayor']); 

        $html=' <tr class="producto" id="'.$row['codigo_producto'].'">
        
        <th id="codigo_del_producto" class="codigo_producto">'.$row['codigo_producto'].'</th>
        <th>'.$row['descripcion'].'</th>
        <th class="cantidad"><input input[type=number] {-moz-appearance:textfield;}  value=1 min="1" max="'.$row['existencia'].'" class="input_value value cantidad" ></></th>
<th class="value precio_venta"data-value="'.$row['precio_venta'].'" data-name="'.$row['codigo_producto'].'"> '.$row['precio_venta'].'</th>
        <th class="existencia" id="existencia">'.$row['existencia'].'</th>
        <th><img src="/cafetin/images/papelera.svg"width="20" height="20" id="papelera" data-name="'.$row['codigo_producto'].'" style="color: #e01b24;"></th>
      </tr>';
}
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);
?>