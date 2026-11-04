<?php 
$host = "localhost";
$user = "root";
$password = "";
$db = "cafetin";
$conexion = new mysqli($host, $user, $password, $db);

function conexion(){
  try {
      $conexion= new PDO('mysql:host=localhost; dbname=cafetin','root','' );
  } catch (PDOException $e) {
      echo "error". $e->getMessage();
  }
  
  return $conexion;
}
function sessionactiva(){
  session_start();
if(!isset($_SESSION['usuario'])){
  header('Location:cafetin/home.php');
}
}

// POR SI FALLA EL DE ARRIBA 
class Database
{
    private $hostname = "localhost";
    private $database = "cafetin";
    private $username = "root";
    private $password = "";
    private $charset = "utf8";
    function conectar()
    {
        try {
            $conexion = "mysql:host=" . $this->hostname . ";dbname=" . $this->database . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $pdo = new PDO($conexion, $this->username, $this->password, $options);

            return $pdo;
        } catch (PDOException $e) {
            echo 'Error conexion: ' . $e->getMessage();
            exit;
        }
    }
}