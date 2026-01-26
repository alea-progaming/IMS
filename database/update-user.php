<?php
include('connection.php');
session_start();
  if($_POST) {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  }

  try {
    $update_user = "UPDATE users SET first_name=?, last_name=?, email=?, updated_at=NOW() WHERE id=?";
    $stmt = $conn->prepare($update_user);
    $stmt->execute([$first_name, $last_name, $email, $user_id]);
    
    echo json_encode([
        'success' => true,
        'message' => $first_name . ' ' . $last_name . ' is successfully updated.'
    ]);
  } catch (PDOException $e) {
    echo json_encode([
      'success' => false,
      'message' => 'There is an error while processing your request.'
    ]);
  }


?>