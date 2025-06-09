<?php 

$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=inventory", $username, $password);

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected Successfully";
} catch (\Throwable $th) {
  echo "Connection failed: " . $th->getMessage();
}


?>