<?php
// Recibimos la información de los productos
$total = json_decode(file_get_contents("php://input"));
$data = $total->data;
$proveedor = $total->proveedor;
// Conectamos a la base de datos
$db = new PDO("mysql:host=localhost;dbname=cafetin", "root", "");

// Abrimos una transacción
$db->beginTransaction();

try {
  // Obtenemos el número de ticket
  $num_ticket_actual = $db->query("SELECT MAX(num_compra) FROM reporte_compra")->fetchColumn();

  // Si no hay registros, el número de ticket actual es 1
  if ($num_ticket_actual === null) {
    $num_ticket_actual = 0;
  }
  
  // Aumentamos el número de ticket actual en 1
  $num_ticket = $num_ticket_actual + 1;
  $num_ticket = str_pad($num_ticket, 10, "0", STR_PAD_LEFT);
  // Insertamos los datos en la tabla de facturas de ventas
  foreach ($proveedor as $producto) {
  $query = "INSERT INTO reporte_compra (num_compra,total_compra,proveedor) VALUES (:num_compra,:total_compra,:proveedor);";
  $stmt = $db->prepare($query); 
  $stmt->bindParam(":num_compra",$num_ticket);
  $stmt->bindParam(":total_compra",$producto->pay_total);
  $proveedor_id = intval($total->proveedor[0]->proveedor);
  $stmt->bindParam(":proveedor",$proveedor_id);
  $stmt->execute();
  // Obtenemos el ID de la factura
  $id_compra = $db->lastInsertId();
  }

  // Insertamos los datos en la tabla de reporte de ventas
  foreach ($data as $producto) {
    $query = "INSERT INTO factura_compras ( id_compra, id_productos, cantidad_comprada, nueva_existencia, nuevo_precio_compra,nuevo_precio_venta,nuevo_mayor,nuevo_paquete) VALUES 
                                         (:id_compra, :id_productos, :cantidad_comprada, :nueva_existencia, :nuevo_precio_compra, :nuevo_precio_venta, :nuevo_mayor, :nuevo_paquete)";
    $stmt = $db->prepare($query);    
    $stmt->bindParam(":id_compra", $num_ticket);
    $stmt->bindParam(":id_productos", $producto->codigo_producto);
    $stmt->bindParam(":cantidad_comprada", $producto->nueva_compra);
    $stmt->bindParam(":nueva_existencia", $producto->nueva_existencia);
    $stmt->bindParam(":nuevo_precio_compra", $producto->precio_compra);
    $stmt->bindParam(":nuevo_precio_venta", $producto->precio_venta);
    $stmt->bindParam(":nuevo_mayor", $producto->mayor);
    $stmt->bindParam(":nuevo_paquete", $producto->paquete);
    $stmt->execute();
    
  }
// Actualizamos las existencia de los productos
foreach ($data as $producto) {
  $query = "UPDATE productos SET existencia = :nueva_existencia, precio_compra = :nuevo_precio_compra, precio_venta = :nuevo_precio_venta, paquete = :nuevo_paquete, mayor = :nuevo_mayor WHERE codigo_producto = :codigo_producto; ";
  $stmt = $db->prepare($query);
  $stmt->bindParam(":nueva_existencia", $producto->nueva_existencia);
  $stmt->bindParam(":nuevo_precio_compra", $producto->precio_compra);
  $stmt->bindParam(":nuevo_precio_venta", $producto->precio_venta);
  $stmt->bindParam(":nuevo_paquete", $producto->paquete);
  $stmt->bindParam(":nuevo_mayor", $producto->mayor);
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
