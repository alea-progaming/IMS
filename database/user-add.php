<?php 
session_start();
  $table_name = $_SESSION['table'];
  
  // var_dump($_SESSION);

  $first_name = $_POST['fName'];
  $last_name = $_POST['lName'];
  $email = $_POST['email'];
  $password = $_POST['pass'];
  $encrypted = password_hash($password, PASSWORD_DEFAULT);

  include('connection.php');
  var_dump($conn);

  $insert_user = "INSERT INTO $table_name(first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :encrypted)";
  $stmt = $conn->prepare($insert_user);
  $stmt->execute([
    'first_name' => $first_name, 
    'last_name' => $last_name, 
    'email' => $email, 
    'encrypted' => $encrypted]);
  
?>