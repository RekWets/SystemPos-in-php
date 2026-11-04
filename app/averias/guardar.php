<?php
// Recibimos la información de los productos
$total = json_decode(file_get_contents("php://input"));
$data = $total->data;
$perdido = $total->perdido;
// Conectamos a la base de datos
$db = new PDO("mysql:host=localhost;dbname=cafetin", "root", "");

// Abrimos una transacción
$db->beginTransaction();

try {
  // Obtenemos el número de ticket
  $num_ticket_actual = $db->query("SELECT num_averia FROM reporte_averias ORDER BY num_averia DESC LIMIT 1")->fetchColumn();
  // Si no hay registros, el número de ticket actual es 1
  if ($num_ticket_actual === null) {
    $num_ticket_actual = 0;
  }
  
  // Aumentamos el número de ticket actual en 1
  $num_ticket = $num_ticket_actual + 1;
  $num_ticket = str_pad($num_ticket, 10, "0", STR_PAD_LEFT);
 
  // Insertamos los datos en la tabla de facturas de ventas

  foreach ($perdido as $producto) {
    $query = "INSERT INTO reporte_averias (num_averia,descripcion,total) VALUES (:num_averia,:descripcion,:total);";
    $stmt = $db->prepare($query);
    $descripcion = "Reporte" . $num_ticket;
    $stmt->bindParam(":num_averia", $num_ticket);
    $stmt->bindParam(":descripcion", $descripcion);
    $stmt->bindParam(":total", $producto->total_perdido);
    $stmt->execute();
    // Obtenemos el ID de la factura
    $num_ticket_actual = $db->lastInsertId();
  }

  // Insertamos los datos en la tabla de reporte de ventas
  foreach ($data as $producto) {
    $query = "INSERT INTO factura_averia (id_factura , id_producto_averia , cantidad, precio,total) VALUES (:id_factura, :id_producto_averia, :cantidad, :precio,:total)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id_factura", $num_ticket);
    $stmt->bindParam(":id_producto_averia", $producto->codigo_producto);
    $stmt->bindParam(":cantidad", $producto->cantidad);
    $stmt->bindParam(":precio", $producto->value);
    $total = (floatval( $producto->cantidad) * floatval($producto->value));
    $stmt->bindParam(":total", $total);
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
