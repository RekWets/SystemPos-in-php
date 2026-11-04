<?php
// Recibimos la información de los productos
$total = json_decode(file_get_contents("php://input"));
$data = $total->data;
$price = $total->price;
// Conectamos a la base de datos
$db = new PDO("mysql:host=localhost;dbname=cafetin", "root", "");

// Abrimos una transacción
$db->beginTransaction();

try {
  // Obtenemos el número de ticket
  $num_ticket_actual = $db->query("SELECT num_ticket FROM reporte_venta ORDER BY fecha_venta DESC LIMIT 1")->fetchColumn();

  // Si no hay registros, el número de ticket actual es 1
  if ($num_ticket_actual === null) {
    $num_ticket_actual = 0;
  }
  
  // Aumentamos el número de ticket actual en 1
  $num_ticket = $num_ticket_actual + 1;
  $num_ticket = str_pad($num_ticket, 10, "0", STR_PAD_LEFT);
 
  // Insertamos los datos en la tabla de facturas de ventas
  
  foreach ($price as $producto) {
  $query = "INSERT INTO reporte_venta (num_ticket,descripcion,biopago,punto_venta,divisas,efectivo,otros,total_venta) VALUES (:num_ticket,:descripcion,:biopago,:punto_venta,:divisas,:efectivo,:otros,:total_venta);";
  $stmt = $db->prepare($query);
  $descripcion = "venta exitosa" . $num_ticket;
  $stmt->bindParam(":num_ticket", $num_ticket);
  $stmt->bindParam(":descripcion", $descripcion);
  $stmt->bindParam(":biopago",$producto->biopago);
  $stmt->bindParam(":punto_venta",$producto->punto_venta);
  $stmt->bindParam(":divisas",$producto->Divisas);
  $stmt->bindParam(":efectivo",$producto->Efectivo);
  $stmt->bindParam(":otros",$producto->Otros);
  $stmt->bindParam(":total_venta",$producto->total_venta);
  $stmt->execute();

  // Obtenemos el ID de la factura
  $id_venta = $db->lastInsertId();
  }
  
  // Insertamos los datos en la tabla de reporte de ventas
  foreach ($data as $producto) {
    $query = "INSERT INTO factura_ventas (id_productos, id_venta, cantidad, precio_unidad,total_venta) VALUES (:codigo_producto, :id_venta, :cantidad, :precio,:total_venta)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":codigo_producto", $producto->codigo_producto);
    $stmt->bindParam(":id_venta", $num_ticket);
    $stmt->bindParam(":cantidad", $producto->cantidad);
    $stmt->bindParam(":precio", $producto->value);
    $total = (floatval( $producto->cantidad) * floatval($producto->value));
    $stmt->bindParam(":total_venta",$total);
    $stmt->execute();
    
  }
// Actualizamos las existencia de los productos
foreach ($data as $producto) {
  $query = "UPDATE productos SET existencia = existencia - :cantidad WHERE codigo_producto = :codigo_producto";
  $stmt = $db->prepare($query);
  $stmt->bindParam(":cantidad", $producto->cantidad);
  $stmt->bindParam(":codigo_producto", $producto->codigo_producto);
  $stmt->execute();
}


  // Confirmamos la transacción
  $db->commit();
} catch (PDOException $e) {
  // Roll back la transacción
  $db->rollBack();

  // Imprimimos el error
  echo $e->getMessage();
}

// Devolvemos el estado de la operación
header("HTTP/1.1 200 OK");
