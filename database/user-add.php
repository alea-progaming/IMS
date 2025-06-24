<?php 
session_start();
  $table_name = $_SESSION['table'];
  
  // var_dump($_SESSION);

  if($_POST) {
    $first_name = $_POST['fName'];
    $last_name = $_POST['lName'];
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['pass'];
    $encrypted = password_hash($password, PASSWORD_DEFAULT);
  }
  

  include('connection.php');

  // only execute the try block if the user entered a valid email
  if($email) {
    try {
    $insert_user = "INSERT INTO $table_name(first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :encrypted)";
    $stmt = $conn->prepare($insert_user);
    $stmt->execute([
      'first_name' => $first_name, 
      'last_name' => $last_name, 
      'email' => $email, 
      'encrypted' => $encrypted]);

      $response = [
        'success' => false,
        'message' => $first_name . ' ' . $last_name . ' is successfully added to the system.'
      ];
    } catch (PDOException $e) {
      echo $e->getMessage();
      $response = [
        'success' => false,
        'message' => $e->getMessage()
      ];
    }
    
    $_SESSION['response'] = $response;
    header('location: ../users.php');
  } else {
    $_SESSION['invalidEmail'] = "Please enter a valid email";
    header("Location: ../users.php");
    exit;
  }
  


  
?>