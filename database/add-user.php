<?php 
session_start();
  $table_name = $_SESSION['table'];
  
  // var_dump($_SESSION);

  if($_POST) {
    $first_name = $_POST['fName'];
    $last_name = $_POST['lName'];
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    
    if(strlen($_POST['pass']) <= 8){
      $_SESSION['shortPass'] = "Password should be more than 8 characters.";
      header('location: ../users.php');
      exit;
    }

    $password = $_POST['pass'];
    $encrypted = password_hash($password, PASSWORD_DEFAULT);
  }
  

  include('connection.php');

  // only execute the try block if the user entered a valid email
  if($email) {
    try {
    $insert_user = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES (:first_name, :last_name, :email, :password, NOW(), NOW())";
    $stmt = $conn->prepare($insert_user);
    $stmt->execute([
      'first_name' => $first_name, 
      'last_name' => $last_name, 
      'email' => $email, 
      'password' => $encrypted]);

      $response = [
        'success' => true,
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